<?php
/**
 * delivery_order
 * @version 1.0
 * @package application
 * @subpackage application/controllers/delivery_order/
 */
class Delivery_order extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->model('order_info_model');
		$this->load->model('delivery_order_model');
		$this->load->model('store_model');
		$search['attributes'] = $this->input->get();
		$search['orders'] = array(
            'delivery_id' => 'desc'
        );
		$data['store_name'] = $this->store_model->get_appoint_values(array('id', 'sName'));
		$total = $this->delivery_order_model->total(null,$search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('sz_admin/delivery_order/index'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());
        
		$data["delivery"]=$this->delivery_order_model->all($search);
		//p($data["delivery"]);
		$this->load->view($this->_site_path."/delivery_order/index",$data);
	}
	//详情页
	public function view($delivery_id){
		$this->load->model("delivery_order_model");
		$this->load->model("order_info_model");
		$this->load->model("order_goods_model");
		$this->load->model("user_model");
		$this->load->model("user_province_model");
		$this->load->model("user_city_model");
		$this->load->model("user_area_model");
		$this->load->model("goods_model");
		$this->load->model("store_model");
		$delivery_data = $this->delivery_order_model->get_by_pk( $delivery_id );
		$data['delivery_data'] =$delivery_data;
		//p($data['delivery_data']);
		$search['attributes'] = array('order_id'=>$delivery_data["order_id"]);
		$data["goods_data"] = $this->order_goods_model->all($search);
		//p($data["goods_data"]);
		$this->load->view( 'sz_admin/delivery_order/view', $data );
	}
	//修改发货状态
	public function edit($delivery_id){
		$this->load->model("delivery_order_model");
		$this->load->model("shipping_model");
		$this->load->model("store_model");
		$this->load->model("order_info_model");
		$data['delivery_data'] = $this->delivery_order_model->get_by_pk( $delivery_id );
		$data['shipping_data'] = $this->shipping_model->all();
		//p($data['delivery_data']);
		if ($this->input->post('is_submit') ) {
			try {
				$ship_data = $this->input->post();		
				$ship_data["shipping_name"]=$this->shipping_model->get_value_by_pk( $ship_data["shipping_id"],"shipping_name" );
				$data['ship_data'] = $ship_data;		
				$rule_config = array(				
					array('field'=> 'invoice_no' , 'label'=> '物流单号' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules( $rule_config );
				if (!$this->form_validation->run()) throw new Exception( validation_errors(), 0 );
								
				//修改
				$this->delivery_order_model->update_by_pk( $data['ship_data'], $delivery_id );
				init_messagebox( '修改成功', 'success', 1, base_url( 'sz_admin/delivery_order/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}		
		$this->load->view( 'sz_admin/delivery_order/form', $data );
	}
	//取消发货状态
	public function cancel($order_id){
		$this->load->model("order_info_model");
		$data["shipping_status"] =0;
		if($this->order_info_model->update_by_pk( $data, $order_id )){
			?>
			<script type="text/javascript">
						alert("操作成功");
						location.href=document.referrer;					
			</script>
			<?php 
		}
		
	}
	//恢复发货
	public function docheck($order_id){
		$this->load->model("order_info_model");
		$data["shipping_status"] =1;
		if($this->order_info_model->update_by_pk( $data, $order_id )){
			?>
			<script type="text/javascript">
						alert("操作成功");
						location.href=document.referrer;					
			</script>
			<?php 
		}		
	}
	
	public function getcity(){
		$id=$_GET['oneid'];
		$sql = "select * from user_city where pid={$id}";
		$result = mysql_query($sql);
		?>
		$one="<option value=''>请选择</option>";
		<?php
		while($rs =  mysql_fetch_assoc($result)){
		?>
		$one.="<option value='<?php echo $rs["id"]?>'><?php echo $rs["city_name"]?></option>";
		<?php
		}
		//$data['one']=$one;
		//$this->load->view($this->_site_path."/user/getcity",$data);
	}
	//根据城市id得到区县
	public function getarea(){
		$id=$_GET['cityid'];
		$sql = "select * from user_area where pid={$id}";
		$result = mysql_query($sql);
		?>
		$two="<option value=''>请选择</option>";
		<?php
		while($rs =  mysql_fetch_assoc($result)){
		?>
		$two.="<option value='<?php echo $rs["id"]?>'><?php echo $rs["area_name"]?></option>";
		<?php
		}
		echo $two;
		//$this->load->view($this->_site_path."/user/getarea");
	}
	
}
