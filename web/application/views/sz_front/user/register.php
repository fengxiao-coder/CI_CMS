<?php get_messagebox();// 获取提示框 ?>
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
<script type="text/javascript" src="<?php echo base_url('theme/front/js/ajax.js') ?>"></script>
</head>



<script type="text/javascript">
$(function(){
	$("#showpwd").click(function(){		
		$("#showpwd").toggleClass("tp_btn btn_off tp_btn btn_off btn_on");		
		if($(this).attr('class')=="tp_btn btn_off btn_on"){			
			$("#pwd").attr('type','text');
		}else{
			$("#pwd").attr('type','password');
		}
				
	})	
	
})

function checkname(){	
		var rel;
		 var name = $("#userName").val();
		 var regUn = new RegExp("^[0-9a-zA-Z_]{6,18}$");
			if(regUn.test(name)==false){
				document.getElementById("div").style.display="block"; 
				document.getElementById("div").innerHTML = "请输入6-18位数字字母下划线";
				rel = false;
			}else{
				//document.getElementById("div").style.display="none"; 
				$.ajax({
		        	url:"<?php echo base_url($this->_site_path . '/user/check_un');?>?random="+Math.random()+"&un="+name,
		            type: 'POST',
		            async:false,
		            success: function (data) {
		                if (data == "存在") {
		                	$("#div").show();
		                	$("#div").html("该用户名已存在");
		                    rel = false;
		                }
		                else if (data == "pass") {		                	
		                	rel = true;
		                	$("#div").hide();
		                }
		            }
		        });	
			}					
	        
	        return rel;
}

function checkemail(){
	//验证邮箱
	var res;
	var userEmail = $("#userEmail").val();
	var regUe = new RegExp("^[0-9a-zA-Z_]{1,}@[0-9a-zA-Z_]{1,}\.(com|cn|org)$");  // aa@aa.com
	if(regUe.test(userEmail)==false){
		document.getElementById("div1").style.display="block";
		document.getElementById("div1").innerHTML = "请输入正确的邮箱格式";
		res= false;
	}else{
		$.ajax({
        	url:"<?php echo base_url($this->_site_path . '/user/check_ue');?>?random="+Math.random()+"&ue="+userEmail,
            type: 'POST',
            async:false,
            success: function (data) {
                if (data == "存在") {
                	$("#div1").show();
                	$("#div1").html("该邮箱已注册");
                	res = false;
                }
                else if (data == "pass") {		                	
                	res = true;
                	$("#div1").hide();
                }
            }
        });	
        
	}
	return res;
}

