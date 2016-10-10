<?php
/**
 * user_city模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class User_city_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'city_name' => '城市名称' ,
         'pid' => '父id' ,
         'remark' => '备注' ,
         'sort' => '排序' ,
         'recycled' => '删除标记1:表示正常，0表示删除' ,
         'created' => '添加时间' ,
         'modified' => '修改时间' ,
         'status' => '状态，预留字段' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'city_name' => '城市名称' ,
         'pid' => '父id' ,
         'remark' => '备注' ,
         'sort' => '排序' ,
         'recycled' => '删除标记1:表示正常，0表示删除' ,
         'created' => '添加时间' ,
         'modified' => '修改时间' ,
         'status' => '状态，预留字段' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'city_name' , 'label' => '城市名称' , 'rules' => 'required'),
        array('field' => 'pid' , 'label' => '父id' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => '备注' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => '排序' , 'rules' => 'required'),
        array('field' => 'recycled' , 'label' => '删除标记1:表示正常，0表示删除' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '添加时间' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改时间' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态，预留字段' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'city_name' => '',
				'pid' => '',
				'remark' => '',
				'sort' => '',
				'recycled' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
	
/**
	 * 通过city表的id获取城市名称
	 * @param  [int] $city_id [城市id]
	 * @return [mixed]        [如果查询结果不为空，返回城市名称，否则返回false]
	 */
	public function get_city_name_by_city_id($city_id)
	{
		$query=$this->db
		->select("p.province_name,c.city_name")
		->from("{$this->_tables['c']} as c")
		->join("{$this->_tables['p']} as p","c.father_id=p.id")
		->where('c.id',$city_id);
		$result=$query->get()->row_array();
		if(!$result)
		{
			return false;
		}

		return $result['province_name'] ."&nbsp;&nbsp;". $result['city_name'];

	}


	/**
	 * 获取由city表的id以及province_name，city_name组成的键值对数组
	 * @return [array]              [由city表的id以及province_name，city_name组成的键值对数组]
	 */
	public function get_dropdown_array() 
	{
		$result = array( );
		$query = $this->db->select("c.id,c.city_name,p.province_name")
		->from("{$this->_tables['c']} as c")
		->join("{$this->_tables['p']} as p","c.father_id=p.id");
		$data= $query->get()->result_array();
		foreach ( $data as $value ) {
			$result[$value['id']] = $value['province_name']."&nbsp;&nbsp;".$value['city_name'];
		}
		return $result;
	}
}