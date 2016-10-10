<?php

/**
 * adv模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Adv_Model extends MY_Model {

    public $search_array = array(
        'adv_content' => '广告内容',
        'click_num' => '广告点击率',
    );
    public $list_array = array(
        'adv_title' => '广告内容描述',
        'sort' => '幻灯片排序',
        'adv_url' => '广告链接',
        'adv_content' => '广告内容',
        'click_num' => '广告点击率',
    );
    public $form_array = array(
        'adv_id' => '广告自增标识编号',
        'adv_url' => '广告链接',
        'adv_title' => '广告内容描述',
        'adv_content' => '广告内容',
        'adv_start_date' => '广告开始时间',
        'adv_end_date' => '广告结束时间',
        'sort' => '幻灯片排序',
        'photo' => '幻灯片图片',
        'click_num' => '广告点击率',
        'created' => '添加时间',
        'modified' => '修改时间',
        'status' => '状态',
    );
    public $_rule_config = array(
        array('field' => 'adv_url', 'label' => '广告链接', 'rules' => 'required'),
        array('field' => 'adv_title', 'label' => '广告内容描述', 'rules' => 'required'),
        array('field' => 'adv_content', 'label' => '广告内容', 'rules' => 'required'),
        array('field' => 'photo', 'label' => '广告图片', 'rules' => 'required'),
        array('field' => 'sort', 'label' => '幻灯片排序', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'adv_id';
        $this->_attributes = array(
            'adv_id' => '',
            'adv_url' => '',
            'adv_title' => '',
            'adv_content' => '',
            'adv_start_date' => '',
            'adv_end_date' => '',
            'photo' => '',
            'sort' => '',
            'click_num' => '',
            'created' => '',
            'modified' => '',
            'status' => '',
        );
    }

}
