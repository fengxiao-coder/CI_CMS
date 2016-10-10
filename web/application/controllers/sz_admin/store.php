<?php
/**
 * store
 * @version 1.0
 * @package application
 * @subpackage application/controllers/store/
 */
class Store extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("store_model");
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $this->load->model('user_area_model');
        $search['attributes'] = $this->input->get();
        $search['orders'] = array(
            'id' => 'desc'
        );
        if ($this->auth->get_user('store_id')){
        	$search['attributes']['id'] = $this->auth->get_user('store_id');
        }
        $total = $this->store_model->total($search);
        
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('sz_admin/store/index'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());
        $data['store_data'] = $this->store_model->all($search);
        
        $this->load->view('sz_admin/store/index', $data);
    }

    public function add() {
        $this->load->model("store_model");
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $pro_arr = $this->user_province_model->all();
        $data['pro_arr'] = $pro_arr;
        if ($this->input->post('is_submit')) {
            try {
                $store_data = $this->input->post();
                $data['store_data'] = $store_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'sName', 'label' => '名称', 'rules' => 'required'),
                    array('field' => 'province', 'label' => '省份', 'rules' => 'required'),
                    array('field' => 'city', 'label' => '城市', 'rules' => 'required'),
                    array('field' => 'sAddr', 'label' => '地址', 'rules' => 'required'),
                    array('field' => 'sPhone', 'label' => '电话', 'rules' => 'required'),
                    array('field' => 'sUser', 'label' => '联系人', 'rules' => 'required'),                    
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //插入                              
                $id = $this->store_model->insert($store_data);
                //插入二维码
                $prephoto = $this->common->set_storecore($id);
                $data['prephoto'] = "uploads/store_core/" . $prephoto;
                $this->store_model->update_by_pk(array('prephoto' => $data['prephoto']), $id);
                
                
                $num = $this->user_city_model->get_value_by_pk($store_data["city"], "number");
                if (strlen($id) == 1) {
                    $store_info['bar_code'] = $num . "00" . $id;
                    $this->store_model->update_by_pk($store_info, $id);
                } elseif (strlen($id) == 2) {
                    $store_info['bar_code'] = $num . "0" . $id;
                    $this->store_model->update_by_pk($store_info, $id);
                } else {
                    $store_info['bar_code'] = $num . $id;
                    $this->store_model->update_by_pk($store_info, $id);
                }
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/store/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/store/form', $data);
    }

    public function edit($id) {
        $this->load->model("store_model");
        $this->load->model('user_province_model');
        $pro_arr = $this->user_province_model->all();
        $data['pro_arr'] = $pro_arr;
        $data['store_data'] = $this->store_model->get_by_pk($id);
        if ($this->input->post('is_submit') && $this->form_validation->check_token()) {
            try {
                $store_data = $this->input->post();
                $data['store_data'] = $store_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'sName', 'label' => '名称', 'rules' => 'required'),
                    array('field' => 'sAddr', 'label' => '地址', 'rules' => 'required'),
                    array('field' => 'sPhone', 'label' => '电话', 'rules' => 'required'),
                    array('field' => 'province', 'label' => '省份', 'rules' => 'required'),
                    array('field' => 'city', 'label' => '城市', 'rules' => 'required'),
                    array('field' => 'area', 'label' => '区域', 'rules' => 'required'),
                    array('field' => 'sUser', 'label' => '联系人', 'rules' => 'required')
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //修改
                $this->store_model->update_by_pk($data['store_data'], $id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/store/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/store/form', $data);
    }

    public function view($id) {
        $this->load->model("store_model");
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $this->load->model('user_area_model');
        $data['store_data'] = $this->store_model->get_by_pk($id);
        $this->load->view('sz_admin/store/view', $data);
    }

}
