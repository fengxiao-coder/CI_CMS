<?php

/**
 * adv
 * @version 1.0
 * @package application
 * @subpackage application/controllers/adv/
 */
class Adv extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("adv_model");
    }

    public function index() {
        $search['attributes'] = $this->input->get();
        $total = $this->adv_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/adv/index"),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array(
            'persize' => $per_page,
            'offset' => $this->pagination->get_cur_offset()
        );
        $search['orders'] = array(
            'sort' => 'id'
        );
        $data['adv_data'] = $this->adv_model->all($search);
        $this->load->view('sz_admin/adv/index', $data);
    }

    public function add() {
        $data = array();
        if ($this->input->post('is_submit')) {
            try {
                $adv_data = $this->input->post();
                $data['adv_data'] = $adv_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'adv_url', 'label' => '广告链接', 'rules' => 'required'),
                    array('field' => 'adv_title', 'label' => '广告内容描述', 'rules' => 'required'),
                    array('field' => 'adv_content', 'label' => '广告内容', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //图片上传
                $filePath = './uploads/'; //上传路径
                $storName = 'photo'; //图片存储的字段名
                $adv_data[$storName] = $this->adv_model->check_upimg($filePath, $storName);
                $data['adv_data'][$storName] = $adv_data[$storName];
                $adv_data['created'] = $adv_data['modified'] = time();
                $this->adv_model->insert($adv_data);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/adv/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/adv/form', $data);
    }

 public function edit($id) {
        $data['adv_data'] = $this->adv_model->get_by_pk($id);
        if ($this->input->post('is_submit')) {
            try {
                $adv = $this->input->post();
                //设置验证规则
                $rule_config = array(
                    array('field' => 'adv_url', 'label' => '广告链接', 'rules' => 'required'),
                    array('field' => 'adv_title', 'label' => '广告内容描述', 'rules' => 'required'),
                    array('field' => 'adv_content', 'label' => '广告内容', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $adv['modified'] = time();
                if (!$_FILES['photo']['error']) {
                    //图片上传
                    $filePath = './uploads/'; //上传路径
                    $storName = 'photo'; //图片存储的字段名
                    $oriPath = $adv[$storName]; //图片原来的路径
                    $adv[$storName] = $this->adv_model->check_upimg($filePath, $storName, $oriPath);
                    $data['adv_data'] = $adv;
                }
                $this->adv_model->update_by_pk($adv, $id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/adv/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/adv/form', $data);
    }

    public function view($id) {
        $data['adv_data'] = $this->adv_model->get_by_pk($id);
        $this->load->view('sz_admin/adv/view', $data);
    }

}
