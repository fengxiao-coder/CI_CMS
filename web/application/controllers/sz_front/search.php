<?php

class Search extends Front_Controller {

    public $is_mobile = 1;
    public $mobile_path = "mobile_search";

    public function __construct() {
        parent::__construct();
        $this->is_mobile = $this->common->is_mobile();
        $this->_site_path = config_item('front_path');
        $this->load->model('goods_model');
        $this->load->model('goods_category_model');
        $this->load->model('user_model');
    }

    public function index($id) {
        $data['category'] = $this->select_category();
        $data["cart_id"] = $id;
        if (!$id) {
            $sql = "select * from goods_category where pid =0";
            $query = $this->db->query($sql);
            $data['hot1'] = $query->result_array();
            //p($data['hot1']);
            foreach ($data['hot1'] as $key => $value) {
                $sql = "select * from goods_category where pid ={$value['cat_id']}";
                $query = $this->db->query($sql);
                $data['hot2'][] = $query->result_array();
            }
            //p($data['hot2']);
            foreach ($data['hot2'] as $key1 => $value1) {
                foreach ($value1 as $key2 => $value2) {
                    $sql = "select * from goods_category where pid ={$value2['cat_id']}";
                    $query = $this->db->query($sql);
                    $data['goods_category'][] = $query->result_array();
                }
            }
        } else {
            $sql = "select * from goods_category where pid ={$id}";
            $query = $this->db->query($sql);
            $data['category2'] = $query->result_array();
           //p($data['category2']);
            foreach ($data['category2'] as $key3 => $value3) {
                $sql = "select * from goods_category where pid ={$value3['cat_id']}";
                //echo $sql;
                $query = $this->db->query($sql);
                $data['goods_category'][$value3['cat_id']] = $query->result_array();
            }
        }
        //p($data['goods_category']);
        $this->load->view_part("sz_front/search/index", $data);
    }

    public function lists($id,$flag="all") {  	
        $data['id'] = $id;        
        $this->load->model('brand_model');
        $search['attributes'] = array('cid'=>$id);
        $data['brand_data'] = $this->brand_model->all($search);
        $data['category'] = $this->select_category();
    	$info = $this->input->get();
    	//p($info);
        //$search['attributes'] = array('pid' => $id,'status'=>0);
        $search['attributes'] = array('pid' => $id,'status'=>0,'num_big'=>1);
        $data['current_type']=$flag;
        if($flag=="all"){
        	//综合
        	$search['orders'] = array('created' => 'asc');
        }elseif ($flag=="sales"){
			if ($info){
				$attributes = array('pid' => $id,'status' => 0,'name_like'=>$info["name"]);
				$search = array(
	                'attributes' => $attributes,
	                'orders' => array('sales' => 'asc'),
         		);
			}else{
				$search['orders'] = array('sales' => 'asc');
			}       
			$data["name_like"]=$info["name"]; 	
        }elseif ($flag=="price"){
        	if ($info){
				$attributes = array('pid' => $id,'status' => 0,'name_like'=>$info["name"]);
				$search = array(
	                'attributes' => $attributes,
	                'orders' => array('price' => 'asc'),
         		);
			}else{
				$search['orders'] = array('price' => 'asc');
			}   
			$data["name_like"]=$info["name"];    
        }	
                        
    	if($this->input->post('submit')) {
			//查询按钮
	    	$search['attributes'] = $this->input->post();	    	
	    	if (!$id){
	    		$attributes = array('status' => 0,'name_like'=>$search['attributes']['name_like']);    		    		
	    	}else{
	    		$attributes = array('pid' => $id,'status' => 0,'name_like'=>$search['attributes']['name_like']);	    	    		
	    	}	    	
	    	$search = array(
	                'attributes' => $attributes,
	                'orders' => array('id' => 'desc', 'created' => 'asc'),
         	);
         	$data["name_like"]=  $search['attributes']['name_like'];
		}
        // p($search);
        $data['goods'] = $this->goods_model->get_appoint_values(array('id', 'name', 'price', 'photo'), null, $search);

        $this->load->view_part("sz_front/search/lists", $data);
    }
	