function checkphone(){
	var res;
	var userTel = $("#userTel").val();
	var regUt = new RegExp("^[0-9]{11}$");  
	if(regUt.test(userTel)==false){
		document.getElementById("div2").style.display="block";
		document.getElementById("div2").innerHTML = "请输入正确的手机号码";
		res= false;
	}else{
		$.ajax({
        	url:"<?php echo base_url($this->_site_path . '/user/check_up');?>?random="+Math.random()+"&up="+userTel,
            type: 'POST',
            async:false,
            success: function (data) {
                if (data == "存在") {
                	$("#div2").show();
                	$("#div2").html("该手机已注册");
                	res = false;
                }
                else if (data == "pass") {		                	
                	res = true;
                	$("#div2").hide();
                }
            }
        });	
	}
	return res;
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

function checkpwd(){
	//验证密码是否为6位数
	var userPwd = document.getElementById("pwd").value;
	if(userPwd.length<6){
		document.getElementById("div4").style.display="block"; 
		document.getElementById("div4").innerHTML = "密码不能少于6位数";
		res= false;
	}else{
		document.getElementById("div4").style.display="none"; 
		res = true;
	}
	return res;
}

function checkrepwd(){
	//验证两次密码是否一致
	var userRepwd = document.getElementById("rpwd").value;
	var userPwd = document.getElementById("pwd").value;
	if(userPwd!=userRepwd){
		document.getElementById("div3").style.display="block"; 
		document.getElementById("div3").innerHTML = "两次密码不一致";
		return false;
	}else{
		document.getElementById("div3").style.display="none"; 
	}
	return res;
}


function checkstore(){
	//验证有无选择店铺
	var sid = document.getElementById("sid").value;
	if(sid==""){
		document.getElementById("div5").style.display="block";
		document.getElementById("div5").innerHTML = "请选择店铺";
		return false;
	}else{
		document.getElementById("div5").style.display="none"; 
	}
	return res;
}


function checkInfo(){	
	if(checkname()==false || checkpwd() ==false|| checkrepwd() ==false|| checkemail() ==false|| checkphone() ==false|| checkstore() ==false || checkcaptcha() ==false){
		return false;
	}
	
	return true;
}
</script>




<body>
<div class="header">
    <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
    <h2>用户注册</h2>
</div>
<form action="<?php echo base_url($this->_site_path . '/user/do_register');?>" method="post" onsubmit="return checkInfo();">
<div class="common_wrapper">
    <div class="main">
        <div class="item item_tips" style="display:none;">
            <div class="err_msg"></div>
        </div>
        
        <div class="item item_sms_captcha">
            <input id = "userName" onkeyup="return checkname();" class="txt_input txt_username" type="text" autocomplete="off" placeholder="请输入6-18用户名" name="user_name" value="<?php echo $username; ?>">
            <div id="div" style="color:#ff0000; font-size:12px"></div>
            <div id="uh"></div>
        </div>
        <div class="item item_password">
            <input id="pwd" onkeyup="return checkpwd();" class="txt_input txt_password" type="password" autocomplete="off" placeholder="请设置6_20位登录密码" name="password" value="<?php echo $password; ?>">
            <b class="tp_btn btn_off" id="showpwd"></b>
            <div id="div4" style="color:#ff0000; font-size:12px"></div>
        </div>
        <div class="item item_password">
            <input onkeyup="return checkrepwd();" id="rpwd" class="txt_input txt_password" type="password" autocomplete="off" placeholder="请确认密码" name="repassword" value="<?php echo $repassword; ?>">
        	<div id="div3" style="color:#ff0000; font-size:12px"></div>
        </div>
        <div class="item item_email">
             <input onkeyup="return checkemail();" id="userEmail" onchange="return checkemail();" class="txt_input txt_email" type="text" autocomplete="off" placeholder="请输入正确邮箱，用于找回密码" name="email" value="<?php echo $email; ?>">
        	<div id="div1" style="color:#ff0000; font-size:12px"></div>
        	<div id="eh"></div>      
        </div>
         <div class="item item_phone">
             <input id="userTel" onkeyup="return checkphone();" class="txt_input txt_hone" type="text" autocomplete="off" placeholder="请输入正确手机，用于找回密码"  name="phone" value="<?php echo $phone; ?>">
        	<div id="div2" style="color:#ff0000; font-size:12px"></div>
        	<div id="ph"></div>
        </div>
        <?php if ($info){ //读取邀请码?>
        	<div class="item item_phone">
             <input class="txt_input txt_hone" type="text" disabled="disabled" name="bar_code" value="<?php echo $this->store_model->get_value_by_pk($info["store_id"],"bar_code");?>">
        	<input type="hidden" name="store_id" value="<?php echo $info['store_id'];?>">
        </div>
        <?php }else{ ?>
        	<div class="item item_phone" onchange="return checkstore();">
             <select class="txt_select txt_hone"  name="store_id" id="sid">
                        <option value="">--请选择店铺--</option>
                        <?php foreach ($store_name as $k=>$v) {?>
                        <option value="<?php echo $v['id'];?>" <?php echo $store_id == $v['id']?"selected='selected'":"";?>><?php echo $v['sName'];?></option>
                        <?php } ?>
             </select>
             <div class="select_icon"></div>
             <div id="div5" style="color:#ff0000; font-size:12px"></div>
        </div>
        <?php }?> 
        
        <div class="item item_captcha">
            <div class="input_info" style="display:block;">
                <input onkeyup="return checkcaptcha();" class="txt_input txt_captcha" type="text" size="11" maxlength="6" autocomplete="off" placeholder="请输入验证码" name="captcha"  id="captcha">               
            	<span id="captcha_img"><img src="<?php echo base_url($this->_site_path . '/user/verify');?>" width="63" height="25" alt="" onclick= this.src="<?php echo base_url($this->_site_path . '/user/verify').'/'?>"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。"></span>
            </div>
            <div id="div6" style="color:#ff0000; font-size:12px"></div>
        </div>
        <div class="err_tips">注册即视为同意<a href="#">《跨境电商平台用户注册协议》</a></div>
        
        <div class="item item_btns">
           <!--如果有文本框中全部输入信息 则在a标签class中去掉btn_disabled ，否则加上btn_disabled  -->
            <!--<a href="javascript:;" class="btn_login btn_disabled">注册</a>-->
            <input id="bt" type="submit" class="btn_login"  value="注册"/>
            <input type="hidden" name="is_submit" value="1">
        </div>
    </div>
</div>
</form>

  </body>
</html>
