<?php
/**
 * order_info模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Order_info_Model extends MY_Model
{
	public $list_array=array(
         'order_id' => 'order_id' ,
         'order_sn' => 'order_sn' ,
         'user_id' => 'user_id' ,
         'store_id' => '店铺id' ,
         'order_status' => 'order_status' ,
         'shipping_status' => 'shipping_status' ,
         'pay_status' => 'pay_status' ,
		'ele_status' => 'ele_status' ,
         'consignee' => 'consignee' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'district' => 'district' ,
         'address' => 'address' ,
         'zipcode' => 'zipcode' ,
         'tel' => 'tel' ,
         'mobile' => 'mobile' ,
         'email' => 'email' ,
         'postscript' => 'postscript' ,
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'pay_id' => 'pay_id' ,
         'pay_name' => 'pay_name' ,
         'goods_amount' => 'goods_amount' ,
         'shipping_fee' => 'shipping_fee' ,
         'pay_fee' => 'pay_fee' ,
         'add_time' => 'add_time' ,
         'confirm_time' => 'confirm_time' ,
         'pay_time' => 'pay_time' ,
         'shipping_time' => 'shipping_time' ,
	);

	public $form_array=array(
         'order_id' => 'order_id' ,
         'order_sn' => 'order_sn' ,
         'user_id' => 'user_id' ,
         'store_id' => '店铺id' ,
         'order_status' => 'order_status' ,
         'shipping_status' => 'shipping_status' ,
         'pay_status' => 'pay_status' ,
	'ele_status' => 'ele_status' ,
         'consignee' => 'consignee' ,
         'province' => 'province' ,
         'city' => 'city' ,
         'district' => 'district' ,
         'address' => 'address' ,
         'zipcode' => 'zipcode' ,
         'tel' => 'tel' ,
         'mobile' => 'mobile' ,
         'email' => 'email' ,
         'postscript' => 'postscript' ,
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'pay_id' => 'pay_id' ,
         'pay_name' => 'pay_name' ,
         'goods_amount' => 'goods_amount' ,
         'shipping_fee' => 'shipping_fee' ,
         'pay_fee' => 'pay_fee' ,
         'add_time' => 'add_time' ,
         'confirm_time' => 'confirm_time' ,
         'pay_time' => 'pay_time' ,
         'shipping_time' => 'shipping_time' ,
	);

	public $_rule_config=array(
        array('field' => 'order_id' , 'label' => 'order_id' , 'rules' => 'required'),
        array('field' => 'order_sn' , 'label' => 'order_sn' , 'rules' => 'required'),
        array('field' => 'user_id' , 'label' => 'user_id' , 'rules' => 'required'),
        array('field' => 'store_id' , 'label' => '店铺id' , 'rules' => 'required'),
        array('field' => 'order_status' , 'label' => 'order_status' , 'rules' => 'required'),
        array('field' => 'shipping_status' , 'label' => 'shipping_status' , 'rules' => 'required'),
        array('field' => 'pay_status' , 'label' => 'pay_status' , 'rules' => 'required'),
        array('field' => 'consignee' , 'label' => 'consignee' , 'rules' => 'required'),
        array('field' => 'province' , 'label' => 'province' , 'rules' => 'required'),
        array('field' => 'city' , 'label' => 'city' , 'rules' => 'required'),
        array('field' => 'district' , 'label' => 'district' , 'rules' => 'required'),
        array('field' => 'address' , 'label' => 'address' , 'rules' => 'required'),
        array('field' => 'zipcode' , 'label' => 'zipcode' , 'rules' => 'required'),
        array('field' => 'tel' , 'label' => 'tel' , 'rules' => 'required'),
        array('field' => 'mobile' , 'label' => 'mobile' , 'rules' => 'required'),
        array('field' => 'email' , 'label' => 'email' , 'rules' => 'required'),
        array('field' => 'postscript' , 'label' => 'postscript' , 'rules' => 'required'),
        array('field' => 'shipping_id' , 'label' => 'shipping_id' , 'rules' => 'required'),
        array('field' => 'shipping_name' , 'label' => 'shipping_name' , 'rules' => 'required'),
        array('field' => 'pay_id' , 'label' => 'pay_id' , 'rules' => 'required'),
        array('field' => 'pay_name' , 'label' => 'pay_name' , 'rules' => 'required'),
        array('field' => 'goods_amount' , 'label' => 'goods_amount' , 'rules' => 'required'),
        array('field' => 'shipping_fee' , 'label' => 'shipping_fee' , 'rules' => 'required'),
        array('field' => 'pay_fee' , 'label' => 'pay_fee' , 'rules' => 'required'),
        array('field' => 'add_time' , 'label' => 'add_time' , 'rules' => 'required'),
        array('field' => 'confirm_time' , 'label' => 'confirm_time' , 'rules' => 'required'),
        array('field' => 'pay_time' , 'label' => 'pay_time' , 'rules' => 'required'),
        array('field' => 'shipping_time' , 'label' => 'shipping_time' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'order_id';
		$this->_attributes = array( 
				'order_id' => '',
				'order_sn' => '',
				'user_id' => '',
				'store_id' => '',
				'address_id' => '',
				'order_status' => '',
				'shipping_status' => '',
				'pay_status' => '',
				'ele_status' => '' ,
				'consignee' => '',
				'province' => '',
				'city' => '',
				'district' => '',
				'address' => '',
				'mobile' => '',
				'shipping_id' => '',
				'shipping_name' => '',
				'pay_id' => '',
				'pay_name' => '',
				'goods_amount' => '',
				'shipping_fee' => '',
				'pay_fee' => '',
				'add_time' => '',
				'confirm_time' => '',
				'pay_time' => '',
				'shipping_time' => '',
				'status' => '',
		);
	}
	public function order_status($id){
		if($id==0){
			return "未确认";
		}elseif($id==1){
			return "已确认";
		}elseif ($id==2){
			return "已取消";
		}elseif($id==3){
			return "无效";
		}elseif($id==4){
			return "已退货";
		}
	}
	
	public function shipping_status($id){
		if($id==0){
			return "未发货";
		}elseif($id==1){
			return "已发货";
		}elseif ($id==2){
			return "已收货";
		}elseif($id==3){
			return "退货";
		}
	}
	
	public function pay_status($id){
		if($id==0){
			return "未付款";
		}elseif($id==1){
			return "付款中";
		}elseif ($id==2){
			return "已付款";
		}
	}
	
}