    public function check($flag="all"){
        $this->load->model('brand_model');
        $data['brand_data'] = $this->brand_model->all($search);
        $data['category'] = $this->select_category();
    	$search['attributes'] = $this->input->post();
        $data['current_type']=$flag;
        if ($flag=="all"){
        	$attributes=array('status' => 0,'name_like'=>$search['attributes']['name_like']);   
        	$search = array(
	                'attributes' => $attributes,
	                'orders' => array('id' => 'desc', 'created' => 'asc'),
         	);
         	$data["name_like"]=  $search['attributes']['name_like'];
        }elseif ($flag=="sales"){
        	$info = $this->input->get();
        	$attributes = array('status' => 0,'name_like'=>$info["name"]);
			$search = array(
	               'attributes' => $attributes,
	               'orders' => array('sales' => 'asc'),
         	);
         	$data["name_like"]=$info["name"];   
        }elseif ($flag=="price"){
        	$info = $this->input->get();
        	$attributes = array('status' => 0,'name_like'=>$info["name"]);
			$search = array(
	               'attributes' => $attributes,
	               'orders' => array('price' => 'asc'),
         	);
         	$data["name_like"]=$info["name"];   
        }
        
        $data['goods'] = $this->goods_model->get_appoint_values(array('id', 'name', 'price', 'photo'), null, $search);
    	$this->load->view_part("sz_front/search/lists", $data);
    }
    //筛选
    public function filter($id,$flag="all"){    
    	$data["id"]=$id;	
    	$data['current_type']=$flag;    	
    	$this->load->model('brand_model');
    	if ($id){
    		$search['attributes'] = array('cid'=>$id);
    	}
    	
        $data['brand_data'] = $this->brand_model->all($search);        
        $data['category'] = $this->select_category();          
    	$search_1 = $this->input->post();
    	//p($search_1);
		if ($search_1["brand_id"]){
		    	$price = explode('-', $search_1['price_search']);
		        if ($price['1']) {
		                $attributes = array('brand_id' => $search_1['brand_id'], 'pid' => $id, 'price_big' => $price['0'], 'price_small' => $price['1'], 'status' => 0);
		        } else {
		                $attributes = array('brand_id' => $search_1['brand_id'], 'price_big' => $price['0'], 'status' => 0);
		       	}
    	}else{
    			$price = explode('-', $search_1['price_search']);
		        if ($price['1']) {
		                $attributes = array( 'pid' => $id, 'price_big' => $price['0'], 'price_small' => $price['1'], 'status' => 0);
		        } else {
		                $attributes = array( 'pid' => $id, 'price_big' => $price['0'], 'status' => 0);
		       	}
    	}
    	
	   	$search = array(
	            'attributes' => $attributes,
	            'orders' => array('id' => 'desc', 'created' => 'asc'),
        );
              
        $data["brand_id"]=  $search['attributes']['brand_id'];
        $data["price_big"]=  $search['attributes']['price_big'];
        $data["price_small"]=  $search['attributes']['price_small'];
     	if($flag=="all"){
        	//综合
        	$search['orders'] = array('created' => 'asc');       
     	}elseif ($flag=="sales"){
        	$info = $this->input->get();
     		if ($info['brand_id']){
		        	if ($info['price_small']){
		        		$attributes = array('brand_id' => $info['brand_id'], 'pid' => $id, 'price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array('brand_id' => $info['brand_id'], 'price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}else{
        			if ($info['price_small']){
		        		$attributes = array('pid' => $id, 'price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array('pid' => $id, 'price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}        	
			$search = array(
	            'attributes' => $attributes,
	             'orders' => array('sales' => 'asc'),
         	);
         	$data["brand_id"]=  $search['attributes']['brand_id'];
	        $data["price_big"]=  $search['attributes']['price_big'];
	        $data["price_small"]=  $search['attributes']['price_small'];         	
        }elseif ($flag=="price"){
        	$info = $this->input->get();
        	if ($info['brand_id']){
		        	if ($info['price_small']){
		        		$attributes = array('brand_id' => $info['brand_id'], 'pid' => $id, 'price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array('brand_id' => $info['brand_id'],'pid' => $id, 'price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}else{
        			if ($info['price_small']){
		        		$attributes = array('pid' => $id, 'price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array('pid' => $id, 'price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}
        	        	
			$search = array(
	            'attributes' => $attributes,
	             'orders' => array('price' => 'asc'),
         	);
         	$data["brand_id"]=  $search['attributes']['brand_id'];
	        $data["price_big"]=  $search['attributes']['price_big'];
	        $data["price_small"]=  $search['attributes']['price_small'];
        }

    	$data['goods'] = $this->goods_model->get_appoint_values(array('id', 'name', 'price', 'photo'), null, $search);
    	//p($data['goods']);
    	$this->load->view_part("sz_front/search/list", $data);
    }
    public function screen($flag="all"){
    	$this->load->model('brand_model');
        $data['brand_data'] = $this->brand_model->all();
        $data['category'] = $this->select_category();
    	$search_1 = $this->input->post();
        $data['current_type']=$flag;
        if ($search_1["brand_id"]){
		    	$price = explode('-', $search_1['price_search']);
		        if ($price['1']) {
		                $attributes = array('brand_id' => $search_1['brand_id'], 'price_big' => $price['0'], 'price_small' => $price['1'], 'status' => 0);
		        } else {
		                $attributes = array('brand_id' => $search_1['brand_id'], 'price_big' => $price['0'], 'status' => 0);
		       	}
    	}else{
    			$price = explode('-', $search_1['price_search']);
		        if ($price['1']) {
		                $attributes = array('price_big' => $price['0'], 'price_small' => $price['1'], 'status' => 0);
		        } else {
		                $attributes = array( 'price_big' => $price['0'], 'status' => 0);
		       	}
    	}   	
	   	$search = array(
	            'attributes' => $attributes,
	            'orders' => array('id' => 'desc', 'created' => 'asc'),
        );
        $data["brand_id"]=  $search['attributes']['brand_id'];
        $data["price_big"]=  $search['attributes']['price_big'];
        $data["price_small"]=  $search['attributes']['price_small'];
   		 if($flag=="all"){
        	//综合
        	$search['orders'] = array('created' => 'asc');       
     	}elseif ($flag=="sales"){
        	$info = $this->input->get();
     		if ($info['brand_id']){
		        	if ($info['price_small']){
		        		$attributes = array('brand_id' => $info['brand_id'], 'price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array('brand_id' => $info['brand_id'], 'price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}else{
        			if ($info['price_small']){
		        		$attributes = array( 'price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array('price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}        	
			$search = array(
	            'attributes' => $attributes,
	             'orders' => array('sales' => 'asc'),
         	);
         	$data["brand_id"]=  $search['attributes']['brand_id'];
	        $data["price_big"]=  $search['attributes']['price_big'];
	        $data["price_small"]=  $search['attributes']['price_small'];         	
        }elseif ($flag=="price"){
        	$info = $this->input->get();
        	if ($info['brand_id']){
		        	if ($info['price_small']){
		        		$attributes = array('brand_id' => $info['brand_id'], 'price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array('brand_id' => $info['brand_id'], 'price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}else{
        			if ($info['price_small']){
		        		$attributes = array('price_big' =>$info['price_big'], 'price_small' => $info['price_small'], 'status' => 0);
		        	}else{
		        		$attributes = array( 'price_big' => $info['price_big'], 'status' => 0);
		        	}
        	}
        	        	
			$search = array(
	            'attributes' => $attributes,
	             'orders' => array('price' => 'asc'),
         	);
         	$data["brand_id"]=  $search['attributes']['brand_id'];
	        $data["price_big"]=  $search['attributes']['price_big'];
	        $data["price_small"]=  $search['attributes']['price_small'];
        }        
    	//p($search);
        
        $data['goods'] = $this->goods_model->get_appoint_values(array('id', 'name', 'price', 'photo'), null, $search);
    	$this->load->view_part("sz_front/search/list", $data);
    }

    public function details($id) {
        $id = (int) $id;
        $data['contents'] = $this->goods_model->get_by_pk($id);
        $this->load->model('brand_model');
        $data['brand'] = $this->brand_model->get_by_pk($data['contents']['brand_id']);
        $path = $this->check_path();
        $this->load->view_part($path, $data);
    }

    public function remind() {
        $this->load->view('sz_front/search/remind');
    }

    public function validate_input() {
        $data = $this->input->get();
        $result = array();
        if (empty($data['search']) || empty($data['by_method'])) {
            $result = array('msg' => '请输入有效查询条件', 'flag' => 0);
        } else {
            $attributes = array($data['by_method'] => mysql_real_escape_string($data['search']));
            $total = $this->goods_model->total($attributes);
            if (!$total) {
                $result = array('msg' => '该查询没有记录，请重新输入查询条件', 'flag' => 0);
            } else {
                $result = array('msg' => '', 'flag' => 1);
            }
        }
        header("Content-type:application/json:charset=utf-8");
        die(json_encode($result));
    }

    /*
     * 加载视图的路径  区分手机跟pc
     */

    public function check_path() {
//echo $this->is_mobile;
        if ($this->is_mobile) {
            $path = "sz_front/mobile_search/detail";
        } else {
            $path = "sz_front/search/detail";
        }
        return $path;
    }

//获取category 分类
    public function select_category() {
        $search = array(
            'attributes' => array('pid' => 0, 'status' => 0),
            //'limit'  =>array('persize' => 6, 'offset' => 0),
            'orders' => array('sort' => 'desc', 'created' => 'asc'),
        );
        return $this->goods_category_model->get_appoint_values(array('cat_id', 'nodepath', 'cat_name'), null, $search);
    }

//获取 nodepath 第一个字段相同的数组
    public function select_firstnode() {
        $arr = array();
        $sql = "select * from goods_category where pid !=0";
        $query = $this->db->query($sql);
        $result1 = $query->result_array();
//p($result1);
        foreach ($result1 as $key => $value) {
            $value['nodepath'] = current(explode(',', $value['nodepath']));
            $arr[] = $value;
        }
        p($arr);
    }

}
