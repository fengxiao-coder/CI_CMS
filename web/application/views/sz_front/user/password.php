<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name')
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
</script>

<script type="text/javascript">

function checkInfo(){
	//原始密码不能为空
	var old = document.getElementById("old").value;
	if(old==""){
		document.getElementById("div1").style.display="block";
		document.getElementById("div1").innerHTML = "请输入原始密码";
		return false;
	}else{
		document.getElementById("div1").style.display="none"; 
	}
	//验证两次密码是否一致
	var userRepwd = document.getElementById("rpwd").value;
	var userPwd = document.getElementById("pwd").value;
	if(userPwd!=userRepwd){
		document.getElementById("div").style.display="block"; 
		document.getElementById("div").innerHTML = "两次密码不一致";
		return false;
	}else{
		document.getElementById("div").style.display="none"; 
	}
	
}
</script>
</head>
<body>
<!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>基本信息修改</h2>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
    </div>
    <div class="header-main">
         <div class="top-nav">
            <ul class="nav nav-pills nav-justified res">
		       	<li><a class="active no-bar" href="<?php echo base_url($this->_site_path . '/index/index');?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
				<li><a href="<?php echo base_url("sz_front/search/index"); ?>"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
				<li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
				<li><a href="<?php echo base_url($this->_site_path . '/user/userhome');?>"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
		   </ul>
		<!-- script-for-menu -->
		 <script>
			 $( "div.header_icon" ).click(function() {
			 $( "ul.res" ).slideToggle( 300, function() {
			// Animation complete.
			 });
			 });
		</script>
			<!-- /script-for-menu -->
		 </div>
     <div class="clearfix"> </div>
   </div>	
<form method="post" action="<?php echo base_url($this->_site_path . '/user/changepwd');?>" onsubmit="return checkInfo();">
   <div class="user main">
   	 <ul>
     	<li><span>昵称</span><label><?php echo $user;?></label></li> 
     	<li>
     	<span>原始密码</span>
     	<input id="old"class="txt_input" name="oldpwd" type="password">     	
     	<div id="div1" style="color:#ff0000; font-size:12px"></div>
     	</li>
     	
     	<li>
     	<span>新密码</span>
     	<input id="pwd" class="txt_input" name="password" type="password">
     	</li>
     	
     	<li>
     	<span>确认密码</span>
     	<input id="rpwd" class="txt_input" name="repwd" type="password">
     	<div id="div" style="color:#ff0000; font-size:12px"></div>
     	</li>  
     </ul>
    <div class="item item_btns">
         <!--如果有文本框中全部输入信息 则在a标签class中去掉btn_disabled ，否则加上btn_disabled 
         <a class="btn_login" href="javascript:;">确定</a>-->
          <button type="submit" class="btn_login">提交</button>
      </div>
   </div>
</form>
  
    
   <?php $this->load->view_part("sz_front/common/footer")?>