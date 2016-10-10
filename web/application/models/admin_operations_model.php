<?php
/**
 * admin_group模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class  Admin_operations_Model  extends MY_Model
{
	public $list_array=array(
         'admin_id' => 'admin_id' ,

	);
	public $form_array=array(
         'admin_id' => 'admin_id' ,
	);

	public $_rule_config=array(
        array('field' => 'admin_id' , 'label' => 'admin_id' , 'rules' => 'required'),

	);

	public function __construct(){
		parent::__construct();

		$this->_attributes = array( 
				'admin_id' => '',
				'operations_id' => '',

		);
	}
}