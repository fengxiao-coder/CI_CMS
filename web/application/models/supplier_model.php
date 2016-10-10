<?php
/**
 * supplier模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Supplier_Model extends MY_Model
{
	public $list_array=array(
//         'id' => '供货商id' ,
         'name' => '单位名称' ,
         'phone' => '单位电话号码' ,
         'address' => '单位地址' ,
         'person' => '联系人' ,
         'person_tp' => '联系人电话' ,
         'email' => 'E-mail' ,
	);
        
	public $search_array=array(
//         'id' => '供货商id' ,
         'name' => '单位名称' ,
         'person' => '联系人' ,
         'email' => 'E-mail' ,
	);

	public $form_array=array(
//         'id' => '供货商id' ,
         'name' => '单位名称' ,
         'phone' => '单位电话号码' ,
         'address' => '单位地址' ,
         'person' => '联系人' ,
         'person_tp' => '联系人电话' ,
         'email' => 'E-mail' ,
	);

	public $_rule_config=array(
//        array('field' => 'id' , 'label' => '供货商id' , 'rules' => 'required'),
        array('field' => 'name' , 'label' => '单位名称' , 'rules' => 'required'),
        array('field' => 'phone' , 'label' => '单位电话号码' , 'rules' => 'required'),
        array('field' => 'address' , 'label' => '单位地址' , 'rules' => 'required'),
        array('field' => 'person' , 'label' => '联系人' , 'rules' => 'required'),
        array('field' => 'person_tp' , 'label' => '联系人电话' , 'rules' => 'required'),
        array('field' => 'email' , 'label' => 'E-mail' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'name' => '',
				'phone' => '',
				'address' => '',
				'person' => '',
				'person_tp' => '',
				'email' => '',
		);
	}
}