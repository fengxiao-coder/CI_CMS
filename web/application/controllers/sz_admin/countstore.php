<?php

class Countstore extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
	public function index(){
		$this->load->model("order_info_model");
    	$this->load->model("goods_model");
    	$this->load->model("store_model");
    	$data['store_name'] = $this->store_model->get_appoint_values(array('id', 'sName'));
    	
    	$store_id = $this->auth->get_user('store_id');
    	if ($store_id){
    		$sql="select store_id,sum(goods_number),sum(pay_fee) from (select oi.order_id,oi.store_id,oi.pay_fee,og.goods_id,og.goods_number from order_info as oi left join order_goods as";
    		$sql.=" og on oi.order_id=og.order_id where oi.order_status=1 and oi.store_id={$store_id})od group by store_id";
    	}else{
	    	$sql="select store_id,sum(goods_number),sum(pay_fee) from (select oi.order_id,oi.store_id,oi.pay_fee,og.goods_id,og.goods_number from order_info as oi left join order_goods as";
	    	$sql.=" og on oi.order_id=og.order_id where oi.order_status=1)od group by store_id";
    	}
    	$query=$this->db->query($sql);
    	$num = $query->num_rows();    	
    	//分页
    	$data['total'] = $num;
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/countstore/index"),
            'total_rows' => $num,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        
        if ($store_id){
        	$sql_1="select store_id,sum(goods_number),sum(pay_fee) from (select oi.order_id,oi.store_id,oi.pay_fee,og.goods_id,og.goods_number from order_info as oi left join order_goods as";
    	$sql_1.=" og on oi.order_id=og.order_id where oi.order_status=1 and oi.store_id={$store_id})od group by store_id limit ".$this->pagination->get_cur_offset().','.$per_page;
        }else{
	    	$sql_1="select store_id,sum(goods_number),sum(pay_fee) from (select oi.order_id,oi.store_id,oi.pay_fee,og.goods_id,og.goods_number from order_info as oi left join order_goods as";
	    	$sql_1.=" og on oi.order_id=og.order_id where oi.order_status=1)od group by store_id limit ".$this->pagination->get_cur_offset().','.$per_page;
        }
    	$query_1=$this->db->query($sql_1);
		$data['store_data']=$query_1->result_array();		 
		//p($data["store_data"]);
		$this->load->view('sz_admin/countstore/index',$data);
	}
    
    
    /**
     * 查询 ...
     */
    public function search(){
    	$this->load->model("order_info_model");
    	$this->load->model("goods_model");
    	$this->load->model("store_model");
    	$data['store_name'] = $this->store_model->get_appoint_values(array('id', 'sName'));
    	$attributes = $this->input->get();
    	$begin=strtotime($attributes["add_time_big"]);
	    $end   =strtotime($attributes["add_time_small"]." 23:59:59");
    	if (!$this->auth->get_user('store_id')){
    		$store_id=$attributes['store_id'];
    	}else{
    		$store_id=$this->auth->get_user('store_id');
    	}
    	if($attributes['add_time_big'] != null){ $a = " and oi.add_time between '{$begin}' and '{$end}'";} 
		if($store_id != null){ $b = " and oi.store_id=$store_id";} 			    
	    $sql="select store_id,sum(goods_number),sum(pay_fee) from (select oi.order_id,oi.store_id,oi.pay_fee,og.goods_id,og.goods_number from order_info as oi left join order_goods";
	    $sql.=" as og on oi.order_id=og.order_id where oi.order_status=1$a$b)od group by store_id";
    	$query=$this->db->query($sql);
		$data['store_data']=$query->result_array();
    	$this->load->view('sz_admin/countstore/index',$data);
    }
    
    
    /* (non-PHPdoc)
     * @详情页
     */
    public function view($store_id){
    	$this->load->model("goods_model");
    	$this->load->model("store_model");
    	$sql="select goods_id,goods_name,goods_sn,price,store_id,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as og ";
    	$sql.="on oi.order_id=og.order_id where oi.order_status=1 and store_id={$store_id})od group by goods_id";
    	$query=$this->db->query($sql);
    	$data['store_data']=$query->result_array();
    	//p($data['store_data']);
    	$this->load->view('sz_admin/countstore/view',$data);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

}
