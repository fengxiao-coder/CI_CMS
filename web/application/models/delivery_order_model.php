<?php
/**
 * delivery_order模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Delivery_order_Model extends MY_Model
{
	public $list_array=array(
         'delivery_id' => 'delivery_id' ,
         'delivery_sn' => '发货单流水号' ,
         'order_sn' => 'order_sn' ,
         'order_id' => 'order_id' ,
         'add_time' => 'add_time' ,
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'user_id' => '用户id' ,
         'consignee' => '收货人' ,
         'address' => 'address' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'district' => 'district' ,
         'email' => 'email' ,
         'tel' => 'tel' ,
         'mobile' => 'mobile' ,
         'shipping_fee' => 'shipping_fee' ,
         'update_time' => 'update_time' ,
         'store_id' => '店铺' ,
         'status' => 'status' ,
	);

	public $form_array=array(
         'delivery_id' => 'delivery_id' ,
         'delivery_sn' => '发货单流水号' ,
         'order_sn' => 'order_sn' ,
         'order_id' => 'order_id' ,
         'add_time' => 'add_time' ,
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'user_id' => '用户id' ,
         'consignee' => '收货人' ,
         'address' => 'address' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'district' => 'district' ,
         'email' => 'email' ,
         'tel' => 'tel' ,
         'mobile' => 'mobile' ,
         'shipping_fee' => 'shipping_fee' ,
         'update_time' => 'update_time' ,
         'store_id' => '店铺' ,
         'status' => 'status' ,
	);

	public $_rule_config=array(
        array('field' => 'delivery_id' , 'label' => 'delivery_id' , 'rules' => 'required'),
        array('field' => 'delivery_sn' , 'label' => '发货单流水号' , 'rules' => 'required'),
        array('field' => 'order_sn' , 'label' => 'order_sn' , 'rules' => 'required'),
        array('field' => 'order_id' , 'label' => 'order_id' , 'rules' => 'required'),
        array('field' => 'add_time' , 'label' => 'add_time' , 'rules' => 'required'),
        array('field' => 'shipping_id' , 'label' => 'shipping_id' , 'rules' => 'required'),
        array('field' => 'shipping_name' , 'label' => 'shipping_name' , 'rules' => 'required'),
        array('field' => 'user_id' , 'label' => '用户id' , 'rules' => 'required'),
        array('field' => 'consignee' , 'label' => '收货人' , 'rules' => 'required'),
        array('field' => 'address' , 'label' => 'address' , 'rules' => 'required'),
        array('field' => 'province' , 'label' => 'province' , 'rules' => 'required'),
        array('field' => 'city' , 'label' => 'city' , 'rules' => 'required'),
        array('field' => 'district' , 'label' => 'district' , 'rules' => 'required'),
        array('field' => 'email' , 'label' => 'email' , 'rules' => 'required'),
        array('field' => 'tel' , 'label' => 'tel' , 'rules' => 'required'),
        array('field' => 'mobile' , 'label' => 'mobile' , 'rules' => 'required'),
        array('field' => 'shipping_fee' , 'label' => 'shipping_fee' , 'rules' => 'required'),
        array('field' => 'update_time' , 'label' => 'update_time' , 'rules' => 'required'),
        array('field' => 'store_id' , 'label' => '店铺' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'delivery_id';
		$this->_attributes = array( 
				'delivery_id' => '',
				'delivery_sn' => '',
				'order_sn' => '',
				'order_id' => '',
				'invoice_no' => '',
				'add_time' => '',
				'shipping_id' => '',
				'shipping_name' => '',
				'user_id' => '',
				'consignee' => '',
				'address' => '',
				'province' => '',
				'city' => '',
				'district' => '',
				'email' => '',
				'tel' => '',
				'mobile' => '',
				'shipping_fee' => '',
				'update_time' => '',
				'store_id' => '',
				'status' => '',
		);
	}
}