<?php
/**
 * news_type
 * @version 1.0
 * @package application
 * @subpackage application/controllers/news_type/
 */
class News_type extends MY_Controller
{
	public function __construct(){
		parent::__construct();
                $this->load->model('news_type_model');
	}
        

        public function index() {
		$search['attributes'] = $this->input->get();
		if(isset($search['attributes']['operation_time']) && !empty($search['attributes']['operation_time']))
		{
			$search['attributes']['operation_time_expertise']=$search['attributes']['operation_time'];
			unset($search['attributes']['operation_time']);
		}
                
                $attributes = array();
		$attributes = $this->input->get();
		                
		// 总数与分页
		$total = $this->news_type_model->total( $attributes );
		$data['total'] = $total;
		// 请使用config_item( 'per_page' )获取全局显示条数
		$per_page = config_item( 'per_page' );
		$this->load->library( 'pagination' );
		$pagination_config = array(
				'base_url'    => base_url( "sz_admin/news_type/index" ),
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
		$arr = $this->news_type_model->all( 0,0,$attributes );
                if(empty($attributes['type_name_like'])){
                 $data['news_type_data'] = $this->news_type_model->subTree($arr,$k='id',$pk='pid');
                }else{
                 $data['news_type_data'] = $arr;   
                }
		$this->load->view( 'sz_admin/news_type/index', $data );
	}
        
        /**
	 * view 显示详细页
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function view( $id ) {
		$data['news_type_data'] = $this->news_type_model->get_by_pk( $id );
                $data['type_name'] = $this->news_type_model->get_value_by_pk($data['news_type_data']['pid'],'type_name');
		$this->load->view( 'sz_admin/news_type/view', $data );
	}
        
        
        /**
	 * add 添加
	 * @author 咸洪伟
	 */
	public function add() {
		$data = array( );
                $options = $this->news_type_model->get_news_type_options();
                $data['options']=$options;
;		if ( $this->input->post( 'is_submit' )){
			try {
                            
				$news_type_data = $this->input->post();
                                $news_type_data['created'] = time();
                                $news_type_data['modified']= time();
				$data['news_type_data'] = $news_type_data;
				//设置验证规则
				$rule_config = array(				
					array('field'=> 'type_name' , 'label'=> '名称' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//插入
				$news_type_id = $this->news_type_model->insert( $news_type_data );
				init_messagebox( '添加成功', 'success', 1, base_url( 'sz_admin/news_type/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
                
		$this->load->view( 'sz_admin/news_type/form', $data );
	}
        
        
        /**
	 *   编辑 
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function edit($id)
	{
		$data = array( );
		$data['news_type_data']=$this->news_type_model->get_by_pk($id);
                $options = $this->news_type_model->get_news_type_options();
                $data['options']=$options;
		if ( $this->input->post( 'is_submit' )){
			try {
				$news_type_data = $this->input->post();
				$data['news_type_data'] = $news_type_data;
                                $news_type_data['modified']= time();
				//设置验证规则
				$rule_config = array(				
					array('field'=> 'type_name' , 'label'=> '名称' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//修改
				$this->news_type_model->update_by_pk( $news_type_data ,$id);
				init_messagebox( '修改成功', 'success', 1,base_url( 'sz_admin/news_type/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
                //p($data);
		$this->load->view( 'sz_admin/news_type/form', $data );
	}
        
        /*
         * 判断上级分类是否选择错误
         */
        public function check_pid() {
            $data = $this->input->get();
            $category = $this->news_type_model->all();
            $id=$data['id'];
            $arr=$this->news_type_model->subTree($category,$k='id',$pk='pid',$id,$lev=1);
            $ids[0]=$data['id'];
		foreach ($arr as $v) {
			array_push($ids,$v['id']);
		}
		if (in_array($data['pid'],$ids)) {
			return false;
		}else{
			echo 'ok';
		}
         
        }
}
