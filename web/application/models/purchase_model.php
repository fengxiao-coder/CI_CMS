<?php

/**
 * purchase模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Purchase_Model extends MY_Model {

    public $_rule_config = array(
        array('field' => 'id', 'label' => 'id', 'rules' => 'required'),
        array('field' => 'cat_id', 'label' => '商品类型', 'rules' => 'required'),
        array('field' => 'goods_id', 'label' => '商品id', 'rules' => 'required'),
        array('field' => 'supplier_id', 'label' => '供应商', 'rules' => 'required'),
        array('field' => 'amount', 'label' => '采购量', 'rules' => 'required'),
        array('field' => 'price', 'label' => '采购价', 'rules' => 'required'),
        array('field' => 'buyer_id', 'label' => '采购人', 'rules' => 'required'),
        array('field' => 'created_time', 'label' => '采购时间', 'rules' => 'required'),
        array('field' => 'status', 'label' => '入库状态:0没有入库，1入库', 'rules' => 'required'),
        array('field' => 'remark', 'label' => '备注', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'id';
        $this->_attributes = array(
            'id' => '',
            'cat_id' => '',
            'goods_id' => '',
            'brand_id' => '',
            'coin_unit' => '',
            'item_unit' => '',
            'goods_name' => '',
            'ru_time' => '',
            'ru_person' => '',
            'supplier_id' => '',
            'amount' => '',
            'price' => '',
            'person' => '',
            'buyer_id' => '',
            'created_time' => '',
            'modified' => '',
            'status' => '',
            'remark' => '',
        );
    }

}
