<?php

/**
 * goods_attr
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_attr/
 */
class Goods_attr extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("goods_attr_model");
        $this->load->model("goods_model");
    }
    public function index($id) {
        $this->load->model("goods_attribute_model");
        $search['attributes'] = array('goods_id' => $id
        );
        // 总数与分页
        $total = $this->goods_attr_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/goods_attr/index"),
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
        $data['goods_attr_data'] = $this->goods_attr_model->all($search);
        $this->load->view('sz_admin/goods_attr/index', $data);
    }
    public function add($id) {
        $this->load->model("goods_attribute_model");
        $data = array();
        $goods_id = $id;
        $data['goods_id'] = $goods_id;
        $pid = $this->input->get();
        $condition = array(
            'attributes' => array('type_id' => $pid['pid']),
        );
        $data['goods_attribute'] = $this->goods_attribute_model->get_appoint_values(array('attr_id', 'attr_name', 'type_id', 'attr_value'), null, $condition);
        if ($this->input->post('is_submit')) {
            try {
                $attr_data = $this->input->post();
                //设置验证规则
                $rule_config = array(
                    array('field' => 'goods_id', 'label' => '商品ID', 'rules' => 'required'),
                    array('field' => 'attr_id', 'label' => '属性ID', 'rules' => 'required'),
                    array('field' => 'attr_value', 'label' => '属性值', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);  
                $this->goods_attr_model->insert($attr_data);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods_attr/form', $data);
    }
    
	public function delete( $id ) {
		$this->goods_attr_model->delete_by_pk( $id );
		redirect( base_url( 'sz_admin/goods/index' ) );
	}

}
