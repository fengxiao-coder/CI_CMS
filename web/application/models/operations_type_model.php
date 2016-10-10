<?php
/**
 * operations_type模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Operations_type_Model extends MY_Model
{
	public $list_array=array(
         'type_name' => '名称' ,
         'remark' => '备注' ,

	);

	public $form_array=array(
         'type_id' => '权限类别ID' ,
         'type_name' => '权限类别名称' ,
         'pid' => '父类ID' ,
         'nodepath' => '节点树' ,
         'created' => '创建时间戳' ,
         'modified' => '修改时间戳' ,
         'url'    =>  '链接地址',
         'remark' => '备注' ,
         'sequence' => '排序' ,
	);

	public $_rule_config=array(
        array('field' => 'type_name' , 'label' => '权限类别名称' , 'rules' => 'required'),
        array('field' => 'pid' , 'label' => '父类ID' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'type_id';
		$this->_attributes = array( 
				'type_id' => '',
				'type_name' => '',
				'pid' => '',
                                'url' => '',
				'nodepath' => '',
				'created' => '',
				'modified' => '',
				'remark' => '',
				'sequence' => '',
                                'status'=>'',
		);
	}
}