<?php
/**
 * news_type模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class News_type_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'pid' => '父级分类' ,
         'nodepath' => 'nodepath' ,
         'type_name' => 'type_name' ,
         'imagemark' => '图片路径' ,
         'remark' => 'remark' ,
         'depth' => 'depth' ,
         'recycled' => 'recycled' ,
         'created' => '创建时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'pid' => '父级分类' ,
         'nodepath' => 'nodepath' ,
         'type_name' => 'type_name' ,
         'imagemark' => '图片路径' ,
         'remark' => 'remark' ,
         'depth' => 'depth' ,
         'recycled' => 'recycled' ,
         'created' => '创建时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'pid' , 'label' => '父级分类' , 'rules' => 'required'),
        array('field' => 'nodepath' , 'label' => 'nodepath' , 'rules' => 'required'),
        array('field' => 'type_name' , 'label' => 'type_name' , 'rules' => 'required'),
        array('field' => 'imagemark' , 'label' => '图片路径' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => 'remark' , 'rules' => 'required'),
        array('field' => 'depth' , 'label' => 'depth' , 'rules' => 'required'),
        array('field' => 'recycled' , 'label' => 'recycled' , 'rules' => 'required'),
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
				'type_name' => '',
				'imagemark' => '',
				'remark' => '',
				'depth' => '',
				'recycled' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
        
        /**
	 * 通过获得limit行数据按主键降序
	 * @param int $limit 每页显示条数
	 * @param int $offset 游标
	 * @param array $attributes  属性值列表
	 * @return array
	 * @author xiaofeng
	 */
	public function all( $limit = 0, $offset = 0, $attributes = null, $orders = array('depth'=>'asc'), $in = null, $groupby=null ) {
		$query = $this->db->select( $this->get_datas_str() )->from( $this->table_name() );
		if ( $attributes ) {
			$this->set_datas( $attributes, TRUE );
			$query->where( $this->get_datas() );
		}
		if ( $in ) {
			foreach ( $in as $key => $value ) {
				$query->where_in( $key, $value );
			}
		}
		if ( $limit ) $query->limit( $limit, $offset );
		if ( $orders ) {
			foreach ( $orders as $k => $v ) {
					$query->order_by( $k, $v );
			}
		} else{
			$query->order_by( $this->primary_key(), 'desc' );
		}
		if ( $groupby )	$query->group_by( $groupby );
		return $query->get()->result_array();
	}
        
        public function get_news_type_options(){
               $fields=array('id','pid','type_name');               
               $options = $this->show_init_category($fields);
               return $options;
        }

}