<?php
/**
 * operations模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Operations_Model extends MY_Model
{
	public $list_array=array(
         'operation_id' => 'operation_id' ,
         'operations_type_id' => '权限类别' ,
         'operation_name' => '权限名称' ,
         'module' => '模块' ,
         'action' => '动作' ,
         'remark' => '备注' ,
         'created' => '创建时间戳' ,
         'modified' => '修改时间戳' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'operation_id' => 'operation_id' ,
         'operations_type_id' => '权限类别' ,
         'operation_name' => '权限名称' ,
         'module' => '模块' ,
         'action' => '动作' ,
         'remark' => '备注' ,
         'created' => '创建时间戳' ,
         'modified' => '修改时间戳' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'operation_id' , 'label' => 'operation_id' , 'rules' => 'required'),
        array('field' => 'operations_type_id' , 'label' => '权限类别' , 'rules' => 'required'),
        array('field' => 'operation_name' , 'label' => '权限名称' , 'rules' => 'required'),
        array('field' => 'module' , 'label' => '模块' , 'rules' => 'required'),
        array('field' => 'action' , 'label' => '动作' , 'rules' => 'required'),
        array('field' => 'remark' , 'label' => '备注' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '创建时间戳' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改时间戳' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'operation_id';
		$this->_attributes = array( 
				'operation_id' => '',
				'operations_type_id' => '',
				'operation_name' => '',
				'module' => '',
				'action' => '',
				'remark' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
        
        
                	/**
	 * 根据模块名与动作名获取相应的数据
	 * @param string $module 模块名
	 * @param string $action 动作名
	 * @return array
	 */
	public function get_by_module_action( $module, $action ) {
		return $this->db->select( $this->get_datas_str() )
					->from( $this->table_name() )
					->where( 'module', $module )
					->where( 'action', $action )
					->get()
					->row_array();
	}
        
     /**
	 * 根据模块名与动作名获取相应的数据
	 * @param string $module 模块名
	 * @param string $action 动作名
	 * @return array
	 */
	public function get_by_module( $module   ) {
		return $this->db->select( $this->get_datas_str() )
					->from( $this->table_name() )
					->where( 'module', $module )
					->get()
					->row_array();
	}
}