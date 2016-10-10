<?php
/**
 * goods_photo模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Goods_photo_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'goods_id' => '商品id' ,
         'photo' => '商品图片' ,
         'thumbnail' => '商品缩略图' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'goods_id' => '商品id' ,
         'photo' => '商品图片' ,
         'thumbnail' => '商品缩略图' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'goods_id' , 'label' => '商品id' , 'rules' => 'required'),
        array('field' => 'photo' , 'label' => '商品图片' , 'rules' => 'required'),
        array('field' => 'thumbnail' , 'label' => '商品缩略图' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'goods_id' => '',
				'photo' => '',
				'thumbnail' => '',
		);
	}
}