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
        <h2>商品退/换货</h2>
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

			 function checkInfo(){
					//验证有无填写退货理由:  
					var how_oos = document.getElementById("how_oos").value;
					if(how_oos==""){
						document.getElementById("div").style.display="block";
						document.getElementById("div").innerHTML = "请填写您的退/换货理由";
						return false;
					}else{
						document.getElementById("div").style.display="none"; 
					}
								
					return true;
				}
		</script>
			<!-- /script-for-menu -->
		 </div>
     <div class="clearfix"> </div>
   </div>	
<div class="xl">
	<div></div>
</div>
<div class="eval">
<form method="post" action="<?php echo base_url($this->_site_path . '/myorder/add_back');?>" onsubmit="return checkInfo();">
		<?php $addtime = $this->order_info_model->get_value_by_pk($goods["order_id"],"add_time");?>
		
      	 <div class="time"><span>成交时间</span><?php echo date('Y-m-d', $addtime) ?></div>
     	 <div class="product">
        		 <div class="poho"><img src="<?php echo site_url($this->goods_model->get_value_by_pk($goods["goods_id"],"photo")); ?>"></div>
            	 <div class="txt"><?php echo $goods['goods_name']?></div>
     	 </div>
          <div class="clear rate_result">
           </div>
           <input type="hidden" name="rec_id" value="<?php echo $goods['rec_id']?>"/>
           <input type="hidden" name="order_id" value="<?php echo $goods['order_id']?>"/>

         <div class="textarea">
        	 <textarea name="how_oos" id="how_oos" placeholder="请填写退/换货理由"></textarea>
        	 <div id="div" style="color:#ff0000; font-size:12px"></div>
         </div>
         <div class="item item_btns">
         <input type="submit" value="确定" class="btn_login" id="sub" >
      </div>
     
</form>
</div>
<?php $this->load->view_part("sz_front/common/footer")?>
