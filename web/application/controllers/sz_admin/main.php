<?php 
class Main extends MY_Controller {
	const TIMEOUT = 4;
	public $layout="layouts/main_base";

	public function __construct(){
		parent::__construct();
		$this->_site_path=config_item('site_path');
	}

	public function index()
	{
		$this->load->view_part($this->_site_path.'/main/index');
	}
        
	public function top(){
		$this->load->view($this->_site_path.'/main/top');
                                pe($this->operations_type_model);
	}

	public function left($top=42){
		$ac = $this->input->get('ac');
		if(!$ac){
			$ac = $top;
		}
        $data['top']=  $top;
        $dt = $this->operations_type_model->get_by_pk($ac);
        $data['checked_url'] = $dt['url'];
		$this->load->view($this->_site_path.'/main/left',$data);
	}

	public function right(){
		$this->load->view($this->_site_path.'/main/main');
	}
	
	public function middle(){
		$this->load->view($this->_site_path.'/main/middle');
	}

	public function foot(){
		$this->load->view($this->_site_path.'/main/foot');
	}

	/**
	 * 初始化消息框
	 * @param array $content 配置数据
	 */
	public function message_box( $config ) {
		if ( $config['redirect_url'] ) $config['content'] .= ' <strong>' . self::TIMEOUT . '</strong>秒后将自动跳转';
		if ( substr( $config['content'], 0, 3 ) !== '<p>' ) $config['content'] = '<p>' . $config['content'] . '</p>';
		$this->load->view_part( $this->_site_path.'/main/messagebox', $config );
	}

	/**
	 * 错误页面
	 */
	public function error(){
		echo "您好，您无此操作权限。<br/>请联系管理员！！！";
	}
        
        public function main_user_info(){
            $data = array( );   
            $use_data = $this->input->post();
            $attributes['user_name']=$this->auth->get_user('user_name');
            $data['user_data'] = $this->admin_model->get_by_attributes( $attributes );//p($data);
            $this->load->view($this->_site_path.'/main/ajax_update_user_info',$data);
        }
        
        public function ajax_update_user_info(){
            $data = array();
            $data = $this->input->post();         
            $password = $this->admin_model->get_value_by_pk($data['admin_id'],'password');
            if(!$data['prepass']) {
                echo json_encode( array( 'field'=>'prepass', 'msg'=>'当前密码不能为空' ) );exit;
            }    
            if(md5($data['prepass']) != $password){
                echo json_encode( array( 'field'=>'prepass', 'msg'=>'当前密码不正确' ) );exit;            
            }
            if($data['password']!=''){
                if(!$data['password2']) {
                    echo json_encode( array( 'field'=>'password2', 'msg'=>'确认密码不能为空' ) );exit;
                }
                if($data['password'] != $data['password2']){
                    echo json_encode( array( 'field'=>'password2', 'msg'=>'确认密码和新密码不相同' ) );exit;            
                }
            }
            $data['password'] = md5($data['password']);
            if($this->admin_model->update_by_pk($data,$data['admin_id'])){
                $result['msg'] = '修改成功';
            }else{
                $result['msg'] = '修改失败'; 
            }
            header("Content-type:application/json:charset=utf-8");
            die(json_encode($result));
        }
}