<?php

/**
 * shipping
 * @version 1.0
 * @package application
 * @subpackage application/controllers/shipping/
 */
class Shipping extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("shipping_model");
        $search['attributes'] = $this->input->get();
        $total = $this->shipping_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('sz_admin/shipping/index'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());

        $data['shipping_data'] = $this->shipping_model->all($search);
        $this->load->view('sz_admin/shipping/index', $data);
    }

    //添加
    public function add() {
        $this->load->model("shipping_model");
        $data = array();
        if ($this->input->post('is_submit')) {
            try {
                $data['shipping_data'] = $this->input->post();
                //设置验证规则
                $rule_config = array(
                    array('field' => 'shipping_name', 'label' => '配送名称', 'rules' => 'required'),
                    array('field' => 'shipping_desc', 'label' => '描述', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //插入                              
                $id = $this->shipping_model->insert($data['shipping_data']);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/shipping/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/shipping/form', $data);
    }

    //修改
    public function edit($id) {
        $this->load->model("shipping_model");
        $data = array();
        $data['shipping_data'] = $this->shipping_model->get_by_pk($id);
        if ($this->input->post('is_submit')) {
            try {
                $shipping_data = $this->input->post();
                $data['shipping_data'] = $shipping_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'shipping_name', 'label' => '配送名称', 'rules' => 'required'),
                    array('field' => 'shipping_desc', 'label' => '描述', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //修改
                $this->shipping_model->update_by_pk($data['shipping_data'], $id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/shipping/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/shipping/form', $data);
    }

    //详情页
    public function view($id) {
        $this->load->model("shipping_model");
        $data['shipping_data'] = $this->shipping_model->get_by_pk($id);
        $this->load->view('sz_admin/shipping/view', $data);
    }

}
