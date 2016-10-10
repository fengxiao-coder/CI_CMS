<?php

/**
 * goods_attr模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Goods_attr_Model extends MY_Model {

    public $list_array = array(
        'goods_attr_id' => '编号ID',
        'goods_id' => '商品ID',
        'attr_id' => '属性ID',
        'attr_value' => '属性值',
        'attr_price' => '属性价格',
    );
    public $form_array = array(
        'goods_attr_id' => '编号ID',
        'goods_id' => '商品ID',
        'attr_id' => '属性ID',
        'attr_value' => '属性值',
        'attr_price' => '属性价格',
    );
    public $_rule_config = array(
        array('field' => 'goods_attr_id', 'label' => '编号ID', 'rules' => 'required'),
        array('field' => 'goods_id', 'label' => '商品ID', 'rules' => 'required'),
        array('field' => 'attr_id', 'label' => '属性ID', 'rules' => 'required'),
        array('field' => 'attr_value', 'label' => '属性值', 'rules' => 'required'),
        array('field' => 'attr_price', 'label' => '属性价格', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'goods_attr_id';
        $this->_attributes = array(
            'goods_attr_id' => '',
            'goods_id' => '',
            'attr_id' => '',
            'attr_input_type' => '',
            'attr_value' => '',
            'attr_price' => '',
        );
    }

}
