<?php
//$user = $this->session->userdata('user_name');
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name');
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<script src="<?php echo base_url('theme/front/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('theme/front/js/responsiveslides.min.js') ?>"></script>
</head>

    <body>
        <!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
         <h2>我的关注</h2>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
    </div>
    <div class="header-main">
         <div class="top-nav">
            <ul class="nav nav-pills nav-justified res">
		       	<li><a class="active no-bar" href="<?php echo base_url('sz_front//index/index');?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
				<li><a href="<?php echo base_url("sz_front/search/index"); ?>"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
				<li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
				<li><a href="<?php echo base_url('sz_front//user/userhome');?>"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
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
        <!--banner-slider start here-->
           <nav class="app-nav">
                <li class="app-link">
                    <a href="<?php echo base_url("sz_front/search/index"); ?>"><div class="circle"><span class="glyphicon glyphicon-list mt" ></span></div>
                        <span class="g_mullinkFont">查询列表</span></a>
                </li>
                <li class="app-link">
                    <a href="<?php echo base_url("sz_front/goods_focus/index"); ?>"><div class="circle bg-red"><span class="glyphicon glyphicon-heart"></span></div>
                        <span class="g_mullinkFont">我的关注</span></a>
                </li>
                <li class="app-link">
                    <a href="<?php echo base_url("sz_front/cart/index"); ?>"><div class="circle  bg-green" ><span class="glyphicon glyphicon-shopping-cart"></span></div>
                        <span class="g_mullinkFont">购物车</span></a>
                </li>
                <li class="app-link">
                    <a href="<?php echo base_url("sz_front/user/userhome"); ?>"><div class="circle bg-orgen" ><span class="glyphicon glyphicon-user"></span></div>
                        <span class="g_mullinkFont">我的账户</span></a>
                </li>
                <div class="clearfix"></div>
            </nav>
            <!-- 快捷导航结束-->
        <div class="bann">
            <div class="bann-title">
                <h1>我的关注</h1>
            </div>
            <div class="bann-info">
                <?php foreach ($list as $k => $single) { 
                	?>
                    <div class=" bann-info-grid" onclick="tiao_url('<?php echo $show_url; ?>')">
                        <a href="<?php echo base_url("sz_front/index/detail/{$single['goods_id']}"); ?>">					
                            <center>
                                <img src="<?php echo site_url($single['photo']); ?>" alt="" class="img-responsive">
                            </center>
                        </a>
                        <div class="ban-info-details">
                            <h3><?php echo $single['name']; ?></h3>
                            <p>¥<?php echo $single['price']; ?></p>
                            <span class="delete_btn"><a href="<?php echo base_url("sz_front/goods_focus/delete/{$single['id']}"); ?>">删除</a></span>
                        </div>
                    </div>
                <?php } ?>       
                <div class="clearfix"> </div>
            </div>
        </div>
       <footer>
       <ul class="ui_grid_b">
       
       	<?php if($user){?>
          		<li class="foottel"><a href="<?php echo base_url('sz_front/user/userhome');?>" title="用户账号"><p><?php echo $user;?></p></a></li>
             	<li class="footmail"><a href="<?php echo base_url('sz_front/user/logout');?>" title="退出"><p>退出</p></a></li>
          	<?php }else{ ?>
          		<li class="foottel"><a href="<?php echo base_url('sz_front/user/register');?>" title="用户注册"><p>注册</p></a></li>
             	<li class="footmail"><a href="<?php echo base_url('sz_front/user/login');?>" title="用户登录"><p>登录</p></a></li>
          	<?php }?>  
           <li class="footmap"><a href="<?php echo base_url('sz_front/index/suggest'); ?>" title="意见反馈"><p>意见反馈</p></a></li>
           <li class="footmap " style="border:0"><a href="" title="置顶"><p>置顶</p></a></li>
       </ul>
    </footer>
    
  </body>
</html>
