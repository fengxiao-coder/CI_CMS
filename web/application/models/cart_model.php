<?php
/**
 * cart模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Cart_Model extends MY_Model
{
	public $list_array=array(
         'cart_id' => '购物车ID' ,
         'user_id' => '用户ID' ,
         'goods_id' => '商品ID' ,
         'goods_name' => '商品名称' ,
         'goods_img' => '商品图片' ,
         'goods_attr' => '商品属性' ,
         'goods_number' => '商品数量' ,
         'market_price' => '出售价' ,
         'subtotal' => '小计' ,
         'shipping_fee' => '邮费' ,
	);

	public $form_array=array(
         'cart_id' => '购物车ID' ,
         'user_id' => '用户ID' ,
         'goods_id' => '商品ID' ,
         'goods_name' => '商品名称' ,
         'goods_img' => '商品图片' ,
         'goods_attr' => '商品属性' ,
         'goods_number' => '商品数量' ,
         'market_price' => '出售价' ,
         'subtotal' => '小计' ,
         'shipping_fee' => '邮费' ,
	);

	public $_rule_config=array(
        array('field' => 'cart_id' , 'label' => '购物车ID' , 'rules' => 'required'),
        array('field' => 'user_id' , 'label' => '用户ID' , 'rules' => 'required'),
        array('field' => 'goods_id' , 'label' => '商品ID' , 'rules' => 'required'),
        array('field' => 'goods_name' , 'label' => '商品名称' , 'rules' => 'required'),
        array('field' => 'goods_img' , 'label' => '商品图片' , 'rules' => 'required'),
        array('field' => 'goods_attr' , 'label' => '商品属性' , 'rules' => 'required'),
        array('field' => 'goods_number' , 'label' => '商品数量' , 'rules' => 'required'),
        array('field' => 'market_price' , 'label' => '出售价' , 'rules' => 'required'),
        array('field' => 'subtotal' , 'label' => '小计' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'cart_id';
		$this->_attributes = array( 
				'cart_id' => '',
				'user_id' => '',
				'goods_id' => '',
				'goods_name' => '',
				'goods_img' => '',
				'goods_attr' => '',
				'goods_number' => '',
				'market_price' => '',
				'subtotal' => '',
                                'shipping_fee' => '' ,
				'wait_pay' => '',
		);
	}
}