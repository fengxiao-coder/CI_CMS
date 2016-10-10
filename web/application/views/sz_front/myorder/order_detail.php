<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/shipp.css') ?>" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
         <h2>订单详情</h2>
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

	<div class="Edit_order">
    <!-- 订单信息这块儿，要看是否已经发货，如果发货了，就有快递名称和运单号-->
       <div class="order_box">
		   <div class="order_width">
				<p>订单编号：<?php echo $order_info["order_sn"]?></p>
				<p>订单金额：￥392 .00</p>
				<p>订单日期：<?php echo date('Y-m-d H:i:s', $order_info['add_time']); ?></p>
                <!--  如果已经发货了就有以下的“快递信息”，如果没有发货就没有快递信息-->
                <?php if($delivery){
                	foreach ($delivery as $v){
                ?>
                <p>快递名称：<?php echo $v["shipping_name"]?></p>
                <p>快递单号：<?php echo $v["invoice_no"]?></p>
                <p>发货日期：<?php echo date('Y-m-d H:i:s', $v['update_time']); ?></p>
                <?php }}?>
		   </div>
		</div>

    <div class="order_product" style="margin-top:0">
        <div class="shop_group_item">
                               <!--  店铺标题开始，取地址-->
                                <div class="shop_title">
                                 <div class="item">
                                    <div class="shop_title_content">
                                     <a href=""><span class="shop-title-name">跨境电商平台-<?php echo $this->store_model->get_value_by_pk($order_info['store_id'],"sName");?></span></a>
                                     <?php 
                                     	if($current_type=="all"){
                                     		//p($order_info);
                                     		if($order_info['order_status']==1 or $order_info['order_status']==2 or $order_info['order_status']==3){
				                      			$order_status = $this->order_goods_model->order_status($order_info['order_status']);
				                      			$shipping_status ="";
				                      			$pay_status="";
				                      		}elseif ($order_info['pay_status']==0 && $order_info['order_status']==0){
				                      			$pay_status = $this->order_goods_model->pay_status($order_info['pay_status']);
				                      			$order_status="";
				                      			$shipping_status="";
				                      		}elseif ($order_info['pay_status']==2){
				                      			$shipping_status = $this->order_goods_model->shipping_status($order_info['shipping_status']);
												$pay_status ="";
												$order_status="";
				                      		}	?>
				                      		
				                      		<div  class="icons_fon"><?php echo $order_status.$pay_status.$shipping_status ;?></div>
				                      		<?php 
                                     	}elseif ($current_type=="pay"){ ?>
                                     		<div  class="icons_fon">等待买家付款</div>
                                     	<?php }elseif ($current_type=="ship"){?>
                                     		<div  class="icons_fon">等待卖家发货</div>
                                     	<?php }elseif ($current_type =="check"){?>
                                     		<div  class="icons_fon">卖家已发货</div>
                                     	<?php }elseif ($current_type=="eval"){?>
                                     		<div  class="icons_fon">交易成功</div>
                                     	<?php }?>
                                     
                                    </div>
                                 </div>
                            </div>
                                <!--  店铺标题结束-->        
                                <!--主体开始   -->    
                                <ul class="shp_cart_list bg" >
                                  <?php foreach($goods as $single){ ?>
                                  <li name="productGroup" >
                                    <div class="items">
                                    <div class="shp_cart_item_core">
                                        <a class="cart_product_cell_pic" href=""><img class="cart_photo_thumb" alt="" src="<?php echo base_url().$this->goods_model->get_value_by_pk($single['goods_id'],"photo"); ?>"></a>
                                        <div class="car_product_cell_box">
                                            <div class="cart_product_name">
                                            <a href=""><span><?php echo $this->goods_model->get_value_by_pk($single['goods_id'],"name");?></span></a>
                                            <div class="lgray"><span><?php echo $single["goods_attr"]?></span></div>
                                            </div>
                                          <div class="cart_product_price"><span class="shp_cart_item_price mr" id="price1032452035">￥<?php echo $this->goods_model->get_value_by_pk($single['goods_id'],"price"); ?></span></div>

                                      <div class="wastebin_container">x<?php echo $single['goods_number'];?></div>

                                     </div><!--car_product_cell_box 结束-->

                                   </div><!--shp_cart_item_core 结束-->
                                   <div class="clear"></div>
                                 </div><!--items 结束-->
                                </li>
                               <?php }?>
                          </ul>
                                
                                  
                                   </div>
        <?php 
        //p($order_info["address_id"]);
        	  $order_address = $this->user_address_model->get_by_pk($order_info["address_id"]);	
        	 // p($order_address);
              $province=$this->user_province_model->get_value_by_pk($order_address['province'],"province_name");
              $city=$this->user_city_model->get_value_by_pk($order_address['city'],"city_name");
              $district=$this->user_area_model->get_value_by_pk($order_address['district'],"area_name");
       ?>
     	<div class="order_box">
			 <p class="border_bottom usr_name"><?php echo $order_address["consignee"]?><span style="float:right;"><?php echo $order_address["mobile"]?></span></p>
			 <p class="usr_addr"><?php echo $province .$city .$district .$order_address["address"]; ?></p>			
		 </div>
    </div><!--order_product-->
    </div>
    
<?php $this->load->view_part("sz_front/common/footer")?>

  	<div class="or_tab_btn">
          <ul> 
  		<?php if(!$delivery){   
  			if($order_info['pay_status']==0 and $order_info['order_status']==0){ ?>  					 
		            <li class="ho" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/order_info/pay')."/".$order_info['order_id'];?>"> 付款 </a></li>
		            <li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/cancel')."/".$order_info['order_id'];?>">取消订单</a></li>
  		<?php }elseif ($order_info['order_status']==0){?>
		            <li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/cancel')."/".$order_info['order_id'];?>">取消订单</a></li>
  		<?php }}?>
      </ul>    
   </div>  

    
  </body>
</html>
