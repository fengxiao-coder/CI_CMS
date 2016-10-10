<?php
/**
 * admin模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Admin_Model extends MY_Model
{
	public $list_array=array(
         'group_id' => '管理员组' ,
         'user_name' => '姓名' ,
         'real_name' => '真实姓名' ,
         'email' => '邮箱' ,
         'dep' => '所属部门ID' ,
         'status' => '状态' ,
	);

	public $form_array=array(
     
         'group_id' => '管理员组' ,
         'user_name' => '姓名' ,
         'real_name' => '真实姓名' ,
         'password' => '密码' ,
         'email' => '邮箱' ,
         'description' => '描述' ,
         'begin_time' => '开始时间' ,
         'end_time' => '结束时间' ,
         'dep' => '所属部门ID' ,
         'login_count' => '登录次数' ,
         'last_login_time' => '最后登录时间' ,
         'last_login_ip' => '最后登录IP' ,
         'created' => '添加时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
      
        array('field' => 'group_id' , 'label' => '管理员组' , 'rules' => 'required'),
        array('field' => 'user_name' , 'label' => '姓名' , 'rules' => 'required'),
        array('field' => 'real_name' , 'label' => '真实姓名' , 'rules' => 'required'),
        array('field' => 'password' , 'label' => '密码' , 'rules' => 'required'),
        array('field' => 'email' , 'label' => '邮箱' , 'rules' => 'required'),
        
  

        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'admin_id';
		$this->_attributes = array( 
				'admin_id' => '',
				'store_id'=>'',
				'group_id' => '',
				'user_name' => '',
				'real_name' => '',
				'password' => '',
				'email' => '',
				'description' => '',
				'begin_time' => '',
				'end_time' => '',
				'dep' => '',
				'login_count' => '',
				'last_login_time' => '',
				'last_login_ip' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
        
        	/**
	 * 检查用户是否通过验证
	 * 
	 * @access public
	 * @param string - $name 用户名
	 * @param string - $password 密码
	 * @return mixed - FALSE/uid
	 */	
	public function validate_user($username, $password)
	{	
		$data = FALSE;

		$this->db->where('user_name', $username);
		$query = $this->db->get($this->table_name());

		if($query->num_rows() == 1)
		{	
			$data = $query->row_array();
		}

		if(!empty($data))
		{
			if( md5($password) != $data['password'] ) {
				$data = FALSE;
			} else {
				//修改用户上次登录日期
				$attribute = array( 'last_login'=>time() );
				//$this->update_by_pk( $attribute, $data['admin_id'] );
			}
			//$data = (md5($password)==$data['password']) ? $data : FALSE 
		}
		$query->free_result();
		return $data;
	}

}