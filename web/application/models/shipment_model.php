<?php

/**
 * shipment模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Shipment_Model extends MY_Model {

    public $list_array = array(
        'id' => 'id',
        'cat_id' => '商品类型',
        'goods_id' => '商品id',
        'supplier_id' => '供应商',
        'amount' => '出货量',
        'oper_id' => '出货人',
        'created_time' => '出货时间',
        'remark' => '备注',
    );
    public $form_array = array(
        'id' => 'id',
        'cat_id' => '商品类型',
        'goods_id' => '商品id',
        'supplier_id' => '供应商',
        'amount' => '出货量',
        'oper_id' => '出货人',
        'created_time' => '出货时间',
        'remark' => '备注',
    );
    public $_rule_config = array(
        array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        array('field' => 'cat_id', 'label' => '商品类型', 'rules' => 'required'),
        array('field' => 'goods_id', 'label' => '商品id', 'rules' => 'required'),
        array('field' => 'supplier_id', 'label' => '供应商', 'rules' => 'required'),
        array('field' => 'amount', 'label' => '出货量', 'rules' => 'required'),
        array('field' => 'oper_id', 'label' => '出货人', 'rules' => 'required'),
        array('field' => 'created_time', 'label' => '出货时间', 'rules' => 'required'),
        array('field' => 'remark', 'label' => '备注', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'id';
        $this->_attributes = array(
            'id' => '',
            'cat_id' => '',
            'goods_id' => '',
            'goods_name' => '',
            'brand_id' => '',
            'supplier_id' => '',
            'amount' => '',
            'oper_id' => '',
            'person' => '',
            'created_time' => '',
            'remark' => '',
        );
    }

}
