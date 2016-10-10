<?php
/**
 * reply_evaluation模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Reply_evaluation_Model extends MY_Model
{
	public $list_array=array(
         'rep_id' => 'rep_id' ,
         'ge_id' => 'ge_id' ,
         'admin_id' => 'admin_id' ,
         'content' => '回复内容' ,
	);

	public $form_array=array(
         'rep_id' => 'rep_id' ,
         'ge_id' => 'ge_id' ,
         'admin_id' => 'admin_id' ,
         'content' => '回复内容' ,
	);

	public $_rule_config=array(
        array('field' => 'rep_id' , 'label' => 'rep_id' , 'rules' => 'required'),
        array('field' => 'ge_id' , 'label' => 'ge_id' , 'rules' => 'required'),
        array('field' => 'admin_id' , 'label' => 'admin_id' , 'rules' => 'required'),
        array('field' => 'content' , 'label' => '回复内容' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'rep_id';
		$this->_attributes = array( 
				'rep_id' => '',
				'ge_id' => '',
				'admin_id' => '',
				'content' => '',
				'created_time' => '',
		);
	}
}