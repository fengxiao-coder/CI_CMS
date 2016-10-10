<?php
/**
 * customer模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Customer_Model extends MY_Model
{
	public $list_array=array(
//         'id' => '客户id' ,
         'name' => '真实姓名' ,
         'nick_name' => '昵称' ,
         'phone' => '联系电话' ,
         'e_mail' => '邮箱' ,
         'ship_address' => '收货地址' ,
	);
	public $search_array=array(
         'name' => '真实姓名' ,
         'nick_name' => '昵称' ,
         'e_mail' => '邮箱' ,

	);

	public $form_array=array(
//         'id' => '客户id' ,
         'name' => '真实姓名' ,
         'nick_name' => '昵称' ,
         'phone' => '联系电话' ,
         'e_mail' => '邮箱' ,
         'ship_address' => '收货地址' ,
	);

	public $_rule_config=array(
//        array('field' => 'id' , 'label' => '客户id' , 'rules' => 'required'),
        array('field' => 'name' , 'label' => '真实姓名' , 'rules' => 'required'),
        array('field' => 'nick_name' , 'label' => '昵称' , 'rules' => 'required'),
        array('field' => 'phone' , 'label' => '联系电话' , 'rules' => 'required'),
        array('field' => 'e_mail' , 'label' => '邮箱' , 'rules' => 'required'),
        array('field' => 'ship_address' , 'label' => '收货地址' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'name' => '',
				'nick_name' => '',
				'phone' => '',
				'e_mail' => '',
				'ship_address' => '',
		);
	}
}