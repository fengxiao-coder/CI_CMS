<?php
/**
 * operations
 * @author 咸洪伟
 * @version 1.0
 * @package application
 * @subpackage application/controllers/operations/
 */
class Operations extends MY_Controller
{
        public $new_version = 1;
	public function __construct(){
		parent::__construct();

	}
	/**
	 * index 显示列表页
	 * @author 咸洪伟
	 */	
	public function index(){
		$attributes=$this->input->get();
                if(isset($attributes['operations_type_id']) && $attributes[1] == 1){
                    unset($attributes['operations_type_id']);
                    unset($attributes['operation_name']);
                }
		$search['attributes'] = $attributes;
                $data['search'] = $attributes;
		// 总数与分页
                $search['attributes']['new_version']=$this->new_version;
		$total = $this->operations_model->total(null,$search);
		$data['total'] = $total;
		// 请使用config_item( 'per_page' )获取全局显示条数
		$per_page = config_item( 'per_page' );
		$this->load->library('pagination');
		$pagination_config = array(
			'base_url' => base_url( 'sz_admin/operations/index' ),
			'total_rows' => $total,
			'per_page' => $per_page,
			'uri_segment' => 4,
		);
		$this->pagination->initialize( $pagination_config );
		$data['pagination'] = $this->pagination->create_links();

		$search['limit']=array('persize'=>$per_page,'offset'=>$this->pagination->get_cur_offset());
		$data['operations_data']=$this->operations_model->all($search);
                $this->load->model('operations_type_model');
                $data['type_name'] = $this->operations_type_model->get_appoint_values(array("type_id","type_name"));
		$this->load->view('sz_admin/operations/index',$data);
	}

	/**
	 * view 显示详细页
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function view($id)
	{
		$data['operations_data']=$this->operations_model->get_by_pk($id);
		$this->load->view('sz_admin/operations/view',$data);
	}

	/**
	 * add 添加 
	 * @author 咸洪伟
	 */
	public function add()
	{
		$data = array( );

		if ( $this->input->post( 'is_submit' ) && $this->form_validation->check_token() ){
			try {
				$operations_data = $this->input->post();
				$data['operations_data'] = $operations_data;
				//设置验证规则
				$rule_config = array(									
					array('field'=> 'operation_name' , 'label'=> '权限名称' , 'rules'=> 'required'),
					array('field'=> 'module' , 'label'=> '控制器' , 'rules'=> 'required'),
					array('field'=> 'action' , 'label'=> '动作' , 'rules'=> 'required'),
					array('field'=> 'operations_type_id' , 'label'=> '权限类别' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
                                $operations_data['new_version'] = $this->new_version;
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//插入
				$operations_id = $this->operations_model->insert( $operations_data );
				init_messagebox( '添加成功', 'success', 1, base_url( 'sz_admin/operations/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
		$this->load->view('sz_admin/operations/form', $data );
	}

	/**
	 * edit 编辑 
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function edit($id)
	{
		$data = array( );
		$data['operations_data']=$this->operations_model->get_by_pk($id);
		if ( $this->input->post( 'is_submit' ) && $this->form_validation->check_token() ){
			try {
				$operations_data = $this->input->post();
				$data['operations_data'] = $operations_data;
				//设置验证规则
				$rule_config = array(									
					array('field'=> 'operation_name' , 'label'=> '权限名称' , 'rules'=> 'required'),
					array('field'=> 'module' , 'label'=> '控制器' , 'rules'=> 'required'),
					array('field'=> 'action' , 'label'=> '动作' , 'rules'=> 'required'),
					array('field'=> 'operations_type_id' , 'label'=> '权限类别' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//修改
				$this->operations_model->update_by_pk( $operations_data ,$id);
				init_messagebox( '修改成功', 'success', 1, base_url( 'sz_admin/operations/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
		$this->load->view('sz_admin/operations/form', $data );
	}	

	/**
	 * delete 删除
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function delete( $id ) {
		$this->operations_model->delete_by_pk( $id );
		redirect( base_url( 'sz_admin/operations/index' ) );
	}

	/**
	 * delete_all 批量删除
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function delete_all() {
		$ids=$this->input->post('ids');
		foreach($ids as $id){
			$this->operations_model->delete_by_pk( $id );
		}
		redirect( base_url( 'sz_admin/operations/index' ) );
	}
        
  
}
