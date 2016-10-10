<?php

/**
 * order_info
 * @version 1.0
 * @package application
 * @subpackage application/controllers/order_info/
 */
class Order_info extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($flag='pay') {
        $this->load->model("order_info_model");
        $this->load->model("order_goods_model");
        $this->load->model("back_order_model");
        $this->load->model("store_model");
        $this->load->model("user_address_model");
        $this->load->model("delivery_order_model");
        $data['store_name'] = $this->store_model->get_appoint_values(array('id', 'sName'));
        $data['current_type']=$flag;
        $search['attributes'] = $this->input->get();
        
        $store = $this->auth->get_user('store_id');
        if ($store){
        	$search['attributes']['store_id'] = $store;
        }       
        
        if($flag=="pay"){
        	//待支付        	
	        $search['attributes']["pay_status"] = 0;
	        $search['attributes']["shipping_status"] = 0;
	        $search['attributes']["order_status"] = 0;	
	        $search['orders'] = array(
	         'order_id' => 'desc'
		    );
		    $total = $this->order_info_model->total(null, $search);                
        }elseif ($flag=="ship"){
        	//待发货
	        $search['attributes']["pay_status"] = 2;
	        $search['attributes']["shipping_status"] = 0;
	        $search['attributes']["order_status"] = 0; 
	        $search['orders'] = array(
	         'order_id' => 'desc'
		    );
		    $total = $this->order_info_model->total(null, $search);       
        }elseif ($flag=="check"){
        	//已发货
	        $search['attributes']["pay_status"] = 2;
	        $search['attributes']["shipping_status"] = 1;
	        $search['attributes']["order_status"] = 0; 
	        $search['orders'] = array(
	         'order_id' => 'desc'
		    );
		    $total = $this->order_info_model->total(null, $search);       
        }elseif ($flag=="eval"){
        	//待评价
	        $search['attributes']["pay_status"] = 2;
	        $search['attributes']["shipping_status"] = 1;
	        $search['attributes']["order_status"] = 1;        
	        $search['attributes']["ele_status"] = 0;  
	        $search['orders'] = array(
	         'order_id' => 'desc'
		    );
		    $total = $this->order_info_model->total(null, $search);        
        }elseif($flag=="success"){
        	//成功订单
	        $search['attributes']["pay_status"] = 2;
	        $search['attributes']["shipping_status"] = 1;
	        $search['attributes']["order_status"] = 1;
	        $search['orders'] = array(
	         'order_id' => 'desc'
		    );
		    $total = $this->order_info_model->total(null, $search);            	    
        }elseif ($flag=="close"){
        	//取消的订单
	        $search['attributes']["order_status"] = 2;
	        $search['orders'] = array(
	         'order_id' => 'desc'
		    );
		    $total = $this->order_info_model->total(null, $search);            	      
        }elseif ($flag=="back"){
        	//退货的订单        	        	        	
        	$search['orders'] = array(
	         'order_id' => 'desc'
		    );		    
		    $total = $this->back_order_model->total(null, $search);  
        }
        
	    $data['total'] = $total;
	    $per_page = config_item('per_page');
	    $this->load->library('pagination');
	    $pagination_config = array(
	        'base_url' => base_url('sz_admin/order_info/index/'.$flag.'?&'),
	        'total_rows' => $total,
	        'per_page' => $per_page,
	        'uri_segment' => 4,
	        'page_query_string' => TRUE, 
			'enable_query_strings'=>TRUE,
	    );
	    $this->pagination->initialize($pagination_config);
	    $data['pagination'] = $this->pagination->create_links();
	    $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());
        $data['order_info_data'] = $this->order_info_model->all($search);
