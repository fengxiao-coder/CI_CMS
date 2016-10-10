<?php
/**
 * operations_type
 * @version 1.0
 * @package application
 * @subpackage application/controllers/operations_type/
 */
class Operations_type extends MY_Controller
{
	public function __construct(){
		parent::__construct();
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
                            
				$operations_type_data = $this->input->post();
				$data['operations_type_data'] = $operations_type_data;
				//设置验证规则
				$rule_config = array(				
					array('field'=> 'type_name' , 'label'=> '权限类别名称' , 'rules'=> 'required'),
                    array('field'=> 'pid' , 'label'=> '权限类父级别名称' , 'rules'=> 'required'),
             		array('field'=> 'url' , 'label'=> 'url地址' , 'rules'=> 'required'),
                                    
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//插入
                                if(isset($operations_type_data['pid_second'])&&$operations_type_data['pid_second']){
                                    $operations_type_data['pid'] = $operations_type_data['pid_second'];
                                }
				$operations_type_id = $this->operations_type_model->insert( $operations_type_data );
				init_messagebox( '添加成功', 'success', 1, base_url( 'sz_admin/operations_type/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
		$this->load->view( 'sz_admin/operations_type/form', $data );
	}
        
             /*
         * ajax 获取子级 数据
         */
       /*
         * ajax 获取子级 数据
         */
        public function ajax_get_operations_type(){
            $pid = $this->input->get("pid");
            $checked = $this->input->get("checked");
            if(!$pid){exit("0");}
            $op_list = $this->operations_type_model->get_values("type_id","type_name",array(),array("in"=>array("pid"=>$pid)));
            $str ="";
            foreach ($op_list as $type_id => $value) {
                $ck = ($type_id== $checked)?"selected=selected":"";
                $str .="<option value='{$type_id}'   $ck  >$value</option>";
            }
            echo $str;exit;
        }
        
        
        
        	/**
	 *   编辑 
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function edit($id)
	{
		$data = array( );
		$data['operations_type_data']=$this->operations_type_model->get_by_pk($id);
		if ( $this->input->post( 'is_submit' ) && $this->form_validation->check_token() ){
			try {
				$operations_type_data = $this->input->post();
				$data['operations_type_data'] = $operations_type_data;
				//设置验证规则
				$rule_config = array(				
					array('field'=> 'type_name' , 'label'=> '权限类别名称' , 'rules'=> 'required'),
                    array('field'=> 'url' , 'label'=> 'url地址' , 'rules'=> 'required'),
                    array('field'=> 'pid' , 'label'=> '权限类父级别名称' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//修改
                                if(isset($operations_type_data['pid_second'])&&$operations_type_data['pid_second']){
                                    $operations_type_data['pid'] = $operations_type_data['pid_second'];
                                }
                                unset( $operations_type_data['pid_second']);
                                
				$this->operations_type_model->update_by_pk( $operations_type_data ,$id);
				init_messagebox( '修改成功', 'success', 1,base_url( 'sz_admin/operations_type/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}

		$this->load->view( 'sz_admin/operations_type/form', $data );
	}
}
