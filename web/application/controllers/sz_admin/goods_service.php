<?php

/**
 * goods_service
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_service/
 */
class Goods_service extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('goods_service_model');
    }

    public function index() {
        $search['attributes'] = $this->input->get();
        $search['orders'] = array(
            'id' => 'asc'
        );
        $total = $this->goods_service_model->total($search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('sz_admin/goods_service/index'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());
        $data['goods_service_data'] = $this->goods_service_model->all($search);
        $this->load->view('sz_admin/goods_service/index', $data);
    }

    /**
     * add 添加
     * @author hzf
     */
    public function add() {
        $data = array();
        if ($this->input->post('is_submit')) {
            try {
                $goods_service = $this->input->post();
                $data['goods_service'] = $goods_service;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'name', 'label' => '名称', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //图片上传
                $filePath = './uploads/'; //上传路径
                $storName = 'img'; //图片存储的字段名
                $data['goods_service'][$storName] = $this->goods_service_model->check_upimg($filePath, $storName);
                if (!$data['goods_service'][$storName])
                    throw new Exception("请选择标识符");
                $this->goods_service_model->insert($data['goods_service']);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods_service/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods_service/form', $data);
    }

 public function edit($id) {
        $data['goods_service'] = $this->goods_service_model->get_by_pk($id);
        if ($this->input->post('is_submit')) {
            try {
                $goods_service = $this->input->post();
                //设置验证规则
                $rule_config = array(
                    array('field' => 'name', 'label' => '名称', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $goods_service['modified'] = time();
                if (!$_FILES['img']['error']) {
                    //图片上传
                    $filePath = './uploads/'; //上传路径
                    $storName = 'img'; //图片存储的字段名
                    $oriPath = $goods_service[$storName]; //图片原来的路径
                    $goods_service[$storName] = $this->goods_service_model->check_upimg($filePath, $storName, $oriPath);
                    $data['goods_service'] = $goods_service;
                }
                $this->goods_service_model->update_by_pk($goods_service, $id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/goods_service/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods_service/form', $data);
    }

}
