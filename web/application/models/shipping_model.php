<?php
/**
 * shipping模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Shipping_Model extends MY_Model
{
	public $list_array=array(
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'shipping_desc' => '描述' ,
	);

	public $form_array=array(
         'shipping_id' => 'shipping_id' ,
         'shipping_name' => 'shipping_name' ,
         'shipping_desc' => '描述' ,
	);

	public $_rule_config=array(
        array('field' => 'shipping_id' , 'label' => 'shipping_id' , 'rules' => 'required'),
        array('field' => 'shipping_name' , 'label' => 'shipping_name' , 'rules' => 'required'),
        array('field' => 'shipping_desc' , 'label' => '描述' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'shipping_id';
		$this->_attributes = array( 
				'shipping_id' => '',
				'shipping_name' => '',
				'shipping_desc' => '',
		);
	}
}