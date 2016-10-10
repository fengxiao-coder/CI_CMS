<?php

/**
 * user
 * @version 1.0
 * @package application
 * @subpackage application/controllers/user/
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $this->load->model('user_area_model');
        $this->load->model('user_address_model');
    }

    public function index() {
        $search['attributes'] = $this->input->get();
        $search['orders'] = array(
            'user_id' => 'desc'
        );
        
    	if ($this->auth->get_user('store_id')){
        	$search['attributes']['store_id'] = $this->auth->get_user('store_id');
        }
        $total = $this->user_model->total($search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('sz_admin/user/index'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());
        $data['user_data'] = $this->user_model->all($search);
        
        $this->load->view('sz_admin/user/index', $data);
    }

}
