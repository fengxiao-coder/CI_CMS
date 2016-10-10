<?php
/**
 * admin_group
 * @version 1.0
 * @package application
 * @subpackage application/controllers/admin_group/
 */
class Admin_group extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_group_model');
        $this->load->model('config_model');
		$this->load->model('admin_group_operations_model');
		$this->load->model('operations_model');
		$this->load->model('operations_type_model');
	}
	/**
	 * index 显示列表页
	 * @author 咸洪伟
	 */	
	public function index(){
		$attributes=$this->input->get();
		$this->load->model('config_model');
		$search['attributes']=$attributes;
                $this->load->model("config_model");
                $admin_id =  $this->auth->get_user('admin_id');
    
                $guan_admin_id = $this->config_model->get_value_by_key("admin_id");
                if($admin_id !=$guan_admin_id){
                    $guan_admin_group_id =  $this->config_model->get_value_by_key("admin_group_id");
                    $search['attributes']['group_id_notequal']=$guan_admin_group_id;
                }
		// 总数与分页
		$total = $this->admin_group_model->total(null,$search);
		$data['total'] = $total;
		// 请使用config_item( 'per_page' )获取全局显示条数
		$per_page = config_item( 'per_page' );
		$this->load->library('pagination');
		$pagination_config = array(
			'base_url' => base_url( 'sz_admin/admin_group/index' ),
			'total_rows' => $total,
			'per_page' => $per_page,
			'uri_segment' => 5,
		);
		$this->pagination->initialize( $pagination_config );
		$data['pagination'] = $this->pagination->create_links();
		$search['limit']=array('persize'=>$per_page,'offset'=>$this->pagination->get_cur_offset());

		$data['admin_group_data']=$this->admin_group_model->all($search);
		$this->load->view('sz_admin/admin_group/index',$data);
	}

	/**
	 * view 显示详细页
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function view($id)
	{
		$data['admin_group_data']=$this->admin_group_model->get_by_pk($id);
		$search['attributes']=array('group_id'=>$id);
        $old_operations=$this->admin_group_operations_model->get_values('operations_id','operations_id','',$search);
		if(!$old_operations){
			$old_operations=array();
		}
		$data['old_operations']=$old_operations;
		
		$show_menu_office = $show_c_op = array();
        foreach($old_operations as $v){
               $dt = $this->operations_model->get_by_pk($v);
               $dt_type = $this->operations_type_model->get_by_pk($dt['operations_type_id']);
               if(!empty($dt_type)){
                   $p_dt_type = $this->operations_type_model->get_by_pk($dt_type['pid']);
                   $show_c_op[$p_dt_type['type_name']][]= $dt['operation_name'];
               }
        }          
        $data['show_c_op'] = $show_c_op;
        //p($show_c_op);
		$this->load->view('sz_admin/admin_group/view',$data);
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
                           //     $this->load->model("menu_offen_model");
				$admin_group_data = $this->input->post();
				$data['admin_group_data'] = $admin_group_data;
				//设置验证规则
				$rule_config = array(				
					array('field'=> 'group_name' , 'label'=> '名称' , 'rules'=> 'required'),
					array('field'=> 'group_description' , 'label'=> '备注' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//插入
				$admin_group_id = $this->admin_group_model->insert( $admin_group_data );
				
				if($this->input->post('operations')){
					$this->admin_group_operations_model->add_rel($admin_group_id,$this->input->post('operations'));
				}
                          /*     if($this->input->post('offtens')){
                                     foreach($this->input->post('offtens') as $offtens_id){
                                         $this->menu_offen_model->insert(array("menu_office"=>$offtens_id,'group_id'=>$admin_group_id));
                                     }
                                     
                                 }*/
				init_messagebox( '添加成功', 'success', 1, base_url( 'sz_admin/admin_group/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
		$this->load->view( 'sz_admin/admin_group/form', $data );
	}

	/**
	 * edit 编辑 
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function edit($id)
	{
		$data = array( );
		$data['admin_group_data']=$this->admin_group_model->get_by_pk($id);

		$search['attributes']=array('group_id'=>$id);
		$old_operations=$this->admin_group_operations_model->get_values('operations_id','operations_id','',$search);
		if(!$old_operations){
			$old_operations=array();   
		}
		$data['old_operations']=$old_operations;
                $show_menu_office = $show_c_op = array();
                foreach($old_operations as $v){
                    $dt = $this->operations_model->get_by_pk($v);
                    $dt_type = $this->operations_type_model->get_by_pk($dt['operations_type_id']);
                    if(!empty($dt_type)){
                    $p_dt_type = $this->operations_type_model->get_by_pk($dt_type['pid']);
                    $show_c_op[$p_dt_type['type_name']][]= $dt['operation_name'];
                    }
                }
             /*   $this->load->model('menu_offen_model');
                $old_menu_office=$this->menu_offen_model->get_values('menu_office','menu_office','',$search);
                if(!empty($old_menu_office)){
                    foreach($this->office_left->power as $k_name=> $value){
                        foreach($value as $k=>$v){
                            if(in_array($v['office_id'], $old_menu_office)){
                                $show_menu_office[$k_name][]=$k;
                            }
                        }
                     }
                }*/
                $data['old_operations']=$old_operations;
                //$data['show_menu_office']=$show_menu_office;
                $data['show_c_op'] = $show_c_op;
		if ( $this->input->post( 'is_submit' ) && $this->form_validation->check_token() ){
			try {
				$admin_group_data = $this->input->post();
				$data['admin_group_data'] = $admin_group_data;
				//设置验证规则
				$rule_config = array(				
					array('field'=> 'group_name' , 'label'=> '名称' , 'rules'=> 'required'),
					array('field'=> 'group_description' , 'label'=> '备注' , 'rules'=> 'required'),
				);
				$this->form_validation->set_rules($rule_config);
				if ( !$this->form_validation->run() ) throw new Exception( validation_errors(), 0 );
				//修改
				$this->admin_group_model->update_by_pk( $admin_group_data ,$id);

				if($this->input->post('operations')){
					$this->admin_group_operations_model->change_rel($id,$this->input->post('operations'),$old_operations);
					$data['old_operations']=$this->input->post('operations');
				}	
                                if($this->input->post('offtens')){
                                      $upt_menu_office = $this->input->post('offtens');
                                      $search['attributes']=array('group_id'=>$id);
                                      $this->load->model('menu_offen_model');
                                      $old_menu_office=$this->menu_offen_model->get_values('menu_office','menu_office','',$search);
                                      $new_menu_office = array_diff($upt_menu_office,$old_menu_office);
                                      foreach($new_menu_office as $offtens_id){
                                          $this->menu_offen_model->insert(array("menu_office"=>$offtens_id,'group_id'=>$id));
                                      }
                                      $del_menu_office = array_diff($old_menu_office,$upt_menu_office);
                                      foreach($del_menu_office as $offtens){
                                          $this->menu_offen_model->delete_by_attributes(array("menu_office"=>$offtens,'group_id'=>$id));
                                      }
                                      
                                 }

				init_messagebox( '修改成功', 'success', 1, base_url( 'sz_admin/admin_group/index' ) );
			} catch ( Exception $e ) {
				init_messagebox( $e->getMessage(), 'error', $e->getCode() );
			}
		}
		$this->load->view( 'sz_admin/admin_group/form', $data );
	}	

	/**
	 * delete 删除
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function delete( $id ) {
		if('1'===$id){
			alert("超级角色信息不可以删除",  base_url( 'sz_admin/admin_group/index' ));
		}
		$this->admin_group_model->delete_by_pk( $id );
		redirect( base_url( 'sz_admin/admin_group/index' ) );
	}

	/**
	 * delete_all 批量删除
	 * @param $id 主键值
	 * @author 咸洪伟
	 */
	public function delete_all() {
		$ids=$this->input->post('ids');
		foreach($ids as $id){
                        if($id == (int)$id){
                            $this->admin_group_model->delete_by_pk( $id );
                        }
		}
		redirect(base_url( 'sz_admin/admin_group/index' ));
	}
        
        
        /*
         * 显示用户角色
         */
        public function admin_group_form(){
            $this->load->model("admin_group_model");
            $data['admin_group'] = $this->admin_group_model->get_values('group_id','group_name');
            $check_group_id=$this->input->get('group_id');
            $data['check_group_id'] = $check_group_id;
            $this->load->view_part("sz_admin/admin_group/admin_group_form",$data);
        }
        /*
         * 选择用户权限
         */
        public function select_group_box(){
		$ids=$this->input->post('group_id');
		$search['in']=array('group_id'=>$ids);
		$deal_users=$this->admin_group_model->get_values('group_id','group_name','',$search);
		echo form_checkbox_list('group_id',$deal_users,$ids);
        }
        /*
         * 显示权限
         */
        public function show_admin_group($id=0){
            $data=array();
            $this->load->model("config_model");
            $this->load->model("admin_group_model");
            $user_id =  $this->auth->get_user('userid');
            $guan_admin_id = $this->config_model->get_value_by_key("admin_id");
            if($user_id ==$guan_admin_id ){
                $data['is_guan'] = 1;
            }else{
                $data['is_guan'] = 0;
            }
            if($id !=0){
            $search['attributes']=array('group_id'=>$id);
           
		$old_operations=$this->admin_group_operations_model->get_values('operations_id','operations_id','',$search);
		if(!$old_operations){
			$old_operations=array();
		}   
            $data['old_operations']=$old_operations;
            }
 //print_r($old_operations);
			$data['g_id'] = $id;
            $this->load->view_part("sz_admin/admin_group/admin_check_form",$data);
        }
        
         /*
         * 选择用户权限
         */
        public function select_use_group_box(){
		$ids=$this->input->post('operations');
                $str = "";
                if(!empty($ids)){
                    foreach($ids as $val){
                        $str .='<input type="checkbox" name="operations[]" value="'.$val.'" checked>  '.$val;
                    }
                }
                echo $str;exit;
        }
        
       /*
        * 显示常用菜单栏
        */
        public function show_menu_offten($id=0){
            $data = array();
            if($id !=0){
                
                $search['attributes']=array('group_id'=>$id);
                $this->load->model('menu_offen_model');
                $old_menu_office=$this->menu_offen_model->get_values('menu_office','menu_office','',$search);
		if(!$old_menu_office ){
			$old_menu_office =array();
		}   
               
            $data['old_menu_office']=$old_menu_office;
            }
           $this->load->view_part("sz_admin/admin_group/show_menu_offten",$data);  
        }
       /*
         * 选择常用菜单栏
         */
        public function select_menu_offtens_box(){
		$ids=$this->input->post('offtens');
                $str = "";
                if(!empty($ids)){
                    foreach($ids as $val){
                        $str .='<input type="checkbox" name="offtens[]" value="'.$val.'" checked>  '.$val;
                    }
                }
                echo $str;exit;
        }
}
