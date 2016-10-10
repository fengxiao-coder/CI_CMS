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
<title>找回密码</title>
<link href="<?php echo base_url('theme/front/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('theme/front/css/style.css') ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('theme/front/css/lrtk.css') ?>" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="<?php echo base_url('theme/front/js/jquery-1.11.0.min.js') ?>"></script>
</head>

<body>

<div class="u_header">
    <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
    <h2>找回密码</h2>
     <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
</div>
<div class="header-main">
         <div class="top-nav">
             <ul class="nav nav-pills nav-justified res">
		       	<li><a class="active no-bar" href="<?php echo base_url($this->_site_path . '/index/index');?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
				<li><a href="<?php echo base_url("sz_front/search/index"); ?>"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
				<li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
				<li><a href="<?php echo base_url($this->_site_path . '/user/userhome'). "/" . $id;?>"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
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
<div class="common_wrapper">
    <div class="main">
        <div class="item item_username" style="text-align:center;">
            <p style="line-height:25px; color:#930;">验证邮件已发送，<br>请前往邮箱验证！</p>
        </div>
        <div class="item item_btns">
           <!--如果有文本框中全部输入信息 则在a标签class中去掉btn_disabled ，否则加上btn_disabled -->
            <a class="btn_login " href="<?php echo base_url($this->_site_path . '/index/index');?>">返回首页</a>
        </div>
        
  </div>
</div>

  </body>
</html>
