<?php
/**
 * goods_evaluation模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Goods_evaluation_Model extends MY_Model
{
	public $list_array=array(
        // 'id' => 'id' ,
         'goods_id' => '商品' ,
         'order_id' => '订单号' ,
         'user_id' => '用户名' ,
         'evaluation' => '评论状态' ,
        // 'content' => '评论内容' ,
         'status' => '状态' ,
         'created_time' => '评论时间' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'goods_id' => '商品' ,
         'order_id' => '订单号' ,
         'user_id' => 'user_id' ,
         'evaluation' => '0好评 1中评 2差评' ,
         'content' => '评论内容' ,
         'status' => 'status' ,
         'created_time' => 'created_time' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'goods_id' , 'label' => '商品' , 'rules' => 'required'),
        array('field' => 'order_id' , 'label' => '订单号' , 'rules' => 'required'),
        array('field' => 'user_id' , 'label' => 'user_id' , 'rules' => 'required'),
        array('field' => 'evaluation' , 'label' => '0好评 1中评 2差评' , 'rules' => 'required'),
        array('field' => 'content' , 'label' => '评论内容' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
        array('field' => 'created_time' , 'label' => 'created_time' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'goods_id' => '',
				'goods_name' => '',
				'order_id' => '',
				'store_id' => '',
				'user_id' => '',
				'user_name' => '',
				'evaluation' => '',
				'content' => '',
				'status' => '',
				'created_time' => '',
		);
	}
}