<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name');
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/shipp.css') ?>" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
         <h2>订单管理</h2>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
    </div>
    <?php $user_id = $this->session->userdata('userid');  ?>
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
	  <div class="order">
        		<!-- 代码 开始 -->
               <div class="wrap">
                    <ul id="tag">
                      <li <?php if( 'all' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/myorder/orders/all');?>">全部</a>
					  </li>
					   <li <?php if( 'pay' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/myorder/orders/pay');?>">待付款</a>
					  </li>
					   <li <?php if( 'ship' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/myorder/orders/ship');?>">待发货</a>
					  </li>
					   <li <?php if( 'check' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/myorder/orders/check');?>">待收货</a>
					  </li>
					   <li <?php if( 'eval' == $current_type ){ ?> class="current"<?php } ?> >

							<a href="<?php echo base_url($this->_site_path . '/myorder/orders/eval');?>">待评价</a>
					  </li>
					  
                   </ul>      
                  <?php 
                  	if(count($all_orders)==0){                  	
                  		?>            	 
                     <div class="desc_info desc_info_i" >
					   <div class="or_error">
                      		 <div class="img"><p><span class="glyphicon glyphicon-file"></span></p></div> 
                       		 <p class="txt">您还没有相关的订单</p>  
                       		 <p class="sub_txt">可以去看看有哪些想买</p> 
                      		 <p class="refresh"><a href="<?php echo base_url($this->_site_path . '/index/index');?>" class="bt">随便逛逛</a></p>
                      </div> 
                      </div>                       
                  	<?php }else{ ?>
                  	
                  <div id="tagContent">
                  	  <!-- 全部订单-->
                      <div class="desc_info" style="display:block;">
                      <div class="order_product" >
                      <?php foreach ($all_orders as $v){   
                      		if($v['order_status']==1 or $v['order_status']==2 or $v['order_status']==3){
                      			$order_status = $this->order_goods_model->order_status($v['order_status']);
                      			$shipping_status ="";
                      			$pay_status="";
                      		}elseif ($v['pay_status']==0 && $v['order_status']==0){
                      			$pay_status = $this->order_goods_model->pay_status($v['pay_status']);
                      			$order_status="";
                      			$shipping_status="";
                      		}elseif ($v['pay_status']==2){
                      			$shipping_status = $this->order_goods_model->shipping_status($v['shipping_status']);
								$pay_status ="";
								$order_status="";
                      		}					
                      ?>
                           <div class="shop_group_item">
   					       <!--  店铺标题开始，取地址-->
                            <div class="shop_title">
                             <div class="item">
                                
                                <div class="shop_title_content">
                                <a href=""><span class="shop-title-name"><?php echo "跨境电商平台-".$this->store_model->get_value_by_pk($v['store_id'],"sName");?></span></a>
                                <div  class="icons_fon"><?php echo $order_status.$pay_status.$shipping_status ;?></div>
                                </div>
                             </div>
                        </div>
                            <!--  店铺标题结束-->        
                            <!--主体开始   -->    
      						<ul class="shp_cart_list bg" >
                              <?php 
                              		$search['attributes'] = array('order_id'=>$v['order_id']);
             						$goods = $this->order_goods_model->all($search);
             						//p($goods);
             						$totalnum = 0;
             						foreach ($goods as $single){     
             							//$totalnum+=$single['goods_number'];
             							 $totalnum = $totalnum + $single['goods_number'];
             							$photo = $this->goods_model->get_value_by_pk($single['goods_id'],"photo");
             							//p($single);
                              ?>

                              <li name="productGroup" >
                                <div class="items">
                                <div class="shp_cart_item_core">
                                    <a class="cart_product_cell_pic" href="<?php echo base_url($this->_site_path . '/index/detail')."/".$single['goods_id'];?>"><img class="cart_photo_thumb" alt="" src="<?php echo base_url().$photo; ?>"></a>
                                    <div class="car_product_cell_box">
                                        <div class="cart_product_name">
                                        <a href="<?php echo base_url($this->_site_path . '/index/detail')."/".$single['goods_id'];?>"><span><?php echo $this->goods_model->get_value_by_pk($single['goods_id'],"name");?></span></a>
                                        <div class="lgray"><span><?php echo $single["goods_attr"]?></span></div>
                                        </div>
                                          <div class="cart_product_price"><span class="shp_cart_item_price mr" id="price1032452035">￥<?php echo $single['price']; ?></span><span style="color:#333">x<?php echo $single['goods_number'];?></span></div>
                                  <?php if ($v['shipping_status']==1){ ?>
                                  <div class="wastebin_container">
                                  <?php //echo $status = ($single['status']>0) ? "退货中" : '退货'; ?>
                                  <?php if ($single['status']==0){?>
                                  			<a href="<?php echo base_url($this->_site_path . '/myorder/back_order')."/".$single['rec_id'];?>"><?php echo "退货";?></a>
                                  <?php }elseif ($single['status']==1){
                                  			echo "卖家处理中";
                                  }else{
                                  			echo "退货中";
                                  }?>
                                  </div>
                                  <?php }?>
                                 </div><!--car_product_cell_box 结束-->
                               </div><!--shp_cart_item_core 结束-->
                             </div><!--items 结束-->
                            </li>
                           <?php }?>
                      </ul>
                            <div class="order_product_tips">  
								  <span>(含运费￥<?php echo $v['shipping_fee']?>)</span>                              
                                  <span>合计:<b>￥<?php  echo $v['pay_fee'];?></b></span>
                                  <span>共<b><?php echo $totalnum = count($goods)>1?$totalnum:$single['goods_number'];?></b>件商品</span>                                  <div class="clear"></div>
                            </div>
                            <?php //p($v)?>
                            <?php $eve=$this->goods_evaluation_model->get_by_attributes(array( 'order_id'=>$v["order_id"]));?>  
							<div class="or_tab_btn">					
                             <ul>
                             <?php if($v['pay_status']==0 and $v['shipping_status']==0 and $v['order_status']==0 and $v['ele_status']==0){ //没付款?>
                             	  <li class="ho" name="pay" > <a href="<?php echo base_url($this->_site_path . '/order_info/pay')."/".$v['order_id'];?>" >付款</a> </li>        
                                  <li class="" name="cancelOrder" ><a href="<?php echo base_url($this->_site_path . '/myorder/cancel')."/".$v['order_id'];?>"> 取消订单 </a></li> 
                             <?php }elseif ($v['pay_status']==2 and $v['shipping_status']==1 and $v['order_status']==0 and $v['ele_status']==0){ //付款发货了?>
                             		 <li class="ho" name="cancelOrder" ><a href="<?php echo base_url($this->_site_path . '/myorder/check_ship')."/".$v['order_id'];?>"> 确认收货 </a></li>   
                                  	 <!--   <li> <a href="<?php echo base_url($this->_site_path . '/myorder/returnback')."/".$v['order_id'];?>" >退货/换货</a> </li>-->
                             <?php }elseif ($v['pay_status']==2 and $v['shipping_status']==1 and $v['order_status']==1 and $v['ele_status']==0){ //交易成功没评价?>
                             		<li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/evaluate')."/".$v['order_id'];?>"> 立即评价</a></li>
                             		<li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/remove')."/".$v['order_id'];?>"> 删除订单</a></li>
                             <?php }elseif ($v['pay_status']==2 and $v['shipping_status']==1 and $v['order_status']==1 and $v['ele_status']==1){ //已评价过一次?>
                             		<li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/reeval')."/".$v['order_id'];?>"> 追加评价</a></li>  
                            		<li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/remove')."/".$v['order_id'];?>"> 删除订单</a></li>
                             <?php }elseif ($v['pay_status']==2 and $v['shipping_status']==1 and $v['order_status']==1 and $v['ele_status']==2){ //已追加评论?>
                             		<li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/remove')."/".$v['order_id'];?>"> 删除订单</a></li>
                             <?php }elseif ($v['order_status']==2){?>
                             		<li class="" name="cancelOrder" data-id=""><a href="<?php echo base_url($this->_site_path . '/myorder/remove')."/".$v['order_id'];?>"> 删除订单</a></li>
                             <?php }elseif ($v['pay_status']==2 and $v['shipping_status']==0 and $v['order_status']==0 and $v['ele_status']==0){ //等待卖家发货?>
                             		<li><a href="<?php echo base_url($this->_site_path . '/myorder/cancel')."/".$v['order_id'];?>"> 取消订单 </a></li>
                             <?php }?>
                                  	<li > <a href="<?php echo base_url($this->_site_path . '/myorder/order_detail')."/".$v['order_id']."/".$current_type;?>" >订单详情</a> </li> 
                                </ul>
                               </div>                                 
                               </div>                                                                              
                          <?php }}?>    
                        </div> 
                        <div class="order_pag"><?php echo $pagination; ?></div> 
                      </div>
        		 </div>
           </div>
           <!-- 代码 结束 -->
        </div>

<?php $this->load->view_part("sz_front/common/footer")?>