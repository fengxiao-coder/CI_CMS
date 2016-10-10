<?php
/**
 * config模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Config_Model extends MY_Model
{
	public $list_array=array(
//         'key' => '键' ,
//         'value' => '值' ,
//         'type' => '类型' ,
		 'key' => '类型名称' ,
         'value' => '类型值' ,
         'title' => '标题' ,
         'remark' => '描述' ,
	);

	public $form_array=array(
//         'key' => '键' ,
//         'value' => '值' ,
		 'key' => '类型名称' ,
         'value' => '类型值' ,
         'type' => '类型' ,
         'title' => '标题' ,
         'remark' => '描述' ,
         'sort' => '排序' ,
	);

	public $_rule_config=array(
//        array('field' => 'key' , 'label' => '键' , 'rules' => 'required'),
//        array('field' => 'value' , 'label' => '值' , 'rules' => 'required'),
        array('field' => 'key' , 'label' => '类型名称' , 'rules' => 'required'),
        array('field' => 'value' , 'label' => '类型值' , 'rules' => 'required'),
        array('field' => 'type' , 'label' => '类型' , 'rules' => 'required'),
        array('field' => 'title' , 'label' => '标题' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => '描述' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => '排序' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'key' => '',
				'value' => '',
				'type' => '',
				'title' => '',
				'remark' => '',
				'sort' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
        
        
        		/*
	 * 根据键获得值
	 * @param string $key
	 * return $value
	 */
	public function get_value_by_key($key){
		$search['attributes']=array('key'=>$key);	
		$config=$this->all($search);
		if(count($config)==1){
			return $config['0']['value'];
		}
		return false;
	}
}