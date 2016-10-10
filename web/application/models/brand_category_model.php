<?php
/**
 * brand_category模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Brand_category_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'brand_id' => 'brand_id' ,
         'cat_id' => 'cat_id' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'brand_id' => 'brand_id' ,
         'cat_id' => 'cat_id' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'brand_id' , 'label' => 'brand_id' , 'rules' => 'required'),
        array('field' => 'cat_id' , 'label' => 'cat_id' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = '';
		$this->_attributes = array( 
				'id' => '',
				'brand_id' => '',
				'cat_id' => '',
		);
	}
}