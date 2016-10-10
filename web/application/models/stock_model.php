<?php
/**
 * stock模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Stock_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'goods_id' => '商品' ,
         'stock' => '库存' ,
         'store_id' => '店铺id' ,
         'status' => '上架状态' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'goods_id' => '商品' ,
         'stock' => '库存' ,
         'store_id' => '店铺id' ,
         'status' => '上架状态' ,
	);

	public $_rule_config=array(
        //array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'goods_id' , 'label' => '商品' , 'rules' => 'required'),
        array('field' => 'stock' , 'label' => '库存' , 'rules' => 'required'),
        array('field' => 'store_id' , 'label' => '店铺id' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '上架状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'goods_id' => '',
				'stock' => '',
				'store_id' => '',
				'status' => '',
                                'modified'=>'',
		);
	}
}