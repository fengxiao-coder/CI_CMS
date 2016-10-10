<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 权限,用户身份验证
 * @author 咸洪伟
 */
class Auth {

    /**
     * 用户
     *
     * @access private
     * @var array
     */
    private $_user = array();

    /**
     * 是否已经登录
     *
     * @access private
     * @var boolean
     */
    private $_hasLogin = NULL;

    /**
     * 用户组
     *
     * @access public
     * @var array
     */
    public $groups = array();
    //用户组权限
    private $_group_operations = array();

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
    
    private  $_no_check_arr = array();


    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct() {
        /** 获取CI句柄 */
        $this->_CI = & get_instance();

        $this->_CI->load->model('user_model');

        $this->_user = unserialize($this->_CI->session->userdata('user'));

        if ($this->_CI->uri->segment(1) === FALSE) {
            $this->_module = 0;
        } else {
            $this->_module = $this->_CI->uri->segment(1);
        }

        if ($this->_CI->uri->segment(2) === FALSE) {
            $this->_controller = 0;
        } else {
            $this->_controller = $this->_CI->uri->segment(2);
        }

        if ($this->_CI->uri->segment(3) === FALSE) {
            $this->_action = 'index';
        } else {
            $this->_action = $this->_CI->uri->segment(3);
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
        $this->_CI->load->model("admin_model");
        if (NULL !== $this->_hasLogin) {
            return $this->_hasLogin;
        } else {
            if (!empty($this->_user) && NULL !== $this->_user['admin_id']) {
                $user = $this->_CI->admin_model->get_by_pk($this->_user['admin_id']);

                if ($user) {
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
     * 判断用户权限
     * @access 	public
     * @return 	boolean
     */
    /* public function check($controller='',$action='')
      {
      //如果不是后台的路径则无需验证
      if ( $this->_module!='admin') return;

      if ( $this->_controller=='site'||$this->_controller=='login') return;

      if ( $this->_is_special ) return;

      $this->_init_grouppermission();
      fb($this->_group_operations);

      if ( $controller && $action ) {
      // 手动检测
      $module_action = "{$controller}_{$action}";
      if ( !isset( $this->_group_operations[$module_action] ) ){
      //fb("无菜单权限".$module_action);
      //return FALSE;
      }else{
      //fb("有菜单权限".$module_action);
      }
      } else {

      // 用于开发阶段将所有节点记录
      //$this->_save_module_action();
      //@todo remove
      // 自动检测当前访问的uri
      $module_action = "{$this->_controller}_{$this->_action}";
      fb($module_action);
      //return TRUE;
      if ( !isset( $this->_group_operations[$module_action] ) ){
      fb("无操作权限".$module_action);
      //redirect( base_url( 'admin/site/error' ) );
      }else{
      fb("有操作权限".$module_action);
      }
      }

      return TRUE;
      } */

    /**
     * 判断用户权限
     * @access 	public
     * @return 	boolean
     */
    public function check($controller = '', $action = '') {

        //如果不是后台的路径则无需验证

        if ($this->_module != 'sz_admin') return;

        if (in_array($this->_action, array_keys($this->_no_check_arr)) && in_array($this->_controller, $this->_no_check_arr))return 1;
        // if( $this->_CI->auth->get_user('admin_id') == 79 )return 1;
        //if ( $this->_controller=='site'||$this->_controller=='login') return;
        $this->_init_grouppermission($controller, $action);

        

        fb($this->_group_operations);
        if ($controller && $action) {
            // 手动检测
            if ($this->_group_operations['admin_group_operations'] || $this->_group_operations['admin_operations']) {
                //fb("有菜单权限".$module_action);
                return TRUE;
            } else {
                return FALSE;
                //fb("无菜单权限".$module_action);
            }
        }
        if ($this->_controller == 'main' || $this->_controller == 'login')
            return TRUE;
        if ($this->_is_special)
            return;

        if (!$controller && !$action) {

            // 用于开发阶段将所有节点记录
            $this->_save_module_action();
            //@todo remove
            // 自动检测当前访问的uri
            $module_action = "{$this->_controller}_{$this->_action}";
            fb($module_action);
            //return TRUE;
            // 
            if ($this->_group_operations['admin_group_operations'] || $this->_group_operations['admin_operations']) {
                fb("有操作权限" . $module_action);
            } else {
             //   fb("无操作权限" . $module_action);
                redirect(base_url('sz_admin/site/error'));
            }
        }

        return TRUE;
    }

    /**
     * 处理用户登出
     * @access public
     * @return void
     */
    public function process_logout() {
        $this->_CI->session->sess_destroy();

        redirect('sz_admin/login');
    }

    /**
     * 处理用户登入
     * @access public
     * @param  array $user 用户信息
     * @return boolean
     */
    public function process_login($user) {
        /** 获取用户信息 */
        $this->_user = $user;
        if ($this->_user) {
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
        $session_data = array('user' => serialize($this->_user));

        $this->_CI->session->set_userdata($session_data);
    }

    /**
     * 获取登录用户的信息
     */
    public function get_user($field = '') {
        if (!$field) {
            return $this->_user;
        } else {
            return $this->_user[$field];
        }
    }

    /**
     * 初始化用户组权限
     */
    /* 	private function _init_grouppermission(){
      fb('here');
      $group_id= $this->_user['group_id'];
      // 权限组ID为空的 一般是没有登陆
      if ( empty( $group_id ) ) {
      $this->_is_special = TRUE;
      return;
      }

      // 如果是ajax 不做权限检查
      if ( $this->_CI->input->is_ajax_request() ) {
      $this->_is_special = TRUE;
      return;
      }

      if(!$this->_group_operations){
      $this->_group_operations=array();

      $this->_CI->load->model('admin_group_operations_model');
      $g_search['attributes']=array('group_id'=>$group_id);
      $grouppermissions=$this->_CI->admin_group_operations_model->all($g_search);

      $ids=array();
      foreach($grouppermissions as $v){
      $ids[]=$v['operations_id'];
      }

      $this->_CI->load->model('operations_model');
      if(!$ids) return;
      $o_search['in']=array('operation_id'=>$ids);
      $permissions= $this->_CI->operations_model->all($o_search);

      foreach($permissions as $v){
      $key=$v['module'].'_'.$v['action'];
      $this->_group_operations[$key]=$v['operation_name'];
      }
      }
      } */

    /**
     * 初始化用户组权限
     */
    private function _init_grouppermission($controller = '', $action = '') {
        fb('here');
        $group_id = explode(',', $this->_user['group_id']);
        // 权限组ID为空的 一般是没有登陆
        if (empty($group_id)) {
            $this->_is_special = TRUE;
            return;
        }

        // 如果是ajax 不做权限检查
        if ($this->_CI->input->is_ajax_request()) {
            $this->_is_special = TRUE;
            return;
        }
        $this->_group_operations = array();
        if (!$this->_group_operations) {
            $this->_group_operations = array();

            $this->_CI->load->model('operations_model');
            $controller = $controller ? $controller : $this->_controller;
            $action = $action ? $action : $this->_action;
            $op_search['attributes'] = array(
                'module' => $controller,
                'action' => $action
            );
            //p($op_search);
            $operations_data = $this->_CI->operations_model->all($op_search);
            if (!empty($operations_data)) {


                $this->_CI->load->model('admin_group_operations_model');
                $g_search['in'] = array('group_id' => $group_id);
                $g_search['attributes'] = array('operations_id' => $operations_data[0]['operation_id']);
                $grouppermissions = $this->_CI->admin_group_operations_model->all($g_search);


                $this->_CI->load->model('admin_operations_model');
                $search['attributes'] = array('admin_id' => $this->_user['admin_id'], 'operations_id' => $operations_data[0]['operation_id']);
                $operations = $this->_CI->admin_operations_model->all($search);
                $this->_group_operations['admin_group_operations'] = $grouppermissions;
                $this->_group_operations['admin_operations'] = $operations;
            } else {
                if ($controller == 'main') {
                    $this->_group_operations['admin_group_operations'] = TRUE;
                    $this->_group_operations['admin_operations'] = TRUE;
                } else {
                    $this->_group_operations['admin_group_operations'] = '';
                    $this->_group_operations['admin_operations'] = '';
                }
            }
        }
    }

    //获取用户组权限
    public function get_group_operations() {
        return $this->_group_operations;
    }

    /**
     * 注意
     * 仅限于开发阶段收集权限节点用
     */
    private function _save_module_action() {
        if (!defined('ENVIRONMENT') && ENVIRONMENT != 'development')
            return;
        $this->_CI->load->model('operations_model');
        $b_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $url = str_replace(base_url(), '', $b_url);
        $operations_data = $this->_CI->operations_model->get_by_module_action($this->_controller, $this->_action);
        //$operations_data = array();
        if (empty($operations_data)) {
            // 不存在插入
            $operations_data1 = $this->_CI->operations_model->get_by_module_action($this->_controller, 'index');
            $o_name = "";
            if (isset($_GET["operations_type_id"])) {
                $operations_type_id = $_GET["operations_type_id"];
            } else {
                $operations_type_id = $operations_data1['operations_type_id'];
            }
            if (isset($_GET["operation_name"])) {
                $operation_name = $_GET["operation_name"];
            } else {
                $operation_name = $operations_data1['operation_name'];
                if ($this->_action == "add") {
                    $o_name = "添加";
                } elseif ($this->_action == "view") {
                    $o_name = "查看";
                } elseif ($this->_action == "edit") {
                    $o_name = "修改";
                } elseif ($this->_action == "delete") {
                    $o_name = "删除";
                } else {
                    $o_name = "查看_M_" . $this->_controller . "_A_" . $this->_action;
                }
            }
            $this->_CI->operations_model->insert(array(
                'name' => $this->_controller . '_' . $this->_action,
                'module' => $this->_controller,
                'action' => $this->_action,
                'operation_name' => $operation_name . $o_name,
                'operations_type_id' => $operations_type_id,
                'url' => $url,
            ));
        }
    }
    public function get_name_model(){
        return $this->_controller;
    }
    public function get_name_action(){
        return $this->_action;
    }	
}
