<?php

class Count extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index(){
    	$this->load->model("order_info_model");
    	$this->load->model("goods_model");
    	//读取交易成功的订单
    	$store_id = $this->auth->get_user('store_id');
    	if ($store_id){
    		$sql="select goods_id,goods_name,goods_sn,price,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as";
	    	$sql.=" og on oi.order_id=og.order_id where oi.order_status=1 and oi.store_id ={$store_id})od group by goods_id";
    	}else{
	    	$sql="select goods_id,goods_name,goods_sn,price,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as";
	    	$sql.=" og on oi.order_id=og.order_id where oi.order_status=1)od group by goods_id";
    	}
    	
    	$query=$this->db->query($sql);
    	$num = $query->num_rows();    	
    	//分页
    	$data['total'] = $num;
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/count/index"),
            'total_rows' => $num,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        //读取商品信息
        if ($store_id){
        	$sql_1="select goods_id,goods_sn,price,goods_name,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as";
        	$sql_1.=" og on oi.order_id=og.order_id where oi.order_status=1 and oi.store_id={$store_id})od group by goods_id limit ".$this->pagination->get_cur_offset().','.$per_page;
        }else{
	        $sql_1="select goods_id,goods_sn,price,goods_name,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as";
	        $sql_1.=" og on oi.order_id=og.order_id where oi.order_status=1)od group by goods_id limit ".$this->pagination->get_cur_offset().','.$per_page;
        }
        $query_1=$this->db->query($sql_1);
		$data['goods_data']=$query_1->result_array();		 
		//p($data);
    	$this->load->view('sz_admin/count/index',$data);
    }
    public function search(){
    	$this->load->model("order_info_model");
    	$this->load->model("goods_model");
    	$attributes = $this->input->get();   	
    	$store_id = $this->auth->get_user('store_id');    	    	
    	$goods_name=$attributes['goods_name'];
    	$goods_sn=$attributes['goods_sn'];
    	$begin=strtotime($attributes["add_time_big"]);
    	$end   =strtotime($attributes["add_time_small"]." 23:59:59");    	
    	if($attributes['add_time_big'] != null){ $a = " and oi.add_time between '{$begin}' and '{$end}'";} 
		if($goods_name != null){ $b = " and og.goods_name like '%$goods_name%'";} 		
		if($goods_sn != null){ $c = " and og.goods_sn like '%$goods_sn%'";} 	
		
    	if ($store_id){
    		$sql="select goods_id,goods_name,goods_sn,price,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods";
    		$sql.=" as og on oi.order_id=og.order_id where oi.store_id=$store_id and oi.order_status=1$a$b$c)od group by goods_id";
    	}else{
			$sql="select goods_id,goods_name,goods_sn,price,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods";
	    	$sql.=" as og on oi.order_id=og.order_id where oi.order_status=1$a$b$c)od group by goods_id";    	
    	}
    	$query=$this->db->query($sql);
    	$num = $query->num_rows();    	
    	//分页
    	$data['total'] = $num;
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/count/index"),
            'total_rows' => $num,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        
        if ($store_id){
        	$sql_1="select goods_id,goods_name,goods_sn,price,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as";
        	$sql_1.=" og on oi.order_id=og.order_id where oi.store_id=$store_id and oi.order_status=1$a$b$c)od group by goods_id limit ".$this->pagination->get_cur_offset().','.$per_page;
        }else{
	        $sql_1="select goods_id,goods_name,goods_sn,price,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as";
	        $sql_1.=" og on oi.order_id=og.order_id where oi.order_status=1$a$b$c)od group by goods_id limit ".$this->pagination->get_cur_offset().','.$per_page;
        }
        $query_1=$this->db->query($sql_1);
		$data['goods_data']=$query_1->result_array();		    	
    	$this->load->view('sz_admin/count/index',$data);
    }
    
    public function view($goods_id){
    	$this->load->model("goods_model");
    	$this->load->model("store_model");
    	$store_id = $this->auth->get_user('store_id');
    	if ($store_id){
    		$sql="select goods_id,goods_name,goods_sn,price,store_id,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as og ";
    		$sql.="on oi.order_id=og.order_id where oi.order_status=1 and goods_id={$goods_id} and oi.store_id={$store_id})od group by store_id";
    	}else{    	    	
	    	$sql="select goods_id,goods_name,goods_sn,price,store_id,sum(goods_number) from (select oi.order_id,oi.store_id,og.goods_id,og.goods_name,og.goods_sn,og.price,og.goods_number from order_info as oi left join order_goods as og ";
	    	$sql.="on oi.order_id=og.order_id where oi.order_status=1 and goods_id={$goods_id})od group by store_id";
    	}
    	$query=$this->db->query($sql);
		$data['goods_data']=$query->result_array();	
		//p($data['goods_data']);
    	$this->load->view('sz_admin/count/view',$data);
    }
    
}
