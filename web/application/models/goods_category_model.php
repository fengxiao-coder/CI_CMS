<?php
/**
 * goods_category模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Goods_category_Model extends MY_Model
{
	public $list_array=array(
         'cat_id' => '类型id' ,
         'cat_name' => '类型名称' ,
         'pid' => 'pid' ,
         'nodepath' => 'nodepath' ,
         'imagemark' => '图片描述' ,
         'iscommend' => 'iscommend' ,
         'remark' => 'remark' ,
         'sort' => 'sort' ,
         'recycled' => 'recycled' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $form_array=array(
         'cat_id' => '类型id' ,
         'cat_name' => '类型名称' ,
         'pid' => 'pid' ,
         'nodepath' => 'nodepath' ,
         'imagemark' => '图片描述' ,
         'iscommend' => 'iscommend' ,
         'remark' => 'remark' ,
         'sort' => 'sort' ,
         'recycled' => 'recycled' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $_rule_config=array(
        array('field' => 'cat_id' , 'label' => '类型id' , 'rules' => 'required'),
        array('field' => 'cat_name' , 'label' => '类型名称' , 'rules' => 'required'),
        array('field' => 'pid' , 'label' => 'pid' , 'rules' => 'required'),
        array('field' => 'nodepath' , 'label' => 'nodepath' , 'rules' => 'required'),
        array('field' => 'imagemark' , 'label' => '图片描述' , 'rules' => 'required'),
        array('field' => 'iscommend' , 'label' => 'iscommend' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => 'remark' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => 'sort' , 'rules' => 'required'),
        array('field' => 'recycled' , 'label' => 'recycled' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => 'created' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => 'modified' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'cat_id';
		$this->_attributes = array( 
				'cat_id' => '',
				'cat_name' => '',
				'pid' => '',
				'nodepath' => '',
				'imagemark' => '',
				'photo' => '',
				'iscommend' => '',
				'remark' => '',
				'sort' => '',
				'recycled' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
        
        public function get_goods_category_options(){
               $fields=array('cat_id','pid','cat_name');               
               $options = $this->show_init_category($fields,null,null,'cat_id','pid','cat_name');
               return $options;
        }
        
        private $ids = array();
        public function get_category_son_ids($arr,$pid=0){
            foreach ($arr as $k=>$v){
                if($v['pid'] == $pid){ 
                   $this->ids[] = $v['cat_id'];
                   unset($arr[$k]);
                   $this->get_category_son_ids($arr,$v['cat_id']);
                }     
            }
            return $this->ids;
        }

}