<?php
/**
 * user_rank模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class User_rank_Model extends MY_Model
{
	public $list_array=array(
         'rank_id' => 'rank_id' ,
         'rank_name' => '会员组名称' ,
         'min_points' => '积分下限' ,
         'max_points' => '积分上限' ,
         'special_rank' => 'VIP会员' ,
         'created' => '创建日期' ,
         'modified' => '修改日期' ,
         'status' => '状态' ,
	);

	public $form_array=array(
         'rank_id' => 'rank_id' ,
         'rank_name' => '会员组名称' ,
         'min_points' => '积分下限' ,
         'max_points' => '积分上限' ,
         'special_rank' => 'VIP会员' ,
         'created' => '创建日期' ,
         'modified' => '修改日期' ,
         'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'rank_id' , 'label' => 'rank_id' , 'rules' => 'required'),
        array('field' => 'rank_name' , 'label' => '会员组名称' , 'rules' => 'required'),
        array('field' => 'min_points' , 'label' => '积分下限' , 'rules' => 'required'),
        array('field' => 'max_points' , 'label' => '积分上限' , 'rules' => 'required'),
        array('field' => 'special_rank' , 'label' => 'VIP会员' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => '创建日期' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => '修改日期' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'rank_id';
		$this->_attributes = array( 
				'rank_id' => '',
				'rank_name' => '',
				'min_points' => '',
				'max_points' => '',
				'special_rank' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}