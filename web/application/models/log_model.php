<?php
/**
 * log模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Log_Model extends MY_Model
{
	public $list_array=array(
         'log_id' => 'log_id' ,
         'admin_id' => 'admin_id' ,
         'operations_id' => 'operations_id' ,
         'tablename' => 'tablename' ,
         'module' => 'module' ,
         'action' => 'action' ,
         'remark' => 'remark' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $form_array=array(
         'log_id' => 'log_id' ,
         'admin_id' => 'admin_id' ,
         'operations_id' => 'operations_id' ,
         'tablename' => 'tablename' ,
         'module' => 'module' ,
         'action' => 'action' ,
         'remark' => 'remark' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $_rule_config=array(
        array('field' => 'log_id' , 'label' => 'log_id' , 'rules' => 'required'),
        array('field' => 'admin_id' , 'label' => 'admin_id' , 'rules' => 'required'),
        array('field' => 'operations_id' , 'label' => 'operations_id' , 'rules' => 'required'),
        array('field' => 'tablename' , 'label' => 'tablename' , 'rules' => 'required'),
        array('field' => 'module' , 'label' => 'module' , 'rules' => 'required'),
        array('field' => 'action' , 'label' => 'action' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => 'remark' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => 'created' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => 'modified' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'log_id';
		$this->_attributes = array( 
				'log_id' => '',
				'admin_id' => '',
				'operations_id' => '',
				'tablename' => '',
				'module' => '',
				'action' => '',
				'remark' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}