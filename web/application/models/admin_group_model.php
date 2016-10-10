<?php
/**
 * admin_group模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Admin_group_Model extends MY_Model
{
	public $list_array=array(
         'group_id' => 'group_id' ,
         'group_name' => '名称' ,
         'group_description' => '描述' ,
         'created' => '创建时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'group_id' => 'group_id' ,
         'group_name' => '名称' ,
         'group_description' => '描述' ,
         'created' => '创建时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'group_id' , 'label' => 'group_id' , 'rules' => 'required'),
        array('field' => 'group_name' , 'label' => '名称' , 'rules' => 'required'),
        array('field' => 'group_description' , 'label' => '描述' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '创建时间' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改时间' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'group_id';
		$this->_attributes = array( 
				'group_id' => '',
				'group_name' => '',
				'group_description' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}