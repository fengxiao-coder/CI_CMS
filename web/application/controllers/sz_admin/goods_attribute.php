<?php

/**
 * goods_attribute
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_attribute/
 */
class Goods_attribute extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("goods_attribute_model");
    }

    public function index($id) {
        $this->load->model("goods_category_model");
        //$search['attributes'] = $this->input->get();
        $search['attributes'] = array('type_id' => $id
        );
        // 总数与分页
        $total = $this->goods_attribute_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/goods_attribute/index"),
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
        $data['goods_attribute_data'] = $this->goods_attribute_model->all($search);
        //p($data['goods_attribute_data']);
        $this->load->view('sz_admin/goods_attribute/index', $data);
    }

    public function add() {
        $this->load->model("goods_category_model");
        $data = array();
        $search['attributes'] = array('pid' => 0);
        $data['goods_category_data'] = $this->goods_category_model->all($search);
        if ($this->input->post('is_submit')) {
            try {
                $goods_attribute_data = $this->input->post();
                $data['goods_attribute_data'] = $goods_attribute_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'attr_name', 'label' => '商品属性名称', 'rules' => 'required'),
                    array('field' => 'type_id', 'label' => '商品属性所属类型', 'rules' => 'required'),
                    array('field' => 'attr_input_type', 'label' => '属性录入方式 ', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //图片上传
                $goods_attribute_data['created'] = $goods_attribute_data['modified'] = time();
                //插入                              
                $goods_attribute_id = $this->goods_attribute_model->insert($goods_attribute_data);
                $id = $goods_attribute_data['type_id'];
                init_messagebox('添加成功', 'success', 1, base_url("sz_admin/goods_attribute/index/$id"));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods_attribute/form', $data);
    }

    public function edit($id) {
        $this->load->model("goods_category_model");
        $data = array();
        $search['attributes'] = array('pid' => 0);
        $data['goods_category_data'] = $this->goods_category_model->all($search);
        $data['goods_attribute_data'] = $this->goods_attribute_model->get_by_pk($id);
        if ($this->input->post('is_submit')) {
            try {
                $goods_attribute_data = $this->input->post();
                //p($goods_attribute_data);
                $data['goods_attribute_data'] = $goods_attribute_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'attr_name', 'label' => '商品属性名称', 'rules' => 'required'),
                    array('field' => 'type_id', 'label' => '商品属性所属类型', 'rules' => 'required'),
                    array('field' => 'attr_input_type', 'label' => '属性录入方式', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //图片上传
                $goods_attribute_data['modified'] = time();
                //插入   
//                if (!$goods_attribute_data['attr_value']) {
//                    $goods_attribute_data['attr_value'] = '';
//                }
               // p($goods_attribute_data);
                $goods_attribute_id = $this->goods_attribute_model->update_by_pk($goods_attribute_data, $id);
                $aid = $goods_attribute_data['type_id'];
                init_messagebox('添加成功', 'success', 1, base_url("sz_admin/goods_attribute/index/$aid"));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods_attribute/form', $data);
    }

    public function delete($id) {
        $this->load->model("goods_attr_model");
        $attr = $this->goods_attribute_model->delete_by_pk($id);
        if ($attr) {
            $this->goods_attr_model->delete_by_attributes(array('attr_id' => $id
                    ), false);
        }
        redirect(base_url('sz_admin/goods_type/index'));
    }

}
