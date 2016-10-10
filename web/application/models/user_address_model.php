<?php
/**
 * user_address模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class User_address_Model extends MY_Model
{
	public $list_array=array(
         'address_id' => 'address_id' ,
         'user_id' => 'user_id' ,
         'consignee' => 'consignee' ,
         'email' => 'email' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'area' => 'area' ,
         'address' => 'address' ,
		'mark' => 'mark' ,
         'zipcode' => 'zipcode' ,
         'tel' => 'tel' ,
         'mobile' => 'mobile' ,
	);

	public $form_array=array(
         'address_id' => 'address_id' ,
         'user_id' => 'user_id' ,
         'consignee' => 'consignee' ,
         'email' => 'email' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'area' => 'area' ,
         'address' => 'address' ,
		'mark' => 'mark' ,
         'zipcode' => 'zipcode' ,
         'tel' => 'tel' ,
         'mobile' => 'mobile' ,
	);

	public $_rule_config=array(
        array('field' => 'address_id' , 'label' => 'address_id' , 'rules' => 'required'),
        array('field' => 'user_id' , 'label' => 'user_id' , 'rules' => 'required'),
        array('field' => 'consignee' , 'label' => 'consignee' , 'rules' => 'required'),
        array('field' => 'email' , 'label' => 'email' , 'rules' => 'required'),
        array('field' => 'province' , 'label' => 'province' , 'rules' => 'required'),
        array('field' => 'city' , 'label' => 'city' , 'rules' => 'required'),
        array('field' => 'area' , 'label' => 'area' , 'rules' => 'required'),
        array('field' => 'address' , 'label' => 'address' , 'rules' => 'required'),
        array('field' => 'zipcode' , 'label' => 'zipcode' , 'rules' => 'required'),
        array('field' => 'tel' , 'label' => 'tel' , 'rules' => 'required'),
        array('field' => 'mobile' , 'label' => 'mobile' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'address_id';
		$this->_attributes = array( 
				'address_id' => '',
				'user_id' => '',
				'consignee' => '',
				'email' => '',
				'province' => '',
				'city' => '',
				'area' => '',
				'address' => '',
				'mark' => '' ,
				'zipcode' => '',
				'tel' => '',
				'mobile' => '',
		);
	}
}