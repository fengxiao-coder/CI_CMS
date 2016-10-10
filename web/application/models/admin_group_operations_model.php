<?php
/**
 * admin_group_operations模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Admin_group_operations_Model extends MY_Model
{
	public $list_array=array(
         'group_id' => 'group_id' ,
         'operations_id' => 'operations_id' ,
         'created' => '添加时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'group_id' => 'group_id' ,
         'operations_id' => 'operations_id' ,
         'created' => '添加时间' ,
         'modified' => '修改时间' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'group_id' , 'label' => 'group_id' , 'rules' => 'required'),
        array('field' => 'operations_id' , 'label' => 'operations_id' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '添加时间' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改时间' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = '';
		$this->_attributes = array( 
				'group_id' => '',
				'operations_id' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
        
        /**
	 * 添加角色权限
	 * @param int $group_id 角色ID
	 * @param array $permissions 权限de数组
	 * @author 咸洪伟
	 */
	public function add_rel($group_id,$permissions){
		foreach($permissions as $permission){
			$attributes=array();
			$attributes=array(
				'group_id'=>$group_id,
				'operations_id'=>$permission,
			);
			$this->insert($attributes);
		}
	}

	/**
	 * 删除角色权限
	 * @param int $group_id 角色ID
	 * @param array $permissions 权限de数组
	 * @author 咸洪伟
	 */
	public function delete_rel($group_id,$permissions){
		foreach($permissions as $permission){
			$attributes=array();
			$attributes=array(
				'group_id'=>$group_id,
				'operations_id'=>$permission,
			);
			$this->delete_by_attributes($attributes);
		}
	}
	
	/**
	 * 修改角色权限
	 * @param int $group_id 角色ID
	 * @param array $permissions 权限de数组
	 * @param array $old_permissions 修改前de权限de数组
	 * @author 咸洪伟
	 */
	public function change_rel($group_id,$permissions,$old_permissions){
		$this->add_rel($group_id,array_diff($permissions,$old_permissions));
		$this->delete_rel($group_id,array_diff($old_permissions,$permissions));
	}
}