<?php

/**
 * goods_focus模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Goods_focus_Model extends MY_Model {

    public $list_array = array(
        'id' => '商品索引id',
        'name' => '商品名称',
        'pid' => 'pid',
        'nodepath' => 'nodepath',
        'photo' => 'photo',
        'price' => '商品价格',
        'created' => 'created',
        'modified' => 'modified',
        'status' => 'status',
    );
    public $form_array = array(
        'id' => '商品索引id',
        'name' => '商品名称',
        'pid' => 'pid',
        'nodepath' => 'nodepath',
        'photo' => 'photo',
        'price' => '商品价格',
        'created' => 'created',
        'modified' => 'modified',
        'status' => 'status',
    );
    public $_rule_config = array(
        array('field' => 'id', 'label' => '商品索引id', 'rules' => 'required'),
        array('field' => 'user_id', 'label' => '用户id', 'rules' => 'required'),
        array('field' => 'name', 'label' => '商品名称', 'rules' => 'required'),
        array('field' => 'pid', 'label' => 'pid', 'rules' => 'required'),
        array('field' => 'nodepath', 'label' => 'nodepath', 'rules' => 'required'),
        array('field' => 'photo', 'label' => 'photo', 'rules' => 'required'),
        array('field' => 'price', 'label' => '商品价格', 'rules' => 'required'),
        array('field' => 'created', 'label' => 'created', 'rules' => 'required'),
        array('field' => 'modified', 'label' => 'modified', 'rules' => 'required'),
        array('field' => 'status', 'label' => 'status', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'id';
        $this->_attributes = array(
            'id' => '',
            'name' => '',
            'pid' => '',
            'nodepath' => '',
            'goods_id' => '',
            'photo' => '',
            'price' => '',
            'user_id' => '',
            'created' => '',
            'modified' => '',
            'status' => '',
        );
    }

}
