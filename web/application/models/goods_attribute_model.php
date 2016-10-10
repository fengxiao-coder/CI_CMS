<?php
/**
 * goods_attribute模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Goods_attribute_Model extends MY_Model
{
	public $list_array=array(
         'attr_name' => '商品属性名称' ,
         'type_id' => '商品属性所属类型ID' ,
         'attr_type' => '属性是否可选 1 为唯一，2为单选，3为多选' ,
         'attr_input_type' => '属性录入方式 1为手工录入，2为从列表中选择，3为文本域' ,
         'attr_value' => '属性的值' ,
         'sort_order' => '属性排序依据' ,
	);
        
 
	public $view_array=array(
         'attr_name' => '属性名称' ,
         'type_id' => '属性所属类型' ,
         'sort_order' => '属性排序依据' ,
	);
        
	public $form_array=array(
         'attr_name' => '商品属性名称' ,
         'type_id' => '商品属性所属类型ID' ,
         'sort_order' => '属性排序依据' ,
	);

	public $_rule_config=array(
        array('field' => 'attr_name' , 'label' => '商品属性名称' , 'rules' => 'required'),
        array('field' => 'type_id' , 'label' => '商品属性所属类型ID' , 'rules' => 'required'),
        array('field' => 'sort_order' , 'label' => '属性排序依据' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'attr_id';
		$this->_attributes = array( 
				'attr_id' => '',
				'attr_name' => '',
				'type_id' => '',
				'attr_type' => '',
				'attr_input_type' => '',
				'attr_value' => '',
				'sort_order' => '',
		);
	}
}