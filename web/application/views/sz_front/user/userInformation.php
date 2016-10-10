<?php
//$user = $this->session->userdata('user_name');
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name');
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
	//验证用户名必须填写  
	var userName = document.getElementById("un").value;
	if(userName==""){
		document.getElementById("div").style.display="block";
		document.getElementById("div").innerHTML = "请填写真实姓名";
		return false;
	}else{
		document.getElementById("div").style.display="none"; 
	}
	//验证昵称必须填写
	var uname = document.getElementById("uname").value;
	if(uname==""){
		document.getElementById("div1").style.display="block";
		document.getElementById("div1").innerHTML = "请填写昵称";
		return false;
	}else{
		document.getElementById("div1").style.display="none"; 
	}
	//验证手机格式
	var userTel = document.getElementById("up").value;
	var regUt = new RegExp("^[0-9]{11}$");  
	if(regUt.test(userTel)==false){
		document.getElementById("div2").style.display="block";
		document.getElementById("div2").innerHTML = "请输入正确格式的手机号码";
		return false;
	}else{
		document.getElementById("div2").style.display="none"; 
	}
	//验证邮箱
	var userEmail = document.getElementById("ue").value;
	var regUe = new RegExp("^[0-9a-zA-Z_]{1,}@[0-9a-zA-Z_]{1,}\.(com|cn|org)$");  // aa@aa.com
	if(regUe.test(userEmail)==false){
		document.getElementById("div3").style.display="block";
		document.getElementById("div3").innerHTML = "请输入正确的邮箱格式";
		return false;
	}else{
		document.getElementById("div3").style.display="none"; 
	}
	
	return true;
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
<?php 
//$avatar = $this->user_model->get_value_by_pk($user_id,'avatar');
$info = $this->user_model->get_by_pk($user_id);
$store_name = $this->store_model->all();
//p($store_name);
//p($info);
?>
<form method="post" action="<?php echo base_url($this->_site_path . '/user/adduserinfo');?>" enctype="multipart/form-data" onsubmit="return checkInfo();">
   <div class="user main">
   	 <ul>
     	<li>
     	<span>真实姓名</span>
     	<input id="un" type="text" class="txt_input"  name="name" value="<?php echo $info["name"];?>">
     	<div id="div" style="color:#ff0000; font-size:12px"></div>
     	</li>     	
     	<li><span>头像</span> <div class="imges"><img src="<?php echo site_url(isset($info['avatar'] ) ? $info['avatar'] : ''); ?>" /></div><input class="upload" type="file" name="avatar"></li> 
     	<li>
     	<span>昵称</span>
     	<input id="uname" type="text" class="txt_input"  name="user_name" value="<?php echo $user;?>">
     	<div id="div1" style="color:#ff0000; font-size:12px"></div>
     	</li> 
    	
     	<li>
     	<span>联系电话</span>
     	<input id="up" type="text" class="txt_input" name="phone" value="<?php echo $info["phone"];?>">
     	<div id="div2" style="color:#ff0000; font-size:12px"></div>
     	</li>
     	
     	<li>
     	<span>E-mail</span>
     	<input id="ue" type="text" class="txt_input" name="email" value="<?php echo $info["email"];?>">
     	<div id="div3" style="color:#ff0000; font-size:12px"></div>
     	</li> 
     	
     	<li>
     	<span>店铺</span>
	     	<select class="txt_input"  name="store_id" id="sid" disabled="disabled">
	                        <option value="">--请选择店铺--</option>
	                        <?php foreach ($store_name as $k=>$v) {?>
	                        <option value="<?php echo $v['id'];?>" <?php echo $info["store_id"] == $v['id']?"selected='selected'":"";?>><?php echo $v['sName'];?></option>
	                        <?php } ?>
	        </select>
     	<div id="div3" style="color:#ff0000; font-size:12px"></div>
     	</li> 
     	
     </ul>
    <div class="item item_btns">
         <!--如果有文本框中全部输入信息 则在a标签class中去掉btn_disabled ，否则加上btn_disabled
         <a class="btn_login" href="javascript:;">确定</a> -->
         <input type="submit" value="确定" class="btn_login" />
      </div>
  </div>
</form>
  
<?php $this->load->view_part("sz_front/common/footer")?>
