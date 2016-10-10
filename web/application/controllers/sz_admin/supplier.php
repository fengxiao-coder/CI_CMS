<?php

/**
 * supplier
 * @version 1.0
 * @package application
 * @subpackage application/controllers/supplier/
 */
class Supplier extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('supplier_model');
    }

    public function index() {
        $attributes = $this->input->get();
        $search['attributes'] = $attributes;
        // 总数与分页
        $total = $this->supplier_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('sz_admin/supplier/index'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();

        $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());
        $data['supplier_data'] = $this->supplier_model->all($search);
        $this->load->view('sz_admin/supplier/index', $data);
    }

}
