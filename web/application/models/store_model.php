<?php
/**
 * store模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Store_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'sName' => 'sName' ,
         'sAddr' => 'sAddr' ,
         'sPhone' => '电话' ,
         'sUser' => 'sUser' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'sName' => 'sName' ,
         'sAddr' => 'sAddr' ,
         'sPhone' => '电话' ,
         'sUser' => 'sUser' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'sName' , 'label' => 'sName' , 'rules' => 'required'),
        array('field' => 'sAddr' , 'label' => 'sAddr' , 'rules' => 'required'),
        array('field' => 'sPhone' , 'label' => '电话' , 'rules' => 'required'),
        array('field' => 'sUser' , 'label' => 'sUser' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'sName' => '',
				'province' => '',
				'city' => '',
				'area' => '',
				'bar_code' => '',
				'sAddr' => '',
				'prephoto' => '',
				'sPhone' => '',
				'sUser' => '',
		);
	}
}