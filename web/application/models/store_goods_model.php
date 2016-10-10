<?php
/**
 * store_goods模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Store_goods_Model extends MY_Model
{
	public $list_array=array(
         'goods_id' => '商品' ,
         'stock' => '库存' ,
	);

	public $search_array=array(
         'goods_id' => '商品' ,
         'stock' => '库存' ,
	);
        
	public $form_array=array(
         'goods_id' => '商品' ,
         'stock' => '库存' ,
	);

	public $_rule_config=array(
        array('field' => 'goods_id' , 'label' => '商品' , 'rules' => 'required'),
        array('field' => 'stock' , 'label' => '库存' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'goods_id' => '',
				'stock' => '',
		);
	}
}