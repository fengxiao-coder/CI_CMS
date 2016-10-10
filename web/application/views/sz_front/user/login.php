<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="跨境手机平台,手机购物,二维码购物">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Cache-Control" content="no-transform">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="layoutmode" content="standard">
<meta name="renderer" content="webkit">
<!--uc浏览器判断到页面上文字居多时，会自动放大字体优化移动用户体验。添加以下头部可以禁用掉该优化-->
<meta name="wap-font-scale" content="no">
<meta content="telephone=no" name="format-detection">
<meta http-equiv="Pragma" content="no-cache">
<title>跨境手机平台</title>
<link href="<?php echo base_url('theme/front/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="<?php echo base_url('theme/front/js/jquery-1.11.0.min.js') ?>"></script>
</head>
<script type="text/javascript">
$(function(){
	$("#showpwd").click(function(){
		
		$("#showpwd").toggleClass("tp_btn btn_off tp_btn btn_off btn_on");		
		if($(this).attr('class')=="tp_btn btn_off btn_on"){
			//$("#pwd").html('<input class="txt_input txt_password" type="text" autocomplete="off" placeholder="请输入密码" name="password">');   
			$("#pwd").attr('type','text');
		}else{
			$("#pwd").attr('type','password');
		}
				
	})	
})

function checkname(){	
		var rel;
		var name = $("#userName").val();
		$.ajax({
		     url:"<?php echo base_url($this->_site_path . '/user/check_un');?>?random="+Math.random()+"&un="+name,
		     type: 'POST',
		     async:false,
		     success: function (data) {
		         if (data == "pass") {
		               $("#div").show();
		                $("#div").html("该用户名不存在");
		                  rel = false;
		                }else if (data == "存在") {		                	
		                	rel = true;
		                	$("#div").hide();
		                }
		            }
		        });	        
	    return rel;
}

function checkpwd(){
	var rel;
	var name = $("#userName").val();
	var pwd =  $("#pwd").val();
	$.ajax({
	     url:"<?php echo base_url($this->_site_path . '/user/check_pwd');?>?random="+Math.random()+"&un="+name+"&pwd="+pwd,
	     type: 'POST',
	     async:false,
	     success: function (data) {
	    	 	if (data == "错误") {
	               $("#div1").show();
	                $("#div1").html("密码输入错误");
	                  rel = false;
	             }else if (data == "正确") {		                	
	                 rel = true;
	                 $("#div1").hide();
	             }
	     }
	});	        
  return rel;
}

function checkcaptcha(){
	var res;
	var captcha = $("#captcha").val();
	$.ajax({
    	url:"<?php echo base_url($this->_site_path . '/user/check_captcha');?>?random="+Math.random()+"&captcha="+captcha,
        type: 'POST',
        async:false,
        success: function (data) {
        	if (data == "error") {
        		$("#div6").show();
            	$("#div6").html("验证码输入错误");
            	res = false;
            }
            else if (data == "ok") {
            	res = true;
            	$("#div6").hide();
            }
        }
    });
    return res;
}

function checkInfo(){	
	if(checkname()==false || checkpwd() ==false|| checkcaptcha() ==false){
		return false;
	}
	
	return true;
}
</script>
<body>

<div class="header">
    <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
    <h2>用户登录</h2>
</div>

<div class="common_wrapper">
    <div class="main">
        <div class="item item_tips" style="display:none;">
            <div class="err_msg"></div>
        </div>
        <form action="<?php echo base_url($this->_site_path . '/user/do_login');?>" method="post" onsubmit="return checkInfo();">
        <div class="item item_username">
            <input id ="userName" onkeyup="return checkname();" class="txt_input txt_username" type="text" placeholder="请输入用户名" name="username" value="<?php echo $username; ?>">
        	<div id="div" style="color:#ff0000; font-size:12px"></div>
        </div>
        <div class="item item_password">
            <input id="pwd" onkeyup="return checkpwd();" class="txt_input txt_password" type="password" autocomplete="off" placeholder="请输入密码" name="password" value="<?php echo $password; ?>">
            <b class="tp_btn btn_off" id="showpwd"></b>
            <div id="div1" style="color:#ff0000; font-size:12px"></div>
        </div>
        <div class="item item_captcha">
            <div class="input_info" style="display:block;">
                <input onkeyup="return checkcaptcha();" class="txt_input txt_captcha" type="text" size="11" maxlength="6" autocomplete="off" placeholder="请输入验证码" name="captcha" id="captcha">                
            	<span id="captcha_img"><img src="<?php echo base_url($this->_site_path . '/user/verify');?>" width="63" height="25" alt="" onclick= this.src="<?php echo base_url($this->_site_path . '/user/verify').'/'?>"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。"></span>
            <div id="div6" style="color:#ff0000; font-size:12px"></div>
            </div>
        </div>
        <div class="item item_btns">
           <!--如果有文本框中全部输入信息 则在a标签class中去掉btn_disabled ，否则加上btn_disabled 
            <a class="btn_login btn_disabled" href="javascript:;">登录</a>
            -->
            <input name="submit" type="submit" class="btn_login" value="登录"/>
        </div>
        </form>
        <div class="item item_login_option">
            <span class="register_free">
                <a href="<?php echo base_url($this->_site_path . '/user/register');?>" class="">免费注册</a>
            </span>
            <span class="retrieve_password">
                <a href="<?php echo base_url($this->_site_path . '/user/forget');?>" class="">找回密码</a>
            </span>
        </div>
    </div>
</div>

  </body>
</html>
