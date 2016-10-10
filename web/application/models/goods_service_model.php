<?php

/**
 * goods_service模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Goods_service_Model extends MY_Model {

    public $list_array = array(
        'id' => 'id',
        'name' => '名称',
    );
    public $form_array = array(
        'name' => '名称',
        'remark' => '备注',
    );
    public $_rule_config = array(
        array('field' => 'name', 'label' => '名称', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'id';
        $this->_attributes = array(
            'id' => '',
            'name' => '',
            'img' => '',
            'remark' => '',
        );
    }

}
