<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller{
	public $layout = "layouts/main";

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('auth');
	}

	/**
	 * 登录
	 * @author 咸洪伟
	 */
	public function index(){
		if($this->auth->hasLogin())
		{	
			redirect(base_url('admin/main/index'));
		}
		$this->form_validation->set_rules('name', '用户名', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('password', '密码', 'required|trim');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->load->view_part('sz_admin/main/login');
		}
		else
		{	
			$user = $this->admin_model->validate_user( $this->input->post('name', TRUE),$this->input->post('password', TRUE));
			if(!empty($user))
			{
				if($this->auth->process_login($user))
				{	
					 $this->session->set_userdata('user_id', $user['admin_id']);
					redirect(base_url('sz_admin/main/index'));
				}
			}
			else
			{
				sleep(1);				

				$this->session->set_flashdata('login_error', 'TRUE');
				$this->form_validation->error_str='用户名或密码无效';
				$this->load->view_part('sz_admin/main/login');
			}
		}

	}

	/**
	 * 登出
	 * @author 咸洪伟
	 */
	public function login_out(){
		$this->auth->process_logout();
	}
}
