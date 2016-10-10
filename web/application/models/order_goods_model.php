<?php

/**
 * order_goods模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Order_goods_Model extends MY_Model {

    public $list_array = array(
        'rec_id' => 'rec_id',
        'order_id' => 'order_id',
        'goods_id' => 'goods_id',
        'goods_number' => 'goods_number',
    );
    public $form_array = array(
        'rec_id' => 'rec_id',
        'order_id' => 'order_id',
        'goods_id' => 'goods_id',
        'goods_number' => 'goods_number',
    );
    public $_rule_config = array(
        array('field' => 'rec_id', 'label' => 'rec_id', 'rules' => 'required'),
        array('field' => 'order_id', 'label' => 'order_id', 'rules' => 'required'),
        array('field' => 'goods_id', 'label' => 'goods_id', 'rules' => 'required'),
        array('field' => 'goods_number', 'label' => 'goods_number', 'rules' => 'required'),
    );

    public function __construct() {
        parent::__construct();
        $this->_pk = 'rec_id';
        $this->_attributes = array(
            'rec_id' => '',
            'order_id' => '',
            'goods_id' => '',
        	'goods_name' => '',
	        'goods_sn' => '',
	        'price' => '',
            'goods_attr' => '',
            'goods_number' => '',
            'postscript' => '',
            'shipping_fee' => '',
        	'status' => '',
        	'how_oos' => '',
        );
    }

    public function pay_status($id) {
        if ($id == 0) {
            return "等待买家付款";
        } elseif ($id == 1) {
            return "付款中";
        } elseif ($id == 2) {
            return "已付款";
        }
    }

    //当pay_status=2时 才读shipping_status
    public function shipping_status($id) {
        if ($id == 0) {
            return "等待卖家发货";
        } elseif ($id == 1) {
            return "卖家已发货";
        } elseif ($id == 2) {
            return "买家已收货";
        } elseif ($id == 3) {
            return "退货中";
        }
    }
    
	public function order_status($id) {
        if ($id == 0) {
            return "订单未确认";
        } elseif ($id == 1) {
            return "交易成功";
        } elseif ($id == 2) {
            return "交易关闭";
        } elseif ($id == 3) {
            return "退货";
        }
    }
}
