<?php
header("content-type:text/html;charset=utf-8");
class Myorder extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->_site_path ="sz_front";
		$this->load->model('user_model');
	}

	
	/**
	 * 全部订单
	 * @param unknown_type $id
	 */
	public function orders($flag='all' ){
		$this->load->model('order_goods_model');
        $this->load->model('order_info_model');
        $this->load->model('store_model');
        $this->load->model('goods_model');
        $this->load->model('goods_evaluation_model');
        $user_id = $this->session->userdata('userid');  
		$user_name = $this->session->userdata('user_name');
		$data['current_type']=$flag;
		if($flag=="all"){
			//全部订单
			$search['attributes'] = array('user_id'=>$user_id,'status'=>0);
        	$search['orders'] = array('add_time'=>'desc');    	
        	$totalRows = $this->order_info_model->total($attributes,$search);
        	$data["totalRows"]=$totalRows;
        	if ($totalRows>0){
	        	$pageSize=10;
				$totalPage=ceil($totalRows/$pageSize);
				$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
				if($page<1||$page==null||!is_numeric($page)){
					$page=1;
				}
				if($page>=$totalPage)$page=$totalPage;
				$offset=($page-1)*$pageSize;        	
		        $search['limit'] = array(
		            'persize' => $pageSize,
		            'offset' => $offset
		        );
		        $data['pagination'] = $this->showPage($page,$totalPage);
        	}
			$data['all_orders'] = $this->order_info_model->all($search);        					
		}elseif ($flag=="pay"){
			//代付款订单
			$search['attributes'] = array('user_id'=>$user_id,'pay_status'=>0,'order_status'=>0,'status'=>0);			
			$search['orders'] = array('add_time'=>'desc'); 
			$totalRows = $this->order_info_model->total($attributes,$search);
			$data["totalRows"]=$totalRows;
			if ($totalRows>0){
	        	$pageSize=10;
				$totalPage=ceil($totalRows/$pageSize);
				$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
				if($page<1||$page==null||!is_numeric($page)){
					$page=1;
				}			
				if($page>=$totalPage)$page=$totalPage;		
				$offset=($page-1)*$pageSize;        	
		        $search['limit'] = array(
		            'persize' => $pageSize,
		            'offset' => $offset
		        );	        
		       $data['pagination'] = $this->showPage($page,$totalPage);
			}
			$data['all_orders'] = $this->order_info_model->all($search);
		}elseif ($flag =="ship"){
			$search['attributes'] = array('user_id'=>$user_id,'pay_status'=>2,'shipping_status'=>0,'order_status'=>0,'status'=>0);
			$search['orders'] = array('add_time'=>'desc'); 
			$totalRows = $this->order_info_model->total($attributes,$search);
			$data["totalRows"]=$totalRows;
        	if($totalRows>0){
				$pageSize=10;
				$totalPage=ceil($totalRows/$pageSize);
				$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
				if($page<1||$page==null||!is_numeric($page)){
					$page=1;
				}
				if($page>=$totalPage)$page=$totalPage;			
				$offset=($page-1)*$pageSize;        	
		        $search['limit'] = array(
		            'persize' => $pageSize,
		            'offset' => $offset
		        );
		        $data['pagination'] = $this->showPage($page,$totalPage);
        	}
			$data['all_orders'] = $this->order_info_model->all($search);
		}elseif ($flag =="check"){
			$search['attributes'] = array('user_id'=>$user_id,'shipping_status'=>1,'order_status'=>0,'status'=>0);
			$search['orders'] = array('add_time'=>'desc'); 
			$totalRows = $this->order_info_model->total($attributes,$search);
			$data["totalRows"]=$totalRows;
			if($totalRows>0){
	        	$pageSize=10;
				$totalPage=ceil($totalRows/$pageSize);
				$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
				if($page<1||$page==null||!is_numeric($page)){
					$page=1;
				}
	        	if($totalPage>0){
					if($page>=$totalPage)$page=$totalPage;
				}else{
					$page=1;
				}
				$offset=($page-1)*$pageSize;        	
		        $search['limit'] = array(
		            'persize' => $pageSize,
		            'offset' => $offset
		        );
		        $data['pagination'] = $this->showPage($page,$totalPage);
			}
			$data['all_orders'] = $this->order_info_model->all($search);
		}elseif ($flag=="eval"){
			$search['attributes'] = array('user_id'=>$user_id,'ele_status'=>0,'order_status'=>1,'status'=>0);
			$search['orders'] = array('add_time'=>'desc'); 
			$totalRows = $this->order_info_model->total($attributes,$search);
			$data["totalRows"]=$totalRows;
			if($totalRows>0){
	        	$pageSize=10;
				$totalPage=ceil($totalRows/$pageSize);
				$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
				if($page<1||$page==null||!is_numeric($page)){
					$page=1;
				}
	        	if($totalPage>0){
					if($page>=$totalPage)$page=$totalPage;
				}else{
					$page=1;
				}
				$offset=($page-1)*$pageSize;        	
		        $search['limit'] = array(
		            'persize' => $pageSize,
		            'offset' => $offset
		        );
		        $data['pagination'] = $this->showPage($page,$totalPage);
			}
			$data['all_orders'] = $this->order_info_model->all($search);
			
		}
		$data["id"]=$user_id;
//		p($search);
//		p($data['all_orders']);	
		$this->load->view($this->_site_path."/myorder/orders",$data);
	}
	/**
	 * 订单详情
	 * @param unknown_type $order_id
	 */
	public function order_detail($order_id,$current_type){
		$this->load->model('order_goods_model');
        $this->load->model('order_info_model');
        $this->load->model('store_model');
        $this->load->model('delivery_order_model');
        $this->load->model("user_province_model");
		$this->load->model("user_city_model");
		$this->load->model("user_address_model");
		$this->load->model("user_area_model");
		$this->load->model('goods_model');
		$user_id = $this->session->userdata('userid');    
		$user_name = $this->session->userdata('user_name');
        $this->is_login();     
        //订单信息
        $data["order_info"] =$this->order_info_model->get_by_pk($order_id);
        //p($data["order_info"]);
        //物流信息
        $search['attributes'] = array('order_id'=>$order_id);
        $data["delivery"] = $this->delivery_order_model->all($search);
        //订单商品信息
        $data["goods"] = $this->order_goods_model->all($search);
        $data["current_type"] = $current_type;
        //p($data["goods"] );
		$this->load->view($this->_site_path."/myorder/order_detail",$data);
	}
	/**
     * 删除订单
    */
	public function remove($order_id){
		$this->load->model('order_info_model');
		$this->load->model('order_goods_model');
		$data['status']=1;
		if($this->order_info_model->update_by_pk( $data, $order_id )){
			?>
				<script type="text/javascript">
					alert("删除订单成功");
					location.href=document.referrer;
				</script>
			<?php
		}
	}
	/**
     * 取消订单
    */
	public function cancel($order_id){
		$this->load->model('order_info_model');
		$this->load->model('order_goods_model');
		//订单取消 把order_info表中的order_status值改为2 
		if($this->order_info_model->update_by_pk( array( "order_status" => "2" ), $order_id )){
			?>
				<script type="text/javascript">
						alert("订单取消成功");
						location.href=document.referrer;				
				</script>
         	<?php 
		}		
	}

	//订单评价
	public function evaluate($order_id){
		//根据订单id要读出商品id
		$this->load->model('order_info_model');
		$this->load->model('order_goods_model');
		$this->load->model('goods_model');
		$this->load->model('goods_evaluation_model');
		$user_id = $this->session->userdata('userid');    
		$user_name = $this->session->userdata('user_name');
        $this->is_login();        
		$search['attributes'] = array('order_id'=>$order_id);
		$data['goods'] = $this->order_goods_model->all($search);
		$data["id"]=$order_id;
		$this->load->view($this->_site_path."/myorder/evaluate",$data);
	}
	//添加评价
	public function add_eval(){
		$id = $this->input->post("id");		
		$this->load->model('order_info_model');
		$this->load->model('order_goods_model');
		$this->load->model('user_model');
		$this->load->model('goods_model');
		$this->load->model('goods_evaluation_model');
		//根据订单号查找评论字段
		$evaluate_status = $this->order_info_model->get_value_by_pk($id,"ele_status");
		if ($evaluate_status==0){ //添加评论
				$search['attributes'] = array('order_id'=>$id);
				$goods = $this->order_goods_model->all($search);		
				$info =$this->input->post();		
				foreach ($info as $k=>$v){
					if(is_string($v)){
						$value=explode("/",$k);
						$current=current($value);
						$arr[end($value)]=$v;				
					}
				}	
				$i=0;		
				foreach ($arr as $ke=>$va){
					foreach ($info['goods_id'] as $key=>$val){
						if($val==$ke){
							$files[$i]['goods_id']=$val;
							$files[$i]['order_id']=$info['order_id'][$key];
							$files[$i]['user_id']=$info['user_id'][$key];
							$files[$i]['created_time']=$info['created_time'][$key];
							$files[$i]['content']=$info['content'][$key];
							$files[$i]['evaluation']=$va;
							$i++;				
						}
					}
				}
				//通过订单id查询user_id;
				$one=$this->order_info_model->get_by_attributes(array( 'order_id'=>$id));
				foreach ($files as $k=>$v){
					$data["goods_id"] = $v["goods_id"];
					$data["order_id"] = $v["order_id"];			
					$data["user_id"]=$v["user_id"];
					$data["content"] =$v["content"];
					$data["created_time"] =$v["created_time"];
					$data["evaluation"] =$v["evaluation"];	
				
					$ele_id = $this->goods_evaluation_model->insert($data);
					//更新评论表里的goods_name和user_name       
					$name_info['goods_name']=$this->goods_model->get_value_by_pk($v["goods_id"],"name");
					$name_info['user_name'] = $this->user_model->get_value_by_pk($v["user_id"],"user_name");
					$name_info['store_id'] = $this->user_model->get_value_by_pk($v["user_id"],"store_id");
					$this->goods_evaluation_model->update_by_pk($name_info, $ele_id);          
					//把ele_status值读出来 为0是评论 为1是追加评论
					$oid=$this->order_info_model->get_value_by_pk($v["order_id"],"ele_status");
					//p($v["order_id"]);
					if($oid==0){
						$this->order_info_model->update_by_pk( array( "ele_status" => "1" ), $v["order_id"] );
						?>
						<script type="text/javascript">
								alert("评论提交成功");
								window.location = "orders";				
						</script>
		         		<?php
		         		
					}															
				}		
		}elseif ($evaluate_status==1){ //追加评论
			$search['attributes'] = array('order_id'=>$id);
				$goods = $this->order_goods_model->all($search);		
				$info =$this->input->post();		
				foreach ($info as $k=>$v){
					if(is_string($v)){
						$value=explode("/",$k);
						$current=current($value);
						$arr[end($value)]=$v;				
					}
				}	
				$i=0;		
				foreach ($arr as $ke=>$va){
					foreach ($info['goods_id'] as $key=>$val){
						if($val==$ke){
							$files[$i]['goods_id']=$val;
							$files[$i]['order_id']=$info['order_id'][$key];
							$files[$i]['user_id']=$info['user_id'][$key];
							$files[$i]['created_time']=$info['created_time'][$key];
							$files[$i]['content']=$info['content'][$key];
							$files[$i]['evaluation']=$va;
							$i++;				
						}
					}
				}
				//通过订单id查询user_id;
				$one=$this->order_info_model->get_by_attributes(array( 'order_id'=>$id));
				foreach ($files as $k=>$v){
					$data["goods_id"] = $v["goods_id"];
					$data["order_id"] = $v["order_id"];			
					$data["user_id"]=$v["user_id"];
					$data["content"] =$v["content"];
					$data["created_time"] =$v["created_time"];
					$data["evaluation"] =$v["evaluation"];	
				
					$ele_id = $this->goods_evaluation_model->insert($data);
					//更新评论表里的goods_name和user_name       
					$name_info['goods_name']=$this->goods_model->get_value_by_pk($v["goods_id"],"name");
					$name_info['user_name'] = $this->user_model->get_value_by_pk($v["user_id"],"user_name");
					$name_info['store_id'] = $this->user_model->get_value_by_pk($v["user_id"],"store_id");
					$this->goods_evaluation_model->update_by_pk($name_info, $ele_id);          
					$this->order_info_model->update_by_pk( array( "ele_status" => "2" ), $id );
						?>
						<script type="text/javascript">
								alert("评论追加成功");
								window.location = "orders";				
						</script>
		         		<?php														
				}					
		}				
	}
	//追加评价
	function reeval($order_id){		
		//根据订单id要读出商品id
		$this->load->model('order_info_model');
		$this->load->model('order_goods_model');
		$this->load->model('goods_model');
		$this->load->model('goods_evaluation_model');
		$user_id = $this->session->userdata('userid');    
		$user_name = $this->session->userdata('user_name');
        $this->is_login();        
		$search['attributes'] = array('order_id'=>$order_id);
		$data['goods'] = $this->order_goods_model->all($search);
		$data["id"]=$order_id;
		$this->load->view($this->_site_path."/myorder/evaluate",$data);
	}
	//确认收货
	public function check_ship($id){
		$this->load->model('order_info_model');
		//订单确认 把order_info表中的order_status值改为1 
		if($this->order_info_model->update_by_pk( array( "order_status" => "1" ), $id )){
			?>
				<script type="text/javascript">
						alert("确认收货成功");
						location.href=document.referrer;		
				</script>
         	<?php 
		}		
	}
	
	public function back_order($rec_id){
		$this->load->model('order_goods_model');
		$this->load->model('order_info_model');
		$this->load->model('goods_model');
		$this->is_login();        
		$data['goods'] = $this->order_goods_model->get_by_pk($rec_id);	 	
		//p($data['goods']);
		$this->load->view($this->_site_path."/myorder/back_order",$data);
	}
	public function add_back(){
		$this->load->model('delivery_order_model');
		$this->load->model('back_order_model');
		$this->load->model('order_info_model');
		$this->load->model('order_goods_model');
		$back_data =$this->input->post();	
		$info = $this->delivery_order_model->get_by_attributes(array( 'order_id'=>$back_data['order_id']));	
		$order_info = $this->order_info_model->get_by_pk($back_data['order_id']);
		//插入back_order数据表
		$back_data['delivery_sn'] = $info['delivery_sn'];
		$back_data['invoice_no'] = $info['invoice_no'];
		$back_data['order_sn'] = $order_info['order_sn'];
		$back_data['add_time'] = $order_info['add_time'];
		$back_data['shipping_id'] = $info['shipping_id'];
		$back_data['shipping_name'] = $info['shipping_name'];
		$back_data['user_id'] = $info['user_id'];
		$back_data['consignee'] = $info['consignee'];
		$back_data['address'] = $info['address'];
		$back_data['province'] = $info['province'];
		$back_data['city'] = $info['city'];
		$back_data['district'] = $info['district'];
		$back_data['mobile'] = $info['mobile'];
		$back_data['update_time'] = strtotime(date('Y-m-d H:i:s'));
		$back_data['store_id'] = $info['store_id'];
		//判断是否有此订单的商品退货没有则加入
		$back_info = $this->back_order_model->get_by_attributes(array( 'order_id'=>$back_data['order_id']));	
		if (!$back_info){
			$id = $this->back_order_model->insert($back_data);
		}
		//把order_goods表中status字段改为1
		if ($this->order_goods_model->update_by_pk( array( "status" => "1",'how_oos'=>$back_data['how_oos'] ), $back_data['rec_id'] )){
			?>
				<script type="text/javascript">
						alert("申请退货成功");
						window.location = "orders";	
				</script>
         	<?php 
		}
		//redirect('sz_front/myorder/orders');
	}
	/**
     * 判断是否登录
    */
    public function is_login() {
        $user_name = $this->session->userdata('user_name');
        $user_id = $this->session->userdata('userid');
        if (empty($user_id)) {
            redirect(base_url('sz_front/user/login'));
        }
    }
   
    public function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
		$where=($where==null)?null:"&".$where;
		$url = $_SERVER ['PHP_SELF'];
		$index = ($page == 1) ? "<span>首页</span>" : "<a href='{$url}?page=1{$where}'>首页</a>";
		$last = ($page == $totalPage) ? "<span>尾页</span>" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
		$prevPage=($page>=1)?$page-1:1;
		$nextPage=($Page>=$totalPage)?$totalPage:$page+1;
		$prev = ($page == 1) ? "<span>上一页</span>" : "<a href='{$url}?page={$prevPage}{$where}'>上一页</a>";
		$next = ($page == $totalPage) ? "<span>下一页</span>" : "<a href='{$url}?page={$nextPage}{$where}'>下一页</a>";
		//str = "总共{$totalPage}页/当前是第{$page}页";
		for($i = 1; $i <= $totalPage; $i ++) {
			//当前页无连接
			if ($page == $i) {
				$p .= "<span class='hover'>[{$i}]</span>";
			} else {
				$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
			}
		}
	 	$pageStr=$str.$sep . $index .$sep. $prev.$sep . $p.$sep . $next.$sep . $last;
	 	return $pageStr;
	}
}