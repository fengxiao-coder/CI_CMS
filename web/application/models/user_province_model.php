<?php
/**
 * user_province模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class User_province_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'province_name' => '省份名称' ,
         'remark' => '备注' ,
         'sort' => '排序' ,
         'recycled' => '删除标记1:表示正常，0表示删除' ,
         'created' => '添加时间' ,
         'modified' => '修改时间' ,
         'status' => '状态，预留字段' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'province_name' => '省份名称' ,
         'remark' => '备注' ,
         'sort' => '排序' ,
         'recycled' => '删除标记1:表示正常，0表示删除' ,
         'created' => '添加时间' ,
         'modified' => '修改时间' ,
         'status' => '状态，预留字段' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'province_name' , 'label' => '省份名称' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => '备注' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => '排序' , 'rules' => 'required'),
        array('field' => 'recycled' , 'label' => '删除标记1:表示正常，0表示删除' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '添加时间' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改时间' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态，预留字段' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'province_name' => '',
				'remark' => '',
				'sort' => '',
				'recycled' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}