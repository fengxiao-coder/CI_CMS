<?php
//$user = $this->session->userdata('user_name');
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name');
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
 <script type = "text/javascript">
 $(function(){
	 $(".RadioGroup").click(function(){
		 $.ajax({
				type:"get",
				url:"<?php echo base_url($this->_site_path . '/user/defautaddr');?>?random="+Math.random()+"&id="+$(this).val(),
				dataType:"html",
				success:function(data){
					
				}
			})
		})
})
 </script>
 </head>
<body>
<!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>收货地址</h2>
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

   <div class="user main">
   <?php if(!$rows){ ?>
   	<div class="no_addr">暂时还没有收货地址</div>
 <?php }?>

     
     
     <div class="item item_btns">
         <!--如果有文本框中全部输入信息 则在a标签class中去掉btn_disabled ，否则加上btn_disabled -->
         <a class="btn_login" href="<?php echo base_url($this->_site_path . '/user/add_address');?>">新建收货地址</a>
     </div>

     <div class="new_addr">
     	<ul class="new_addr_ul">
     	<?php //p($rows);?>
     	<?php   
     		foreach($rows as $v){
     		$province = $this->user_province_model->get_value_by_pk($v['province'],"province_name");
     		$city = $this->user_city_model->get_value_by_pk($v['city'],"city_name");
     		$area = $this->user_area_model->get_value_by_pk($v['area'],"area_name");
     	?>
        	<li class="new_addr_li">
            	<p class="new_title">
                  <span class="new_txt"><?php echo $v['consignee']?></span>
                  <span class="new_hone"><?php echo $v['mobile']?></span>
                  <span class="new_adrn"><i>
                  <input type="radio" name="RadioGroup1" value="<?php echo $v['address_id']?>" <?php if($v['mark']==1){echo 'checked';}?> class="RadioGroup" onclick="change()">
                  </i>设为默认地址</span>
                </p>
                <p class="new_p"><?php echo $province.$city.$area.$v['address']?></p>
                <div class="new_btns">
                	<a  href="<?php echo base_url($this->_site_path . '/user/edit_address')."/".$v['address_id'];?>">编辑</a>
                    <span>|</span>
                    <a href="<?php echo base_url($this->_site_path . '/user/delete_address')."/".$v['address_id'];?>">删除</a>
                </div>
            </li>
        <?php }?>               
        </ul>
     </div>
   
   
</div>

<?php $this->load->view_part("sz_front/common/footer")?>