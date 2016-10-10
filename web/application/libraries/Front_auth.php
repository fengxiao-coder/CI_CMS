<?php

if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * 权限,用户身份验证
 * @author 咸洪伟
 */
class Front_auth
{

	/**
	 * 用户
	 *
	 * @access private
	 * @var array
	 */
	private $_user = array( );

	/**
	 * 是否已经登录
	 *
	 * @access private
	 * @var boolean
	 */
	private $_hasLogin = NULL;

	/**
	 * CI句柄
	 *
	 * @access private
	 * @var object
	 */
	private $_CI;

	/**
	 * 是否是特殊情况，ajax情况，或者未找到用户组
	 */
	private $_is_special = FALSE;

	/**
	 * 当前模块名,指的是前台还是后台 front,admin
	 * @var string
	 */
	private $_module;

	/**
	 * 当前控制器名
	 * @var string
	 */
	private $_controller;

	/**
	 * 当前动作
	 * @var string
	 */
	private $_action;

	/**
	 * 构造函数
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		/** 获取CI句柄 */
		$this->_CI = & get_instance();

		$this->_CI->load->model( 'unit_model' );

		$this->_user = $this->_CI->session->userdata( 'user_session' );

		if ( $this->_CI->uri->segment( 1 ) === FALSE ) {
			$this->_module = 0;
		} else {
			$this->_module = $this->_CI->uri->segment( 1 );
		}

		if ( $this->_CI->uri->segment( 2 ) === FALSE ) {
			$this->_controller = 0;
		} else {
			$this->_controller = $this->_CI->uri->segment( 2 );
		}

		if ( $this->_CI->uri->segment( 3 ) === FALSE ) {
			$this->_action = 'index';
		} else {
			$this->_action = $this->_CI->uri->segment( 3 );
		}
	}

	/**
	 * 判断用户是否已经登录
	 *
	 * @access public
	 * @return void
	 */
	public function hasLogin() {
		/** 检查session，并与数据库里的数据相匹配 */
		//var_dump($this->_user);
		if ( NULL !== $this->_hasLogin ) {
			return $this->_hasLogin;
		} else {
			if ( !empty( $this->_user ) && NULL !== $this->_user['user_id'] ) {
				$user = $this->_CI->unit_model->get_by_pk( $this->_user['user_id'] );
				if ( $user ) {
					return ($this->_hasLogin = TRUE);
				}
			}
			return ($this->_hasLogin = FALSE);
		}
	}

	public function get_module() {
		$str = $this->_module;
		$str.="_";
		$str.= $this->_controller;
		$str.="_";
		$str.= $this->_action;
		return $str;
	}

	/**
	 * 处理用户登出
	 * @access public
	 * @return void
	 */
	public function process_logout() {
		$this->_CI->session->sess_destroy();
		redirect( 'front/index' );
	}

	/**
	 * 处理用户登入
	 * @access public
	 * @param  array $user 用户信息
	 * @return boolean
	 */
	public function process_login( $user ) {
		/** 获取用户信息 */
		$this->_user = $user;

		if ( $this->_user ) {
			/** 设置session */
			$this->_set_session();
			$this->_hasLogin = TRUE;

			return TRUE;
		}

		return FALSE;
	}

	/**
	 * 设置session
	 *
	 * @access private
	 * @return void
	 */
	private function _set_session() {
		$array = array( "user_id" => $this->_user['id'],"modifed"=>$this->_user['modifed'], "user_name" => $this->_user['account_name'], "user_passwd" => $this->_user['account_password']);
		$session_data = array( 'user_session' => $array );
		$this->_CI->session->set_userdata( $session_data );
	}

	/**
	 * 获取登录用户的信息
	 */
	public function get_user( $field = '' ) {
		if ( !$field ) {
			return $this->_user;
		} else {
			return $this->_user[$field];
		}
	}

}