//        p($search);
        $data['back_order'] = $this->back_order_model->all($search);

        $this->load->view('sz_admin/order_info/index', $data);
    }

    public function view($id,$current_type) {
    	//p($current_type);//订单号
        $this->load->model("order_info_model");
        $this->load->model("order_goods_model");
        $this->load->model("user_model");
        $this->load->model("goods_model");
        $this->load->model("user_province_model");
        $this->load->model("user_city_model");
        $this->load->model("user_area_model");
        $this->load->model("store_model");
        $this->load->model("delivery_order_model");
        $this->load->model("user_address_model");
        $data['back_order']=$this->order_goods_model->all(array('attributes'=>array('order_id'=>$id,'status'=>1)));
      	
        $data['order_info'] = $this->order_info_model->get_by_attributes(array("order_id" => $id));
        //p($data['order_info'] );
        //根据订单号查找此订单下的商品信息 一条或者多条信息
        if ($current_type=="back"){
        	$data['goods_info']=$this->order_goods_model->all(array('attributes'=>array('order_id'=>$id,'status_notequal'=>0)));
        }else{
        	$data['goods_info']=$this->order_goods_model->all(array('attributes'=>array('order_id'=>$id)));
        }        
        //根据订单号找物流信息
        $data["current_type"] = $current_type;
        $data['delivery_info'] = $this->delivery_order_model->get_by_attributes(array("order_id" => $id));
        //p($data['delivery_info']);
        $this->load->view('sz_admin/order_info/view', $data);
    }

    //发货
	public function ship($id) {
        $data["order_id"] = $id;
        $this->load->model("order_info_model");
        $this->load->model("delivery_order_model");
        $this->load->model("user_model");
        $this->load->model("store_model");
        $this->load->model("user_province_model");
        $this->load->model("shipping_model");
        $this->load->model("user_address_model");
        $pro_arr = $this->user_province_model->all();
		$data['pro_arr'] = $pro_arr;
		//p($pro_arr);
        $data["shipping_data"] = $this->shipping_model->all();
        $order_info = $this->order_info_model->get_by_attributes(array('order_id' => $id)); //id是订单号
        $data["order_info"] = $order_info;
        if ($this->input->post('is_submit')) {
            try {
                $order_data = $this->input->post();
                $data['order_data'] = $order_data;
                //p($order_data);
                //设置验证规则
                $rule_config = array(
                    array('field' => 'shipping_id', 'label' => '配送方式', 'rules' => 'required'),
                    array('field' => 'invoice_no', 'label' => '物流单号', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //发货单列表字段赋值
                $data1["delivery_sn"] = date('YmdHi') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $data1["order_sn"] = $order_info["order_sn"];
                $data1["order_id"] = $order_info["order_id"];
                $data1["add_time"] = $order_info["add_time"];
                $data1["user_id"] = $order_info["user_id"];
                $data1["consignee"] = $order_data["consignee"];
                $data1["address"] = $order_data["address"];
                $data1["province"] = $order_data["province"];
                $data1["city"] = $order_data["city"];
                $data1["district"] = $order_data["area"];
                $data1["email"] = $order_info["email"];
                $data1["tel"] = $order_info["tel"];
                $data1["mobile"] = $order_data["mobile"];
                $data1["shipping_fee"] = $order_info["shipping_fee"];
                $data1["store_id"] = $order_info["store_id"];
                $data1["shipping_id"] = $order_data["shipping_id"];
                $data1["invoice_no"] = $order_data["invoice_no"];
                $data1["shipping_name"] = $this->shipping_model->get_value_by_pk($order_data["shipping_id"], "shipping_name");
                $data1["update_time"] = strtotime(date("Y-m-d H:i:s"));
                //插入发货单
                $delivery_id = $this->delivery_order_model->insert($data1);
                $this->order_info_model->update_by_pk(array("shipping_status" => "1"), $id);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/order_info/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }

        $this->load->view('sz_admin/order_info/order_ship', $data);
    }
    //修改配送方式
    public function editship($id){
    	$this->load->model("order_info_model");
        $this->load->model("delivery_order_model");
        $this->load->model("user_model");
        $this->load->model("store_model");
        $this->load->model("user_province_model");
        $this->load->model("shipping_model");
        $pro_arr = $this->user_province_model->all();
        $data['pro_arr'] = $pro_arr;
        $data["delivery_info"] = $this->delivery_order_model->get_by_attributes(array('order_id' => $id)); //id是订单号
        $data["shipping_data"] = $this->shipping_model->all();        
     	if ($this->input->post('is_submit')) {
            try {
                $ship_data = $this->input->post();
                $data['ship_data'] = $ship_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'shipping_id', 'label' => '配送方式', 'rules' => 'required'),
                    array('field' => 'invoice_no', 'label' => '物流单号', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
          		//更改物流信息 id是order_id
          		$delivery = $this->delivery_order_model->get_by_attributes(array( 'order_id'=>$id));
          		$this->delivery_order_model->update_by_pk( $ship_data ,$delivery["delivery_id"]);
				init_messagebox( '修改成功', 'success', 1,base_url( 'sz_admin/order_info/index' ) );				          		
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
     	}
        //p($data["delivery_info"]);
    	$this->load->view('sz_admin/order_info/editship', $data);
    }

    //取消发货
    public function un_ship($id) {
        $data["shipping_status"] = 0;
        if ($this->order_info_model->update_by_pk($data, $id)) {
            ?>
            <script type="text/javascript">
                alert("取消发货成功");
                location.href = document.referrer;
            </script>
            <?php

        }
    }

    //取消付款
    public function un_pay($id) {
        $data["pay_status"] = 0;
        if ($this->order_info_model->update_by_pk($data, $id)) {
            ?>
            <script type="text/javascript">
                alert("取消付款成功");
                location.href = document.referrer;
            </script>
            <?php

        }
    }

    //付款
    public function pay($id) {
    	$this->load->model("order_info_model");
        $this->load->model("order_goods_model");
        $this->load->model("goods_model");
        $data["pay_status"] = 2;
        //减库存 id是订单id 找出订单下的商品数量
        $all=$this->order_goods_model->all(array('attributes'=>array('order_id'=>$id)));
       // p($all);
        foreach ($all as $v){
        	//p($v['goods_id']."---".$v['goods_number']);
        	$num=$this->goods_model->get_value_by_pk($v['goods_id'],'num');
        	//p($num);
        	$goods_data["num"]=$num-$v['goods_number'];
        	//p($goods_data["num"]);
        	//更新goods表的库存
        	$this->goods_model->update_by_pk($goods_data, $v['goods_id']);
        }
        
        if ($this->order_info_model->update_by_pk($data, $id)) {
            ?>
            <script type="text/javascript">
                alert("付款成功");
                location.href = document.referrer;
            </script>
            <?php

        }
    }

    //取消订单
    public function un_order($id) {
        $data["order_status"] = 2;
        if ($this->order_info_model->update_by_pk($data, $id)) {
            ?>
            <script type="text/javascript">
                alert("取消订单成功");
                location.href = document.referrer;
            </script>
            <?php

        }
    }

    //确认订单
    public function order($id) {
        $data["order_status"] = 1;
        if ($this->order_info_model->update_by_pk($data, $id)) {
            ?>
            <script type="text/javascript">
                alert("订单确认成功");
                location.href = document.referrer;
            </script>
            <?php

        }
    }
    
    public function do_back($rec_id){
    	$this->load->model("order_goods_model");
    	$this->load->model("delivery_order_model");
    	$this->load->model("shipping_model");
    	$this->load->model("store_model");
    	$data["shipping_data"] = $this->shipping_model->all();    
    	$data["store_data"] = $this->store_model->all();    
    	//读取order_goods里面的信息
    	$data['order_goods'] = $this->order_goods_model->get_by_pk($rec_id);
    	//读取此条订单的配送信息
    	$data['delivery_order'] = $this->delivery_order_model->get_by_attributes(array("order_id" => $data['order_goods']['order_id']));
    	if ($this->input->post('is_submit')) {
            try {
                $back_data = $this->input->post();
                $data['back_data'] = $back_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'agree', 'label' => '是否同意退货', 'rules' => 'required'),                
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //修改
                $this->order_goods_model->update_by_pk( array("status" => "2"), $rec_id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/order_info/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
    	$this->load->view('sz_admin/order_info/do_back', $data);
    }

}
