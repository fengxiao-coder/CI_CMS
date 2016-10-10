<?php

/**
 * index
 * @author xiaofeng 
 * @version 1.0
 * @package application
 */
class Message extends Front_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('news_model');
		$this->load->model('news_sort_model');
		$this->load->model('message_model');
	}
	
	public function index(){
		$data = array();
		
		$search = array(
				'orders'     => array('id'=>'desc'),
		);
		// 总数与分页
		$total = $this->message_model->total( null, $search );
		$data['total'] = $total;
		// 请使用config_item( 'per_page' )获取全局显示条数
		//$per_page = config_item( 'per_page' ) ;
		$per_page = 8;
		$this->load->library( 'pagination' );
		$pagination_config = array(
				'base_url' => base_url($this->_site_path . '/message/index/' ),
				'total_rows' => $total,
				'per_page' => $per_page,
				'uri_segment' => 4,
		);
		//分页
		$this->pagination->initialize( $pagination_config );
		$data['pagination'] = $this->pagination->create_links();
		$search['limit'] = array( 'persize' => $per_page, 'offset' => $this->pagination->get_cur_offset() );
		$data['msgs'] = $this->message_model->all($search );
//		p($data);exit;
		//公告信息
		$parentid=$this->news_sort_model->get_appoint_values(array('id'),null,array(array('parentid'=>44)));
		foreach ($parentid as $k=>$v){
			$data['notice'][$k]=$this->news_model->get_appoint_values(array('id','title','content'),null,array('attributes'=>array('parentid'=>$v['id'])));
		}

		$data['p_data'] = '在线留言';
		$this->load->view( $this->_site_path."/message/index", $data );
	}
	
	//回复留言
	public function reply_msg(){
		
		$captcha_word = $this->session->userdata('captcha_word');
		if (isset($captcha_word) && $captcha_word==strtoupper($_POST['validate'])){
			$msg_data = array();
			$msg_data['visitor_name'] = htmlspecialchars(strip_tags($_POST['name']));
			$msg_data['comment'] = htmlspecialchars(strip_tags($_POST['msg']));
			//验证规则
			if(!$msg_data['visitor_name']){
				echo json_encode(array('content' => '请填写您的名字！'));
				exit;
			}
			if(!$msg_data['comment']){
				echo json_encode(array('content' => '请填写您要回复的内容！'));
				exit;
			}
			$msg_data['comment_time'] = time();
			//插入
			if(!$this->message_model->insert( $msg_data )){
				echo json_encode(array('content' => '回复失败！'));
			}else{
				echo json_encode(array('content' => 'ok'));
			}
			exit;
		}else{
			echo json_encode(array('content' => '验证码有误！'));
		}
	}
	
	//获取验证码
	public function get_captcha(){
		
		$this->load->library('captcha');
		$img = new captcha('./theme/front/images/captcha/', 50, 25);
		$img->generate_image();
	}
}