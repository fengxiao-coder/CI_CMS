<?php
header("content-type:text/html;charset=utf-8");

class User extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->_site_path = "sz_front";
    }

    //生成验证码
    public function verify() {
        $this->load->view($this->_site_path . "/user/verify");
    }

    public function check_un(){
    	$un = $_GET['un'];    	
    	if($this->user_model->get_by_attributes(array('user_name' => $un))){
    		echo "存在";
    	}else{
    		echo "pass";
    	}
    }
    
    public function check_pwd(){
    	$un = $_GET['un'];   
    	$pwd = md5($_GET['pwd']);   
    	
    	$info = $this->user_model->get_by_attributes(array('user_name' => $un));
//    	echo $pwd;
//    	echo $info['password'];
    	if($pwd ==$info['password'] ){
    		echo "正确";
    	}else{
    		echo "错误";
    	}
    }
    
    public function check_ue(){
    	$ue=$_GET['ue'];
    	if($this->user_model->get_by_attributes(array('email' => $ue))){
    		echo "存在";
    	}else{
    		echo "pass";
    	}
    }
    
	public function check_up(){
    	$up=$_GET['up'];
    	if($this->user_model->get_by_attributes(array('phone' => $up))){
    		echo "存在";
    	}else{
    		echo "pass";
    	}
    }
    
    public function check_captcha(){
    	$captcha = strtolower($_GET['captcha']);
        $code = strtolower($this->session->userdata('cs'));
    	if($captcha !=$code ){
    		echo "error";
    	}else{
    		echo "ok";
    	}
    }
    
   
    //显示注册页面
    public function register() {		
    	if ($this->session->userdata('userurl')==""){
    			$this->session->set_userdata('userurl', $_SERVER['HTTP_REFERER']);
    	}
    	//p($this->session->userdata('userurl'));
        $this->load->model("store_model");
        $data["info"] = $this->input->get();
      
        $data['store_name'] = $this->store_model->get_appoint_values(array('id', 'sName'));		
        $this->load->view($this->_site_path . "/user/register", $data);
    }

   
    public function do_register() {
        $data = $this->input->post();
	     $data['password'] = md5($data['password']);
	     $data['created'] = time();
	     //p($data);
	     $user_id= $this->user_model->insert($data);
	     $rs = $this->user_model->get_by_pk($user_id);
         $this->session->set_userdata('user_name', $rs["user_name"]);
         $this->session->set_userdata('userid', $user_id);
         if ($this->session->userdata('userurl')) {
            	//redirect($this->session->userdata('userurl'));
            	show_error($this->session->userdata('userurl'),500,'恭喜您，注册成功'); 
          } else {
              	//redirect('sz_front/index/index');
              	show_error(base_url()."sz_front/index/index",500,'恭喜您，注册成功'); 
          }  
		        
    }

    public function login() {
        //$this->session->set_userdata('userurl', $_SERVER['HTTP_REFERER']);
    	if ($this->session->userdata('userurl')==""){
    			$this->session->set_userdata('userurl', $_SERVER['HTTP_REFERER']);
    	}
//        p($this->session->userdata('userurl'));
//        p($this->session->userdata('username'));
//        p($this->session->userdata('password'));
        $data['username'] = $this->session->userdata('username');
        $data['password'] = $this->session->userdata('password');
        $this->load->view($this->_site_path . "/user/login", $data);
    }

    public function do_login() {

        $username = $this->input->post('username');
        $rs = $this->user_model->get_by_attributes(array('user_name' => $username));
        $this->session->set_userdata('user_name', $rs["user_name"]);
        $this->session->set_userdata('userid', $rs["user_id"]);
        //p($this->session->userdata('userurl'));
   		 if ($this->session->userdata('userurl')) {
              redirect($this->session->userdata('userurl'));
        } else {
              redirect('sz_front/index/index');
        }
    }

	public function userhome(){
		$this->is_login();
		$user_id = $this->session->userdata('userid');
		$this->load->view($this->_site_path."/user/userhome");
	}
	public function userInformation(){
		$this->load->model('store_model');
		
		$this->load->view($this->_site_path."/user/userInformation");
	}
	public function adduserinfo(){		
		$user_id = $this->session->userdata('userid');	
         $data = array();
         $data['user_name'] = $this->input->post('user_name',true);
		 $data['name'] = $this->input->post('name',true);
		 $data['email'] = $this->input->post('email',true);
		 $data['phone'] = $this->input->post('phone',true);    
		 //图片上传
         $filePath = './uploads/users/'; //上传路径
         $storName = 'avatar'; //图片存储的字段名
         $oriPath = $this->user_model->get_value_by_pk($user_id,"avatar"); //图片原来的路径 
	 	 if($_FILES["avatar"]["name"] and $oriPath){
	 			if(is_file($oriPath)){
	 				unlink($oriPath);
	 			}	 		 			
	 			$data['avatar'] =$this->user_model->check_img($filePath, $storName);         		
         }
         if(!$_FILES["avatar"]["name"] and $oriPath){
         		$data['avatar']=$oriPath;
         }
         if($_FILES["avatar"]["name"] and !$oriPath){
         		$data['avatar'] =$this->user_model->check_img($filePath, $storName);  
         }
         if(!$_FILES["avatar"]["name"] and !$oriPath){
         	?>
				<script type="text/javascript">
						alert("请上传头像");
						window.history.back(-1); 
				</script>
         	<?php 
         }else{ 
          if($this->user_model->update_by_pk($data,$user_id)){
          	//$this->session->set_userdata('user_name',$data['name']);
          	?>
				<script type="text/javascript">
						alert("信息修改成功");
						window.location = "userhome"; 						
				</script>
         	<?php 
          }  }  
	}
	public function password(){
		$user_id = $this->session->userdata('userid');
		$this->load->view($this->_site_path."/user/password");
	}
	public function changepwd(){
		$user_id = $this->session->userdata('userid');
		$data=$this->input->post();
		$oldpwd = $this->user_model->get_value_by_pk($user_id,'password');	
		if($oldpwd==md5($data['oldpwd'])){
		     //原始密码输入正确
		     	if($this->user_model->update_by_pk(array( "password" => md5($data['password']) ),$user_id)){
		     		?>
					<script type="text/javascript">
						alert("密码修改成功");
						window.location = "userhome";
					</script>
					<?php 
		     	}
		     	//redirect('sz_front/user/userhome'."/".$id);			   
		}else{
			?>
				<script type="text/javascript">
					alert("原始密码输入不正确");
					window.history.back(-1); 
				</script>
			<?php 
		}
	}
	//收货地址页面
	public function address(){
		$this->load->model('user_address_model');
		$this->load->model('user_province_model');
		$this->load->model('user_city_model');
		$this->load->model('user_area_model');
		$user_id = $this->session->userdata('userid');
			$sql = "select * from user_address where user_id={$user_id}";
			$result = mysql_query($sql);		
			while($row =  mysql_fetch_assoc($result)){
				$rows[]=$row;
				$data['rows']=$rows;				
		}	
		$this->load->view($this->_site_path."/user/address",$data);
	}
	//新建收货地址
	public function add_address(){
		$this->load->model('user_province_model');
		$user_id = $this->session->userdata('userid');
		$pro_arr = $this->user_province_model->all();
		$data['pro_arr'] = $pro_arr;
		$this->load->view($this->_site_path."/user/add_address",$data);
	}
	public function logout(){
//		$this->session->unset_userdata('user_name');
//		$this->session->unset_userdata('user_id');
//		$this->session->unset_userdata('userurl');
		$this->session->sess_destroy();
		redirect('sz_front/index/index');	
	}
	//根据省份id得到城市
	public function getcity(){
		$id=$_GET['oneid'];
		$sql = "select * from user_city where pid={$id}";
		$result = mysql_query($sql);
		?>
		$one="<option value='-1'>请选择</option>";
		<?php
		while($rs =  mysql_fetch_assoc($result)){
		?>
		$one.="<option value='<?php echo $rs["id"]?>'><?php echo $rs["city_name"]?></option>";
		<?php
		}
		$data['one']=$one;
		$this->load->view($this->_site_path."/user/getcity",$data);
	}
	//根据城市id得到区县
	public function getarea(){
		$id=$_GET['cityid'];
		$sql = "select * from user_area where pid={$id}";
		$result = mysql_query($sql);
		?>
		$two="<option value='-1'>请选择</option>";
		<?php
		while($rs =  mysql_fetch_assoc($result)){
		?>
		$two.="<option value='<?php echo $rs["id"]?>'><?php echo $rs["area_name"]?></option>";
		<?php
		}
		$this->load->view($this->_site_path."/user/getarea");
	}
	//添加地址
	public function do_addr(){
		$this->load->model('user_address_model');
		$user_address_data=$this->input->post();
		$user_id = $this->session->userdata('userid');
		$info = $this->user_address_model->get_by_attributes(array("user_id" => $user_id));
		if (count($info)>0){
			$user_address_data["mark"]=0;
		}else{
			$user_address_data["mark"]=1;
		}
		$user_address_data['user_id'] = $user_id;
		$address_id = $this->user_address_model->insert($user_address_data);
		redirect('sz_front/user/address/');
	}
	public function defautaddr(){
		$this->load->model('user_address_model');
		$id=$_GET['id'];
		$user_id=$this->user_address_model->get_value_by_pk($id,'user_id');
		$sql="select user_id from user_address where user_id={$user_id}";		
		$sql_1="update user_address set mark=0 where user_id={$user_id}";
		$result = mysql_query($sql_1);
		$sql_2="update user_address set mark=1 where address_id={$id}";	
		$result = mysql_query($sql_2);
                return;
	}
	//修改地址页面
	public function edit_address($id){
		$this->load->model('user_address_model');
		$this->load->model('user_province_model');
		$addr_info = $this->user_address_model->get_by_attributes(array("address_id"=>$id));
		$data['addr_info']=$addr_info;
		$pro_arr = $this->user_province_model->all();
		$data['pro_arr'] = $pro_arr;

		$this->load->view($this->_site_path."/user/edit_address",$data);
	}
	//删除地址
	public function delete_address($id){
		$user_id = $this->session->userdata('userid');
		$sql="delete from user_address where address_id={$id}";
		//echo $sql;
		mysql_query($sql);
		redirect('sz_front/user/address/'.$user_id);
	}
	//修改地址操作
	public function do_edit_addr($id,$user_id){
		$this->load->model('user_address_model');
		$user_address_data=$this->input->post();
		$this->user_address_model->update_by_pk($user_address_data,$id);
		redirect('sz_front/user/address/'.$user_id);
	}
	
	//忘记密码
	public function forget(){		
		$data['email'] = $this->session->userdata('email');
		$this->load->view($this->_site_path."/user/forgotpwd",$data);
	}	
	//验证邮箱	
	public function checkemail(){
		$this->session->set_userdata('email',$this->input->post("email"));
		$code = strtolower($this->session->userdata('cs'));
		if($code==$this->input->post("verify")){
			//验证码正确 验证邮件是否注册过
			$data= $this->user_model->get_by_attributes(array( 'email'=>$this->input->post("email")));	
			if($data){
				$this->load->view($this->_site_path."/user/forgotpwd2",$data);							
			}else{
				?>
				<script type="text/javascript">
					alert("该邮箱未注册过");
					window.location = "forget";
				</script>
				<?php 
			}
		}else{
			?>
				<script type="text/javascript">
					alert("验证码不正确");
					window.location = "forget";
				</script>
			<?php 
		}
	}
	
	public function sendemail(){
		//发送成功返回ture 失败返回false	
		$data = $this->input->post();
		p($data['user_name']);
		$addressee =$data['email'];
		$subject ="电商测试邮件";
		$message = "<a href='http://www.baidu.com'>你好！点我找回密码</a>";
		if($status = $this->send_email( $addressee, $subject, $message)){
			$this->load->view($this->_site_path."/user/forgotpwd3");		
		}
	}
	
	//发送邮件
	public function send_email( $addressee, $subject, $message ) {
		try {
			$this->load->library( 'email' );
			$this->config->load( 'email' );
			//读取配置项 发件人地址
			$smtp_user = config_item( 'smtp_user' );
			//读取配置项 发件人称呼
			$smtp_name = config_item( 'smtp_name' );

			$this->email->from( $smtp_user, $smtp_name );
			//收件人地址
			$this->email->cc( $addressee );
			//发送主题
			$this->email->subject( $subject );
			//发送内容
			$this->email->message( $message );

			if ( $this->email->send() ) {
				return true;
			}
		} catch ( Exception $e ) {
			echo $e->getMessage();
			return false;
		}
	}

  	public function is_login() {
        $user_id = $this->session->userdata('userid');
        if (empty($user_id)) {
            redirect(base_url('sz_front/user/login'));
        }
    }
    
}