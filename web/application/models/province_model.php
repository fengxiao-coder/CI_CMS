<?php
/**
 * province模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Province_Model extends MY_Model
{
	public $list_array=array(
         'province_id' => 'province_id' ,
         'province_name' => '省份名称' ,
         'short_name' => '简称' ,
         'pid' => '父级分类' ,
         'nodepath' => '路径' ,
         'country_id' => '国家' ,
         'created' => '创建日期' ,
         'modified' => '修改日期' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'province_id' => 'province_id' ,
         'province_name' => '省份名称' ,
         'short_name' => '简称' ,
         'pid' => '父级分类' ,
         'nodepath' => '路径' ,
         'country_id' => '国家' ,
         'created' => '创建日期' ,
         'modified' => '修改日期' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'province_id' , 'label' => 'province_id' , 'rules' => 'required'),
        array('field' => 'province_name' , 'label' => '省份名称' , 'rules' => 'required'),
        array('field' => 'short_name' , 'label' => '简称' , 'rules' => 'required'),
        array('field' => 'pid' , 'label' => '父级分类' , 'rules' => 'required'),
        array('field' => 'nodepath' , 'label' => '路径' , 'rules' => 'required'),
        array('field' => 'country_id' , 'label' => '国家' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '创建日期' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改日期' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'province_id';
		$this->_attributes = array( 
				'province_id' => '',
				'province_name' => '',
				'short_name' => '',
				'pid' => '',
				'nodepath' => '',
				'country_id' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}