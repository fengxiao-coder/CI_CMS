<?php
/**
 * goods_type模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Goods_type_Model extends MY_Model
{
	public $list_array=array(
         'type_id' => '类型id' ,
         'type_name' => '类型名称' ,
         'remark' => 'remark' ,
         'sort' => 'sort' ,
         'recycled' => 'recycled' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $form_array=array(
         'type_id' => '类型id' ,
         'type_name' => '类型名称' ,
         'remark' => 'remark' ,
         'sort' => 'sort' ,
         'recycled' => 'recycled' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $_rule_config=array(
        array('field' => 'type_id' , 'label' => '类型id' , 'rules' => 'required'),
        array('field' => 'type_name' , 'label' => '类型名称' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => 'remark' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => 'sort' , 'rules' => 'required'),
        array('field' => 'recycled' , 'label' => 'recycled' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => 'created' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => 'modified' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'type_id';
		$this->_attributes = array( 
				'type_id' => '',
				'type_name' => '',
				'remark' => '',
				'sort' => '',
				'recycled' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}