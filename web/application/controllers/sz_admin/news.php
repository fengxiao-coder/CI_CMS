<?php
/**
 * news
 * @version 1.0
 * @package application
 * @subpackage application/controllers/news/
 */
class News extends MY_Controller
{
	public function __construct(){
		parent::__construct();
                $this->load->model("news_type_model");
                $this->load->model("admin_model");
	}
        
        public function index() {
		$search['attributes'] = $this->input->get();
		if(isset($search['attributes']['operation_time']) && !empty($search['attributes']['operation_time']))
		{
			$search['attributes']['operation_time_expertise']=$search['attributes']['operation_time'];
			unset($search['attributes']['operation_time']);
		}
		// 总数与分页
		$total = $this->news_model->total( null,$search );
		$data['total'] = $total;
		// 请使用config_item( 'per_page' )获取全局显示条数
		$per_page = config_item( 'per_page' );
		$this->load->library( 'pagination' );
		$pagination_config = array(
				'base_url'    => base_url( "sz_admin/news/index" ),
				'total_rows'  => $total,
				'per_page'    => $per_page,
				'uri_segment' => 4,
		);
		$this->pagination->initialize( $pagination_config );
		$data['pagination'] = $this->pagination->create_links( );
		$search['limit'] = array(
				'persize' => $per_page,
				'offset'  => $this->pagination->get_cur_offset( )
		);
		$data['news_data'] = $this->news_model->all( $search );

		$this->load->view( 'sz_admin/news/index', $data );
	}
        
        /**
	 * view 显示详细页
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function view( $id ) {
		$data['news_data'] = $this->news_model->get_by_pk( $id );             
		$this->load->view( 'sz_admin/news/view', $data );
	}
        
        /**
	 * add 添加
	 * @author 咸洪伟
	 */
	public function add() {
		$data = array( );               
                $options = $this->news_type_model->get_news_type_options();
                $data['options']=$options;
		if ( $this->input->post( 'is_submit' )){
			try {
                            
				$news_data = $this->input->post();
                                $news_data['created'] = time();
                                $news_data['modified'] = time();
				$data['news_data'] = $news_data;
				//设置验证规则
				$rule_config = array(				
			            array('field'=> 'title' , 'label'=> '标题' , 'rules'=> 'required'),
                                    array('field'=> 'pid' , 'label'=> '分类' , 'rules'=> 'required'),
                                    array('field'=> 'author' , 'label'=> '作者' , 'rules'=> 'required'),
                                    array('field'=> 'content' , 'label'=> '内容' , 'rules'=> 'required'),
                                    array('field'=> 'keywords' , 'label'=> '关键字' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//插入
				$news_type_id = $this->news_model->insert( $news_data );
				init_messagebox( '添加成功', 'success', 1, base_url( 'sz_admin/news/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
                
		$this->load->view( 'sz_admin/news/form', $data );
	}
        
        	/**
	 *   编辑 
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function edit($id)
	{
		$data = array( );
                $data['news_data']=$this->news_model->get_by_pk((int)$id);
		$options = $this->news_type_model->get_news_type_options();
                $data['options']=$options;
		if ( $this->input->post( 'is_submit' )){
			try {
				$news_data = $this->input->post();
                                $news_data['modified'] = time();
				
				//设置验证规则
				$rule_config = array(				
				    array('field'=> 'title' , 'label'=> '标题' , 'rules'=> 'required'),
                                    array('field'=> 'pid' , 'label'=> '分类' , 'rules'=> 'required'),
                                    array('field'=> 'author' , 'label'=> '作者' , 'rules'=> 'required'),
                                    array('field'=> 'content' , 'label'=> '内容' , 'rules'=> 'required'),
                                    array('field'=> 'keywords' , 'label'=> '关键字' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//修改
				$this->news_model->update_by_pk( $news_data ,$id);
				init_messagebox( '修改成功', 'success', 1,base_url( 'sz_admin/news/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
                
		$this->load->view( 'sz_admin/news/form', $data );
	}
}
