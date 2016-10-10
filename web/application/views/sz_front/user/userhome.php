<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name');
?>

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
<link href="<?php echo base_url('theme/front/css/style.css') ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('theme/front/css/lrtk.css') ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="<?php echo base_url('theme/front/js/jquery-1.11.0.min.js') ?>"></script>

<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>我的账号</h2>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
    </div>
    <div class="header-main">
         <div class="top-nav">
            <ul class="nav nav-pills nav-justified res">
		       	<li><a class="active no-bar" href="<?php echo base_url($this->_site_path . '/index/index');?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
				<li><a href="<?php echo base_url("sz_front/search/index"); ?>"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
				<li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
				<li><a href="<?php echo base_url($this->_site_path . '/user/userhome')?>"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
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
   <div class="user_main">
  	   <div class="user_index_top"> 
  	   <?php 
  	   			$aurl=$this->user_model->get_value_by_pk($user_id,'avatar');
  	   			$avatar=base_url().$this->user_model->get_value_by_pk($user_id,'avatar');
  	   			$photo =base_url('theme/front/images/pic/b3.jpg');
  	   ?>
       		<span class="my_img"><img src="<?php echo empty($aurl)?$photo:$avatar; ?>"></span>
            <span class="nick">
            	<?php 	echo $user;?>
            </span>
       </div>
       
       <div class="menu_list">
        	<ul>
            	<li><a href="<?php echo base_url($this->_site_path . '/myorder/orders');?>"><div class="bg-red ico"><span class="glyphicon glyphicon-file"></span></div>全部订单<strong>更多</strong></a></li>
                <li><div class="bg-green ico"><span class="glyphicon glyphicon-user"></span></div>用户管理</li>
                <div class="info_item">
                	<a href="<?php echo base_url($this->_site_path . '/user/userInformation');?>"><span class="glyphicon glyphicon-hand-right"></span>修改用户基本信息
                    <strong>更多</strong></a>
                    <a href="<?php echo base_url($this->_site_path . '/user/password');?>"><span class="glyphicon glyphicon-hand-right"></span>修改密码<strong>更多</strong></a>
                    <a href="<?php echo base_url($this->_site_path . '/user/address');?>"><span class="glyphicon glyphicon-hand-right"></span>收货地址<strong>更多</strong></a>
              </div>
              <li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><div class="bg-info ico"><span class="glyphicon glyphicon-shopping-cart"></span></div>购物车
              <strong>更多</strong></a></li>
              <li><a href="<?php echo base_url("sz_front/goods_focus/index"); ?>"><div class="bg-lan ico"><span class="glyphicon glyphicon-heart"></span></div>我的关注
              <strong>更多</strong></a></li>
            </ul>
       </div>
   </div>


<?php $this->load->view_part("sz_front/common/footer")?>