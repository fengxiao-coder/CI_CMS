<?php

/**
 * suggest模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Suggest_Model extends MY_Model {

    public $search_array = array(
        'phone_type' => '手机类型',
        'feedback_type' => '反馈类型',
        'feedback_content' => '反馈内容',
        'phone_number' => '手机',
    );
    public $list_array = array(
        'phone_type' => '手机类型',
        'feedback_type' => '反馈类型',
        'feedback_content' => '反馈内容',
        'phone_number' => '手机',
    );
    public $form_array = array(
        'phone_type' => '手机类型',
        'feedback_type' => '反馈类型',
        'feedback_content' => '反馈内容',
        'phone_number' => '手机',
    );
    public $_rule_config = array(
        array('field' => 'phone_type', 'label' => '手机类型', 'rules' => 'required'),
        array('field' => 'feedback_type', 'label' => '反馈类型', 'rules' => 'required'),
        array('field' => 'feedback_content', 'label' => '反馈内容', 'rules' => 'required'),
        array('field' => 'phone_number', 'label' => '手机', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'id';
        $this->_attributes = array(
            'id' => '',
            'phone_type' => '',
            'feedback_type' => '',
            'feedback_content' => '',
            'phone_number' => '',
            'created' => '',
            'modified' => '',
            'status' => '',
        );
    }

}
