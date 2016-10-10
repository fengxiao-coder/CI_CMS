<?php

header("content-type:text/html;charset=utf-8");

/**
 * order_info
 * @version 1.0
 * @package application
 * @subpackage application/controllers/order_info/
 */
class Order_info extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('goods_model');
        $this->load->model('cart_model');
        $this->load->model('store_model');
        $this->load->model('user_model');
        $this->load->model('order_info_model');
        $this->_site_path = "sz_front";
    }

    /**
     * 订单页面
     * @param type $id
     */
    public function index($id) {
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $this->load->model('user_area_model');
        $this->load->model('user_address_model');
        $user_id = $this->session->userdata('userid');
        if (!$user_id) {
            redirect(base_url('sz_front/user/login'));
        }
        if ($this->input->post('is_submit')) {
            $oreder = $this->input->post();
            foreach ($oreder['ids'] as $value) {
                $cart = $this->cart_model->get_by_pk($value);
                if ($cart) {
                    $edit_order[] = $cart;
                }
            }

            foreach ($edit_order as $key1 => $value) {
                $count = $count + $value['goods_number'];
                $edit_order[$key1]['subtotal'] = $value['goods_number'] * $value['market_price'];
                $edit_order[$key1]['shipping_fee'] = $value['goods_number'] * $value['shipping_fee'];
                $total = $total + $edit_order[$key1]['subtotal'] + $edit_order[$key1]['shipping_fee'];
            }
            $data['edit_order'] = $edit_order;
            $data['total'] = $total;
            $data['count'] = $count;
            $data['store'] = $this->store_model->all();
            $this->load->view_part('sz_front/order_info/index', $data);
        } else {
            $this->load->view_part('sz_front/cart/index');
        }
    }

    //立即购买
    public function imme($id) {
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $this->load->model('user_area_model');
        $this->load->model('user_address_model');
        $user_id = $this->session->userdata('userid');
        if (!$user_id) {
            redirect(base_url('sz_front/user/login'));
        }
        $data = $this->input->post();
        $string = $data['attr'];
        if ($id) {
            $value = $this->goods_model->get_by_pk($id);
            $order_list['goods_id'] = $value['id'];
            $order_list['goods_name'] = $value['name'];
            $order_list['goods_img'] = $value['photo'];
            $order_list['goods_number'] = $data['num'];
            $order_list['goods_attr'] = $string;
            $order_list['shipping_fee'] = $value['shipping_fee'] * $data['num'];
            $order_list['user_id'] = $user_id;
            if ($value['is_special'] == 1) {
                $order_list['market_price'] = $value['activity_price'];
                $order_list['subtotal'] = $value['activity_price'] * $data['num'];
            } else {
                $order_list['market_price'] = $value['price'];
                $order_list['subtotal'] = $value['price'] * $data['num'];
            }
            $status = $this->cart_model->get_by_attributes(array('goods_id' => $id, 'user_id' => $order_list['user_id']));
            if ($status) {
                $this->cart_model->update_by_pk($order_list, $status['cart_id']);
            } else {
                $cart_id = $this->cart_model->insert($order_list);
            }
            $data['total'] = $order_list['subtotal'] + $order_list['shipping_fee'];
            $data['count'] = count($id);
            $data['edit_order'][] = $order_list;
        } else {
            redirect(base_url('sz_front/cart/index') . '/' . $user_id);
        }
        $data['store'] = $this->store_model->all();
        $this->load->view('sz_front/order_info/index', $data);
    }

    /*
     * 提交订单
     */

    public function order() {
        $this->load->model('order_info_model');
        $this->load->model('order_goods_model');
        $this->load->model('user_address_model');
        $user_id = $this->session->userdata('userid');
        $data = array();
        $order_data = array();
        $attributes = $this->input->post();
        $order_data['store_id'] = $attributes['store_id'];
        $order_data['goods_amount'] = $attributes['goods_amount'] - $attributes['shipping_fee'];
        $order_data['pay_fee'] = $attributes['goods_amount'];
        $order_data['shipping_fee'] = $attributes['shipping_fee'];
        $order_data['address_id'] = $attributes['address_id'];
        $order_data['user_id'] = $user_id;
        $order_data['order_sn'] = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $order_data['add_time'] = strtotime(date('Y-m-d H:i:s'));
        $order_id = $this->order_info_model->insert($order_data);
        $order_info['consignee'] = $this->user_address_model->get_value_by_pk($attributes['address_id'], "consignee");
        $this->order_info_model->update_by_pk($order_info, $order_id);
        $goods['goods_id'] = $attributes['goods_id'];
        $goods['goods_number'] = $attributes['goods_number'];
        $goods['postscript'] = $attributes['postscript'];
        $goods['shipping_fee'] = $attributes['shipping_fee'];
        $goods['goods_attr'] = $attributes['goods_attr'];
        $goods['goods_name'] = $attributes['goods_name'];
        $goods['goods_sn'] = $attributes['goods_sn'];
        $goods['price'] = $attributes['price'];
        $res = array();
        foreach ($goods as $k => $v) {
            foreach ($v as $key => $val) {
                $res[$key][$k] = $val;
            }
        }
        session_start();
        foreach ($res as $key => $value) {
            $value['order_id'] = $order_id;
            $this->order_goods_model->insert($value);
            $arr = array(
                'goods_id' => $value['goods_id'],
                'user_id' => $user_id,
            );
            $r = $this->cart_model->delete_by_attributes($arr);
            if ($r) {
                unset($_SESSION['shoplist'][$value['goods_id']]);
            }
        }
        $data['pay_total'] = $attributes['goods_amount'];
        $this->load->view('sz_front/order_info/pay', $data);
        //redirect(base_url('sz_front/order_info/pay'));
    }

    //收货地址
    public function address($id) {
        $this->load->model('user_address_model');
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $this->load->model('user_area_model');
        $user_id = $this->session->userdata('userid');
        if ($user_id) {
            $sql = "select * from user_address where user_id={$user_id}";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
                $data['rows'] = $rows;
            }
        }
        if ($_GET['id']) {
            $data['add_id'] = $_GET['id'];
        } else {
            $data['add_id'] = $id;
        }
        $this->load->view($this->_site_path . "/order_info/address", $data);
    }

    //新建收货地址
    public function add_address($id) {
        $this->load->model('user_province_model');
        $data['id'] = $id;
        $pro_arr = $this->user_province_model->all();
        $data['pro_arr'] = $pro_arr;
        $this->load->view($this->_site_path . "/order_info/add_address", $data);
    }

    //添加地址
    public function do_addr($id) {
        $this->load->model('user_address_model');
        $this->load->model('user_province_model');
        $this->load->model('user_city_model');
        $this->load->model('user_area_model');
        $user_address_data = $this->input->post();
        $user_id = $this->session->userdata('userid');
        $info = $this->user_address_model->get_by_attributes(array("user_id" => $user_id));
        if (count($info) > 0) {
            $user_address_data["mark"] = 0;
        } else {
            $user_address_data["mark"] = 1;
        }
        $user_address_data['user_id'] = $user_id;
        $address_id = $this->user_address_model->insert($user_address_data);
        if ($address_id) {
            $data['address'] = $user_address_data;
        }
        $this->load->view('sz_front/order_info/ajax_address', $data);
    }

    public function shipping_address($id) {
        $address_id = $_GET['id'];
        $sql = "SELECT * FROM `user_address` WHERE `address_id` ={$address_id}";
        $query = $this->db->query($sql);
        $data['address'] = $query->result_array();
        //return $data['address'];
        $this->load->view('sz_front/order_info/index', $data);
    }

    /*
     * 
     * 订单列表
     */

    public function pay($user_id) {
        $data['user_id'] = $user_id;
        $this->load->view('sz_front/order_info/pay', $data);
    }

    public function test() {
        $this->load->view('sz_front/order_info/test');
    }

    //检查库存
    public function check_stock() {
        $goods_id = $this->input->post("goods_id");
        $num = $this->goods_model->get_value_by_pk($goods_id, "num");
        echo $num;
    }

}
