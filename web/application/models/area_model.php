<?php
/**
 * area模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Area_Model extends MY_Model
{
	public $list_array=array(
         'area_id' => 'area_id' ,
         'area_name' => '地区名称' ,
         'short_name' => '简称' ,
         'pid' => '父级分类' ,
         'nodepath' => '路径' ,
         'contory_id' => '国家' ,
         'created' => '创建时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'area_id' => 'area_id' ,
         'area_name' => '地区名称' ,
         'short_name' => '简称' ,
         'pid' => '父级分类' ,
         'nodepath' => '路径' ,
         'contory_id' => '国家' ,
         'created' => '创建时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'area_id' , 'label' => 'area_id' , 'rules' => 'required'),
        array('field' => 'area_name' , 'label' => '地区名称' , 'rules' => 'required'),
        array('field' => 'short_name' , 'label' => '简称' , 'rules' => 'required'),
        array('field' => 'pid' , 'label' => '父级分类' , 'rules' => 'required'),
        array('field' => 'nodepath' , 'label' => '路径' , 'rules' => 'required'),
        array('field' => 'contory_id' , 'label' => '国家' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '创建时间' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改时间' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'area_id';
		$this->_attributes = array( 
				'area_id' => '',
				'area_name' => '',
				'short_name' => '',
				'pid' => '',
				'nodepath' => '',
				'contory_id' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}