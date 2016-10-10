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
</head>

<body>
<!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>商品评价</h2>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
    </div>
    <?php $user_id = $this->session->userdata('user_id');?>
    <div class="header-main">
         <div class="top-nav">
            <ul class="nav nav-pills nav-justified res">
		       	<li><a class="active no-bar" href="<?php echo base_url($this->_site_path . '/index/index');?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
				<li><a href="<?php echo base_url("sz_front/search/index"); ?>"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
				<li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
				<li><a href="<?php echo base_url($this->_site_path . '/user/userhome'). "/" . $user_id;?>"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
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
<div class="xl">
	<div></div>
</div>
<div class="eval">
		<form action="<?php echo base_url($this->_site_path . '/myorder/add_eval');?>" method="post">
      	 <?php foreach ($goods as $k=>$v){ ?>
      	 <div class="time"><span>成交时间</span>2015.08.29</div>      	 
     	 <div class="product">
        		 <div class="poho"><img src="<?php echo site_url($this->goods_model->get_value_by_pk($v["goods_id"],"photo")); ?>"></div>
            	 <div class="txt"><?php echo $this->goods_model->get_value_by_pk($v["goods_id"],"name");?></div>
     	 </div>
     	 		<input name="goods_id[]" value="<?php echo $v["goods_id"]?>" type="hidden">
     	 		<input name="order_id[]" value="<?php echo $id?>" type="hidden">
     	 		<input name="id" value="<?php echo $id?>" type="hidden">
     	 		<input name="user_id[]" value="<?php echo $this->order_info_model->get_value_by_pk($id,"user_id")?>" type="hidden">
     	 		<input name="created_time[]" value="<?php echo strtotime(date('Y-m-d'))?>" type="hidden">
          <div class="clear rate_result">
                 <span><input checked="checked" type="radio" name="RadioGroup<?php echo "/".$v["goods_id"]?>" value="0" id="Radio_0"><i class="icon icon-good">好评</i></span>
                 <span><input type="radio" name="RadioGroup<?php echo "/".$v["goods_id"]?>" value="1" id="Radio_1"><i class="icon icon-general">中评</i></span>
                 <span><input type="radio" name="RadioGroup<?php echo "/".$v["goods_id"]?>" value="2" id="Radio_2"><i class="icon icon-poor">差评</i></span>
         </div>
         <div class="textarea">
        	 <textarea name="content[]" cols="" rows="" placeholder="商品好用？"></textarea>
         </div>
         <?php }?>
         <div class="item item_btns">
         <input type="submit" value="确定" class="btn_login" id="sub" >
      </div>
      </form>
</div>
<?php $this->load->view_part("sz_front/common/footer")?>