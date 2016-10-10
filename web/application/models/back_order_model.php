<?php
/**
 * back_order模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Back_order_Model extends MY_Model
{
	public $list_array=array(
         'back_id' => 'back_id' ,
         'rec_id' => 'rec_id' ,
         'delivery_sn' => 'delivery_sn' ,
         'order_id' => 'order_id' ,
         'invoice_no' => 'invoice_no' ,
         'add_time' => 'add_time' ,
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'user_id' => 'user_id' ,
         'action_user' => 'action_user' ,
         'consignee' => 'consignee' ,
         'address' => 'address' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'district' => 'district' ,
         'mobile' => 'mobile' ,
         'how_oos' => 'how_oos' ,
         'shipping_fee' => 'shipping_fee' ,
         'update_time' => 'update_time' ,
         'store_id' => 'store_id' ,
         'status' => 'status' ,
         'return_time' => 'return_time' ,
	);

	public $form_array=array(
         'back_id' => 'back_id' ,
         'rec_id' => 'rec_id' ,
         'delivery_sn' => 'delivery_sn' ,
         'order_id' => 'order_id' ,	 	
         'invoice_no' => 'invoice_no' ,
         'add_time' => 'add_time' ,
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'user_id' => 'user_id' ,
         'action_user' => 'action_user' ,
         'consignee' => 'consignee' ,
         'address' => 'address' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'district' => 'district' ,
         'mobile' => 'mobile' ,
         'how_oos' => 'how_oos' ,
         'shipping_fee' => 'shipping_fee' ,
         'update_time' => 'update_time' ,
         'store_id' => 'store_id' ,
         'status' => 'status' ,
         'return_time' => 'return_time' ,
	);

	public $_rule_config=array(
        array('field' => 'back_id' , 'label' => 'back_id' , 'rules' => 'required'),
        array('field' => 'rec_id' , 'label' => 'rec_id' , 'rules' => 'required'),
        array('field' => 'delivery_sn' , 'label' => 'delivery_sn' , 'rules' => 'required'),
        array('field' => 'order_id' , 'label' => 'order_id' , 'rules' => 'required'),
        array('field' => 'invoice_no' , 'label' => 'invoice_no' , 'rules' => 'required'),
        array('field' => 'add_time' , 'label' => 'add_time' , 'rules' => 'required'),
        array('field' => 'shipping_id' , 'label' => 'shipping_id' , 'rules' => 'required'),
        array('field' => 'shipping_name' , 'label' => 'shipping_name' , 'rules' => 'required'),
        array('field' => 'user_id' , 'label' => 'user_id' , 'rules' => 'required'),
        array('field' => 'action_user' , 'label' => 'action_user' , 'rules' => 'required'),
        array('field' => 'consignee' , 'label' => 'consignee' , 'rules' => 'required'),
        array('field' => 'address' , 'label' => 'address' , 'rules' => 'required'),
        array('field' => 'province' , 'label' => 'province' , 'rules' => 'required'),
        array('field' => 'city' , 'label' => 'city' , 'rules' => 'required'),
        array('field' => 'district' , 'label' => 'district' , 'rules' => 'required'),
        array('field' => 'mobile' , 'label' => 'mobile' , 'rules' => 'required'),
        array('field' => 'how_oos' , 'label' => 'how_oos' , 'rules' => 'required'),
        array('field' => 'shipping_fee' , 'label' => 'shipping_fee' , 'rules' => 'required'),
        array('field' => 'update_time' , 'label' => 'update_time' , 'rules' => 'required'),
        array('field' => 'store_id' , 'label' => 'store_id' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
        array('field' => 'return_time' , 'label' => 'return_time' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'back_id';
		$this->_attributes = array( 
				'back_id' => '',
				'rec_id' => '',
				'delivery_sn' => '',
				'order_id' => '',
				'order_sn' => 'order_sn' ,
				'invoice_no' => '',
				'add_time' => '',
				'shipping_id' => '',
				'shipping_name' => '',
				'user_id' => '',
				'action_user' => '',
				'consignee' => '',
				'address' => '',
				'province' => '',
				'city' => '',
				'district' => '',
				'mobile' => '',
				'how_oos' => '',
				'shipping_fee' => '',
				'update_time' => '',
				'store_id' => '',
				'status' => '',
				'return_time' => '',
		);
	}
}