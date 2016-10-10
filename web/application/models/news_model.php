<?php
/**
 * news模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class News_Model extends MY_Model
{
	public $list_array=array(
         'pid' => '分类' ,
         'title' => '标题' ,
         'author' => '作者' ,
         'iscommend' => '推荐' ,
         'sort' => '深度' ,
         'clickcount' => '浏览次数' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'pid' => '父级分类' ,
         'title' => '标题' ,
         'content' => '内容' ,
         'keywords' => '关键字' ,
         'description' => '描述' ,
         'imagemark' => '图片路径' ,
         'author' => '作者' ,
         'iscommend' => '推荐' ,
         'sort' => '深度' ,
         'clickcount' => '浏览次数' ,
         'joinip' => 'ip地址' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'pid' , 'label' => '父级分类' , 'rules' => 'required'),
        array('field' => 'nodepath' , 'label' => '路径' , 'rules' => 'required'),
        array('field' => 'title' , 'label' => '标题' , 'rules' => 'required'),
        array('field' => 'content' , 'label' => '内容' , 'rules' => 'required'),
        array('field' => 'keywords' , 'label' => '关键字' , 'rules' => 'required'),
        array('field' => 'description' , 'label' => '描述' , 'rules' => 'required'),
        array('field' => 'imagemark' , 'label' => '图片路径' , 'rules' => 'required'),
        array('field' => 'author' , 'label' => '作者' , 'rules' => 'required'),
        array('field' => 'iscommend' , 'label' => '推荐' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => '深度' , 'rules' => 'required'),
        array('field' => 'clickcount' , 'label' => '浏览次数' , 'rules' => 'required'),
        array('field' => 'joinip' , 'label' => 'ip地址' , 'rules' => 'required'),
        array('field' => 'recycled' , 'label' => '删除' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '创建时间' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改时间' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'pid' => '',
				'nodepath' => '',
				'title' => '',
				'content' => '',
				'keywords' => '',
				'description' => '',
				'imagemark' => '',
				'author' => '',
				'iscommend' => '',
				'sort' => '',
				'clickcount' => '',
				'joinip' => '',
				'recycled' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}