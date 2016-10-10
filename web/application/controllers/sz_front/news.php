<?php

/**
 * index
 * @author xiaofeng 
 * @version 1.0
 * @package application
 */
class news extends Front_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('news_model');
		$this->load->model('news_sort_model');
	}
	
	//频道页
	public function channel($id) {
		
		if ( intval($id)<=0 ){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$data = array( );
		//父类类名
		$p_data = $this->news_sort_model->get_value_by_pk($id, 'sortname');
		if(!$p_data){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$data['p_data'] = $p_data;
		$search = array(
			'attributes' => array( 'recycled' => 0, 'parentid' => $id),		
			'orders'     => array('depth' => 'asc'),		
		);
		//子类类名
		$data['newssort_data'] = $this->news_sort_model->get_values( 'id', 'sortname', null, $search );
		$data['pid'] = $id;
		//公告信息
		$parentid=$this->news_sort_model->get_appoint_values(array('id'),null,array(array('parentid'=>44)));
		foreach ($parentid as $k=>$v){
			$data['notice'][$k]=$this->news_model->get_appoint_values(array('id','title','content'),null,array('attributes'=>array('parentid'=>$v['id'])));
		}
//		p($data);
		$this->load->view( $this->_site_path.'/news/channel', $data );
	}
	
	//列表页
	public function lists($pid){
		if(intval($pid) <= 0){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$ids = array(2, 3, 4);
		//当该id是属于2,3,4时，则直接跳至文章页面
		if(in_array($pid, $ids)){
			$condition = array(
					'attributes'  => array('parentid' => $pid, 'status'=>0),
					'limit'           => array('persize'=>1, 'offset'=>0),
					'orders'       => array('depth' => 'asc', 'created'=>'desc'),
			);
			$article_info = $this->news_model->get_values('id', 'id', null, $condition);
			header('location:' . base_url($this->_site_path . '/news/article/' . end($article_info)));
			exit;
		}
		//父类数据
		$sortname = $this->news_sort_model->get_value_by_pk($pid, 'sortname');
		if(!isset($sortname)){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$data = array();
		$data['classifyid'] = $pid;
		//下载中心不考虑子类
		if($pid != 36){
			//获取分类
			$this->_get_classify($data, $pid);
		}else{
			$data['p_data'] = $sortname;
		}
		//分类标题
		$data['p_title'] = $sortname;
		$search = array(
				'attributes' => array('parentid' => $pid, 'status'=>0),
				'orders'     => array('depth' => 'asc', 'created'=>'desc'),
		);
		// 总数与分页
		$total = $this->news_model->total( null, $search );
		$data['total'] = $total;
		// 请使用config_item( 'per_page' )获取全局显示条数
		$per_page = ($pid==22)?9:config_item( 'per_page' ) ;
		$this->load->library( 'pagination' );
		$pagination_config = array(
			'base_url' => base_url($this->_site_path . '/news/lists/' . $pid),
			'total_rows' => $total,
			'per_page' => $per_page,
			'uri_segment' => 5,
		);
		//公告信息
		$parentid=$this->news_sort_model->get_appoint_values(array('id'),null,array(array('parentid'=>44)));
		foreach ($parentid as $k=>$v){
			$data['notice'][$k]=$this->news_model->get_appoint_values(array('id','title','content'),null,array('attributes'=>array('parentid'=>$v['id'])));
		}
		
		//分页
		$this->pagination->initialize( $pagination_config );
		$data['pagination'] = $this->pagination->create_links();
		$search['limit'] = array( 'persize' => $per_page, 'offset' => $this->pagination->get_cur_offset() );
		//品种介绍分类页面做特殊处理
		$fields = ($pid==22)?array('id', 'title', 'imagemark'):array('id', 'title', 'created');
		$data['lists'] = $this->news_model->get_appoint_values($fields, null, $search );
		//p($data);
		if($pid==22){
			$this->load->view( $this->_site_path."/news/lists_seed", $data );
		}else{
			$this->load->view( $this->_site_path."/news/lists", $data );
		}
	}
	
	//文章详细信息
	public function article($id, $flag=null){
		
		//60*24缓存时间为一天
		//$this->output->cache(60*24);
		if(intval($id) <= 0){
			header('location:'.base_url($this->_site_path.'/index/index'));exit;
		}
		$data = array();
		//获取文章信息
		$data['info'] = $this->news_model->get_by_pk($id);
		if(!$data['info']){
			header('location:'.base_url($this->_site_path.'/index/index'));exit;
		}
		//http请求来自后台，且文章状态为已审核时，则不需要进行文件是否审核验证
		if($flag==md5('admin')){
			//echo '<pre>';print_r($data['info']);exit;
			$this->load->library('auth');
			$group_id = $this->auth->get_user('group_id');
			if(!$group_id || ($group_id!=1&&$data['info']['status']!=0)){
				$this->_get_status($id);
			}
		}else{
			$this->_get_status($id);
		}
		//公告信息
		$parentid=$this->news_sort_model->get_appoint_values(array('id'),null,array(array('parentid'=>44)));
		foreach ($parentid as $k=>$v){
			$data['notice'][$k]=$this->news_model->get_appoint_values(array('id','title','content'),null,array('attributes'=>array('parentid'=>$v['id'])));
		}
		
		$data['classifyid'] = $data['info']['parentid'];
		//获取分类
		$this->_get_classify($data, $data['info']['parentid']);
		//增加文章的点击次数
		//$this->news_model->update_by_pk(array('clickcount'=>$data['info']['clickcount']+1), $id);
		$this->load->view( $this->_site_path."/news/article", $data );
	}
	
	//文章下载中心
	public function download($id){
		
		if(intval($id) <= 0){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$this->_get_status($id);
		$data = array();
		//获取文章信息
		$data['info'] = $this->news_model->get_by_pk($id);
		if(!$data['info']){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		//父类名称
		$sortname = $this->news_sort_model->get_value_by_pk($data['info']['parentid'], 'sortname');
		if(!$sortname){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$data['p_data'] = $sortname;
		//公告信息
		$parentid=$this->news_sort_model->get_appoint_values(array('id'),null,array(array('parentid'=>44)));
		foreach ($parentid as $k=>$v){
			$data['notice'][]=$this->news_model->get_appoint_values(array('id','title','content'),null,array('attributes'=>array('parentid'=>$v['id'])));
		}
		$this->load->view( $this->_site_path."/news/download", $data );
	}
	
	//获取首页列表文章
	public function get_lists_article($pid, $words) {
		//echo $pid;
		if(intval($pid)<=0 || intval($words)<=0){
			echo '';exit;
		}
		//针对不同的类显示多少条数据
		if($pid != 6){
			$persize = 7;
		}else{
			$persize = 5;
		}
		$condition = array(
			'attributes'  => array('nodepath_like' => ",{$pid},", 'status'=>0),
			'limit'           => array('persize'=>$persize, 'offset'=>0),
			'orders'       => array('depth' => 'asc', 'created'=>'desc'),	
		);
		
		$data = array();
		$data['pid']=$pid;
		$data['words'] = $words;
		$data['created']=$this->news_model->get_values('id','created',null, $condition);
		$data['articles'] = $this->news_model->get_values('id', 'title', null, $condition);
		
		//通过文章ID得到图片路径和图片ID
		foreach ($data['articles'] as $k=>$v){
			$imagemark=$this->news_model->get_value_by_pk($k,'imagemark');
			$data['imagemark'][$k]=$imagemark;
		}
		$this->load->view_part( $this->_site_path.'/news/ajax_lists_article', $data );
	}
	
	
	//获取频道页子类文章
	public function get_channel_article($pid, $topid=null){
		
		if(intval($pid) <= 0){
			echo '';exit;
		}
		$condition = array(
				'attributes'  => array('parentid' => $pid, 'status'=>0),
				'limit'           => array('persize'=>isset($topid) ? 1 : 3, 'offset'=>0),
				'orders'       => array('depth' => 'asc', 'created'=>'desc'),
		);
		$data = array();
		$fields = array('id', 'title', 'imagemark', 'content', 'created', 'clickcount');
		$data['articles'] = $this->news_model->get_appoint_values($fields, null, $condition);
		if(!$data['articles']){
			echo '';exit;
		}
		//p($data);exit;
		$this->load->view_part( $this->_site_path.'/news/ajax_channel_article', $data );
	}
	
	//获取分类信息
	private function _get_classify(&$data, $id){
		
		if(intval($id) <= 0){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$parentid = $this->news_sort_model->get_value_by_pk($id, 'parentid');
		if(!$parentid){
			header('location:'.base_url($this->_site_path.'/index/index'));
			exit;
		}
		$data['p_data'] = $this->news_sort_model->get_value_by_pk($parentid, 'sortname');
		$search = array(
				'attributes' => array( 'recycled' => 0, 'parentid' => $parentid),
				'orders'     => array('depth' => 'asc'),
		);
		//子类类名
		$data['newssort_data'] = $this->news_sort_model->get_values( 'id', 'sortname', null, $search );
	}
	
	//增加文章点击次数
	public function add_article_clicks($id){
		
		if(intval($id) <= 0){
			return false;
		}
		$this->_get_status($id);
		$clickcount = $this->news_model->get_value_by_pk($id, 'clickcount');
		if(!isset($clickcount)){
			return false;
		}
		$this->news_model->update_by_pk(array('clickcount'=>$clickcount+1), $id);
	}
	
	//检查该文章是否已审核
	private function _get_status($id){
		
		$status = $this->news_model->get_value_by_pk($id, 'status');
		if($status){
			header('location:'.base_url($this->_site_path.'/index/index'));exit;
		}
	}
	
}
