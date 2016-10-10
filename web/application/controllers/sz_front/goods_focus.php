<?php

/**
 * goods_focus
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_focus/
 */
class Goods_focus extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('goods_model');
        $this->load->model('goods_focus_model');
        $this->load->model("user_model");
    }

    /*
     * 我的关注
     */

    public function index() {
    	$user_id = $this->session->userdata('userid');    	
        $this->is_login();   	
    		$data = array();
        	$data['list'] = $this->list_focus();     
        $this->load->view('sz_front/goods_focus/index', $data);
    }

    /*
     * 添加收藏
     */

    public function add($id) {
        $user_id = $this->session->userdata('userid');
        $data = array();
        $this->is_login();
        if ($id) {
            $shop = $this->goods_model->get_by_pk($id);
            $focus['goods_id'] = $shop['id'];
            $focus['name'] = $shop['name'];
            $focus['pid'] = $shop['pid'];
            $focus['user_id'] = $user_id;
            $focus['nodepath'] = $shop['nodepath'];
            $focus['photo'] = $shop['photo'];
            $focus['price'] = $shop['price'];
            $focus['created'] = $shop['created'];
            $focus['status'] = $shop['status'];
            $focus['modified'] = $shop['modified'];
            $data['focus'] = $focus;
            $condition = array(
                'attributes' => array('user_id' => $user_id, 'goods_id' => $id),
                'limit' => array('persize' => 20, 'offset' => 0),
                'orders' => array('id' => 'asc', 'created' => 'desc'),
            );
            $statu = $this->goods_focus_model->get_appoint_values(array('id', 'photo', 'user_id', 'name', 'price'), null, $condition);
            if ($statu) {
            redirect(base_url('sz_front/index/detail/' . $id));
            } else {
                $this->goods_focus_model->insert($data['focus']);
            }
            redirect(base_url('sz_front/index/detail/' . $id));
        }
    }

    /*
     * 添加收藏列表
     */

    public function list_focus() {
        $user_id = $this->session->userdata('userid');
        $condition = array(
            'attributes' => array('user_id' => $user_id, 'status' => 0),
            'limit' => array('persize' => 20, 'offset' => 0),
            'orders' => array('id' => 'asc', 'created' => 'desc'),
        );
        return $this->goods_focus_model->get_appoint_values(array('id', 'photo','goods_id', 'user_id', 'name', 'price'), null, $condition);
    }
    
    public function delete($id){
    	$this->goods_focus_model->delete_by_pk( $id );
		redirect( base_url( 'sz_front/goods_focus/index' ) );
    }

    /**
     * 判断是否登录
     * 
     */
    public function is_login() {
        $user_name = $this->session->userdata('user_name');
        $user_id = $this->session->userdata('userid');
        if (empty($user_id)) {
            redirect(base_url('sz_front/user/login'));
        }
    }

}
