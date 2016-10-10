<?php
/**
 * admin
 * @version 1.0
 * @package application
 * @subpackage application/controllers/admin/
 */
class Admin extends MY_Controller {

    public $guan_admin_id = '';

    public function __construct() {
        parent::__construct();
        $this->load->model('config_model');
        $this->load->model("admin_group_model");
        $this->guan_admin_id = $this->config_model->get_value_by_key("admin_id");
    }

    public function index() {
        $this->load->model('store_model');
        $attributes = $this->input->get();
        $search['attributes'] = $attributes;
        // 总数与分页        
        if ($this->guan_admin_id != $this->auth->get_user('admin_id')) {        	
            $search['attributes']['admin_id_notequal'] = $this->guan_admin_id;
        	if ($this->auth->get_user('store_id') && $this->auth->get_user('group_id')!=16){
        		$search['attributes']['store_id'] =$this->auth->get_user('store_id');
        	}elseif ($this->auth->get_user('store_id') && $this->auth->get_user('group_id')==16){
        		$search['attributes']['store_id'] =$this->auth->get_user('store_id');
        		$search['attributes']['admin_id'] =$this->auth->get_user('admin_id');
        	}else{
        		$search['attributes']['admin_id'] = $this->auth->get_user('admin_id');
        	}
            
        }
		
        $total = $this->admin_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('admin/admin/index'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());
        $data['admin_data'] = $this->admin_model->all($search);
        
        $this->load->view('sz_admin/admin/index', $data);
    }

    /**
     * view 显示详细页
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function view($id) {
        $data['admin_data'] = $this->admin_model->get_by_pk($id);
        $this->load->view('sz_admin/admin/view', $data);
    }

    /**
     * add 添加
     * @author 咸洪伟
     */
    public function add() {
        $this->load->model('store_model');
        $data = array();
        if ($this->input->post('is_submit')) {
            try {
                $admin_data = $this->input->post();
                if ($this->auth->get_user('store_id')){
                	$admin_data['store_id']=$this->auth->get_user('store_id');
                }
                //p($admin_data);
                $admin_data['password'] = md5($admin_data['password']);
                $data['admin_data'] = $admin_data;
                $data['real_name'] = $data['user_name'];

                $data['admin_data']['group_id'] = join(",", $admin_data['group_id']);
                //设置验证规则
                $rule_config = array(
                    array('field' => 'user_name', 'label' => '姓名', 'rules' => 'required'),
                    array('field' => 'password', 'label' => '密码', 'rules' => 'required'),
                    array('field' => 'password2', 'label' => '确认密码', 'rules' => 'required'),
                    //array('field' => 'store_id', 'label' => '店铺', 'rules' => 'required'),
                    array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
                    array('field' => 'group_id', 'label' => '权限组', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //插入
                $admin_id = $this->admin_model->insert($data['admin_data']);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/admin/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $data['store_name'] = $this->store_model->get_appoint_values(array('id', 'sName'));
        $this->load->view('sz_admin/admin/form', $data);
    }

    /**
     * edit 编辑
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function edit($id) {
        $this->load->model('store_model');
        $data = array();
        $data['admin_data'] = $this->admin_model->get_by_pk($id);
        if ($this->input->post('is_submit')) {
            try {
                $admin_data = $this->input->post();
                fb($admin_data);
                if ($admin_data['password'] !== "") {
                    $admin_data['password'] = md5($admin_data['password']);
                }
                $data['admin_data'] = $admin_data;
                $data['real_name'] = $data['user_name'];
                $data['admin_data']['group_id'] = join(',', $admin_data['group_id']);
                //设置验证规则
                $rule_config = array(
//                  array( 'field' => 'group_id', 'label' => '权限组', 'rules' => 'required' ),
//                  array( 'field' => 'real_name', 'label' => '真实姓名', 'rules' => 'required' )
                    array('field' => 'user_name', 'label' => '姓名', 'rules' => 'required'),
                    //array('field' => 'password', 'label' => '密码', 'rules' => 'required'),
                    //array('field' => 'password2', 'label' => '确认密码', 'rules' => 'required'),
                    //array('field' => 'store_id', 'label' => '店铺', 'rules' => 'required'),
                    array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
                    array('field' => 'group_id', 'label' => '权限组', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //修改
                $this->admin_model->update_by_pk($data['admin_data'], $id);
                fbq();
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/admin/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $data['admin_data']['group_id'] = explode(',', $data['admin_data']['group_id']);
        $data['store_name'] = $this->store_model->get_appoint_values(array('id', 'sName'));
        //p($data);
        $this->load->view('sz_admin/admin/form', $data);
    }

    /**
     * 修改密码
     * @throws Exception
     */
    public function edit_pwd() {
        $data = array();
        $admin_id = $this->auth->get_user("admin_id");
        $admin_data['admin_id'] = $admin_id;
        $data['admin_data'] = $this->admin_model->get_by_pk($admin_id);
        if ($this->input->post('is_submit') && $this->form_validation->check_token()) {
            try {
                $admin_data = $this->input->post();
                if ($admin_data['now_password'] !== "") {
                    $now_password = md5($admin_data['now_password']);
                    if ($now_password != $data['admin_data']['password'])
                        throw new Exception("请输入正确的当前密码", -1);
                }
                if ($admin_data['new_password'] !== "" && $admin_data['again_password'] !== "") {
                    if (trim($admin_data['new_password']) != trim($admin_data['again_password'])) {
                        throw new Exception("两次输入的新密码不相同", -2);
                    } else {
                        $admin_data['password'] = md5($admin_data['new_password']);
                    }
                }
                $data['admin_data'] = $admin_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'now_password', 'label' => '新的密码', 'rules' => 'required'),
                    array('field' => 'again_password', 'label' => '重复新的密码', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //修改
                $this->admin_model->update_by_pk($admin_data, $admin_data['admin_id']);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/admin/edit_pwd'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view("sz_admin/admin/edit_form", $data);
    }

    /**
     * delete 删除
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function delete($id) {
        $this->admin_model->delete_by_pk($id);
        redirect(base_url('sz_admin/admin/index'));
    }

    /**
     * delete_all 批量删除
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function delete_all() {
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->admin_model->delete_by_pk($id);
        }
        redirect(base_url('sz_admin/admin/index'));
    }

}
