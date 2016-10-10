<?php
/**
 * goods_evaluation
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_evaluation/
 */
class Goods_evaluation extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		
	}
	
	public function index($flag='goods') {
		$this->load->model('goods_evaluation_model');
		$this->load->model('goods_model');
		$this->load->model('user_model');
		$this->load->model('reply_evaluation_model');	
		$search['attributes'] = $this->input->get();
		$data['current_type']=$flag;
		$search['orders'] = array(
	            'id' => 'desc'
	     );
		if ($this->auth->get_user('store_id')){
        	$search['attributes']['store_id'] = $this->auth->get_user('store_id');
        }        
        if($flag=="goods"){
        	//好评 读取evaluation=0
        	$search['attributes']["evaluation"] = 0;	        	        		        	        	 	        
        }elseif ($flag=="middle"){
        	//好评 读取evaluation=1
        	$search['attributes']["evaluation"] = 1;	
        }elseif ($flag=="bad"){
        	//好评 读取evaluation=2
        	$search['attributes']["evaluation"] = 2;
        }
		$total = $this->goods_evaluation_model->total(null, $search);
		//p($total);
		$data['total'] = $total;
	    $per_page = config_item('per_page');
	    $this->load->library('pagination');
	    $pagination_config = array(
	        'base_url' => base_url('sz_admin/goods_evaluation/index/'.$flag.'?&'),
	        'total_rows' => $total,
	         'per_page' => $per_page,
	         'uri_segment' => 4,
	         'page_query_string' => TRUE, 
			 'enable_query_strings'=>TRUE,
	    );
	    $this->pagination->initialize($pagination_config);
	    $data['pagination'] = $this->pagination->create_links();
	    $search['limit'] = array('persize' => $per_page, 'offset' => $this->pagination->get_cur_offset());        
        $data['goods_evaluation_data'] = $this->goods_evaluation_model->all($search);
        //p($data['goods_evaluation_data']);
        $this->load->view('sz_admin/goods_evaluation/index', $data);
    }
    
    /**
     * Enter description 回复 ...
     */
    public function reply($id){
    	$this->load->model('goods_evaluation_model');
		$this->load->model('goods_model');
		$this->load->model('user_model');		
		$this->load->model('reply_evaluation_model');	
    	$data["info"] = $this->goods_evaluation_model->get_by_pk($id);
    	
     	if ($this->input->post('is_submit') && $this->form_validation->check_token()) {
            try {
                $reply_data = $this->input->post();
                $reply_data['admin_id'] = $this->auth->get_user('admin_id');
                $reply_data['created_time'] =strtotime(date('Y-m-d H:i:s'));
                $data['reply_data']=$reply_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'content', 'label' => '回复评论', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //插入                              
                $rep_id = $this->reply_evaluation_model->insert($reply_data);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods_evaluation/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
     	}
     	
    	$this->load->view('sz_admin/goods_evaluation/form', $data);
    }
    
    public function view($id){
    	$this->load->model('goods_evaluation_model');
		$this->load->model('goods_model');
		$this->load->model('user_model');		
		$this->load->model('reply_evaluation_model');	
    	$data["info"] = $this->goods_evaluation_model->get_by_pk($id);
    	//$data["reply_info"] = $this->reply_evaluation_model->get_by_attributes(array("ge_id"=>$id));
    	$data["reply_info"] = $this->reply_evaluation_model->all(array('attributes' => array('ge_id' => $id)));
    	//p($data["reply_info"]);
    	$this->load->view('sz_admin/goods_evaluation/view', $data);
    }
    
    //修改评价
    public function edit($id){
    	$this->load->model('goods_evaluation_model');
		$this->load->model('goods_model');
		$this->load->model('user_model');		
		$this->load->model('reply_evaluation_model');	
		$data["reply_data"] = $this->reply_evaluation_model->get_by_pk($id);
		$data["info"] = $this->goods_evaluation_model->get_by_attributes(array("id"=>$data["reply_data"]["ge_id"]));
    	if ($this->input->post('is_submit') && $this->form_validation->check_token()) {
            try {
                $reply_info['content'] = $this->input->post('content');
                $data['reply_info'] = $reply_info;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'content', 'label' => '回复评论', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //修改
                $this->reply_evaluation_model->update_by_pk($data['reply_info'], $id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/goods_evaluation/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
    	}
    	$this->load->view('sz_admin/goods_evaluation/form', $data);
    }
    
    public function delete($rep_id){
    	$this->load->model('reply_evaluation_model');	   	
    	if($this->reply_evaluation_model->delete_by_pk( $rep_id )){
    		?>
    			<script type="text/javascript">
					alert("删除成功");
					window.location = document.referrer;
    			</script>
    		<?php 
    	}
		//redirect( base_url( 'sz_front/goods_evaluation/index' ));
    }
}


