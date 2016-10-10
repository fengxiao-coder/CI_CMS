<?php

/**
 * goods模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */
class Goods_Model extends MY_Model {

    public $_rule_config = array(
        array('field' => 'id', 'label' => '商品索引id', 'rules' => 'required'),
        array('field' => 'name', 'label' => '商品名称', 'rules' => 'required'),
        array('field' => 'tagname', 'label' => '产品标签名', 'rules' => 'required'),
        array('field' => 'en_name', 'label' => '产品英文名', 'rules' => 'required'),
        array('field' => 'pid', 'label' => 'pid', 'rules' => 'required'),
        array('field' => 'brand_id', 'label' => '品牌ID', 'rules' => 'required'),
        array('field' => 'detail', 'label' => '详情', 'rules' => 'required'),
        array('field' => 'goods_sn', 'label' => '商品编码', 'rules' => 'required'),
        array('field' => 'goods_origin', 'label' => '产地', 'rules' => 'required'),
        array('field' => 'nodepath', 'label' => 'nodepath', 'rules' => 'required'),
        array('field' => 'prephoto', 'label' => 'prephoto', 'rules' => 'required'),
        array('field' => 'photo', 'label' => 'photo', 'rules' => 'required'),
        array('field' => 'price', 'label' => '商品价格', 'rules' => 'required'),
        array('field' => 'original_price', 'label' => '原价', 'rules' => 'required'),
        array('field' => 'is_hot', 'label' => '是否热卖', 'rules' => 'required'),
        array('field' => 'is_special', 'label' => '是否特卖', 'rules' => 'required'),
        array('field' => 'iscommend', 'label' => 'iscommend', 'rules' => 'required'),
        array('field' => 'shipping_fee', 'label' => '是否包邮', 'rules' => 'required'),
        array('field' => 'service', 'label' => '服务承诺', 'rules' => 'required'),
        array('field' => 'introduction', 'label' => '商品介绍', 'rules' => 'required'),
        array('field' => 'keyword', 'label' => '关键字', 'rules' => 'required'),
        array('field' => 'remark', 'label' => '备注', 'rules' => 'required'),
        array('field' => 'sort', 'label' => '排序', 'rules' => 'required'),
        array('field' => 'clickcount', 'label' => '点击量统计', 'rules' => 'required'),
        array('field' => 'recycled', 'label' => '0表示不显示，1表示显示', 'rules' => 'required'),
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
            'sales' => '',
            'tagname' => '',
            'en_name' => '',
            'pid' => '',
            'brand_id' => '',
            'num' => '',
            'item_unit' => '',
            'coin_unit' => '',
            'detail' => '',
            'goods_sn' => '',
            'goods_origin' => '',
            'nodepath' => '',
            'prephoto' => '',
            'photo' => '',
            'price' => '',
            'original_price' => '',
            'activity_price' => '',
            'is_hot' => '',
            'is_special' => '',
            'iscommend' => '',
            'shipping_fee' => '',
            'service' => '',
            'introduction' => '',
            'keyword' => '',
            'remark' => '',
            'sort' => '',
            'clickcount' => '',
            'recycled' => '',
            'created' => '',
            'modified' => '',
            'status' => '',
        );
    }

    public function create_thumb($source_image) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['master_dim'] = 'auto';
        $config['width'] = 100;
        $config['height'] = 70;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

    /**
     * 获取打印信息
     *
     */
    function get_print_info($id) {
        $print = array();
        $goods_data = $this->get_by_pk($id);
        $print['cn_name'] = $goods_data['tagname'];
        if (!$print['cn_name'])
            $print['cn_name'] = $goods_data['name'];
        $print['en_name'] = $goods_data['en_name'];
        $print['goods_sn'] = $goods_data['goods_sn'];
        $print['price'] = $goods_data['price'];
        $print['origin'] = $goods_data['goods_origin'];
        //$print['code_content'] = base_url($this->_site_path . "/goods/view/{$id}") ;
        $print['code_content'] = base_url("sz_front/index/detail/{$id}");
        return $print;
    }

}
