<?php
/**
 * link模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Link_Model extends MY_Model
{
	public $list_array=array(
      
         'link_title' => '标题' ,
         'link_url' => '链接' ,
         'link_pic' => '图片' ,
       

	);

	public $form_array=array(
         'link_id' => '索引id' ,
         'link_title' => '标题' ,
 
         'sort' => '排序' ,

	);

	public $_rule_config=array(
        array('field' => 'link_id' , 'label' => '索引id' , 'rules' => 'required'),
        array('field' => 'link_title' , 'label' => '标题' , 'rules' => 'required'),
        array('field' => 'link_url' , 'label' => '链接' , 'rules' => 'required'),
        array('field' => 'link_pic' , 'label' => '图片' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => '排序' , 'rules' => 'required'),
        array('field' => 'recycled' , 'label' => 'recycled' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => 'created' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => 'modified' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'link_id';
		$this->_attributes = array( 
				'link_id' => '',
				'link_title' => '',
				'link_url' => '',
				'link_pic' => '',
				'sort' => '',
				'recycled' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}