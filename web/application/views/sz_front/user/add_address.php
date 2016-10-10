<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name');
?>
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
	
<script type="text/javascript">
$(function(){
	$("#language").change(function(){
		//alert($(this).val());
		$.ajax({
			type:"get",
			url:"<?php echo base_url($this->_site_path . '/user/getcity');?>?random="+Math.random()+"&oneid="+$(this).val(),
			dataType:"html",
			success:function(data){
				$("#language1").html(data);
			}
		})
	})

	$("#language1").change(function(){
		$.ajax({
			type:"get",
			url:"<?php echo base_url($this->_site_path . '/user/getarea');?>?random="+Math.random()+"&cityid="+$(this).val(),
			dataType:"html",
			success:function(data){
				$("#language2").html(data);
			}
		})
	})
	
})
</script>
<script type="text/javascript">

function checkInfo(){
	//验证表单是否有空值
	for(var i=0;i<document.form1.elements.length-1;i++){
	     if(document.form1.elements[i].value==""){
	      alert("请填写完整的信息");
	      document.form1.elements[i].focus();
	      return false;
	     }
    }
	//验证手机格式
	var userTel = document.getElementById("userTel").value;
	var regUt = new RegExp("^[0-9]{11}$");  
	if(regUt.test(userTel)==false){
		document.getElementById("div").style.display="block";
		document.getElementById("div").innerHTML = "请输入正确的手机号码";
		return false;
	}else{
		document.getElementById("div").style.display="none"; 
	}

	return true;
}
</script>
</head>

<body>
<!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>新建收货地址</h2>
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
<form name="form1" action="<?php echo base_url($this->_site_path . '/user/do_addr');?>" method="post" onsubmit="return checkInfo();">
   <div class="user main" >
   	 <ul>
     	<li><span>收货人姓名</span><input class="txt_input" name="consignee"></li> 
     	<li>
     	<span>手机号码</span><input id="userTel" class="txt_input" name="mobile">
     	<div id="div" style="color:#ff0000; font-size:12px"></div>
     	</li>
     	<li><span style="font-size:18px; font-weight:bold;">收货地址</span></li> 
     </ul>
   </div>
<div class="user_select">
  <div class="user_select_01">
  <span class="uboxstyle_name">省份</span>
  <div id="uboxstyle" class="uboxstyle">
  <select id="language" name="province">
      <option value="-1">请选择</option>
      <?php foreach($pro_arr as $v){?>
      <option value="<?php echo $v['id'];?>"><?php echo $v['province_name']?></option>
     <?php }?>
  </select>
  </div>
  </div>
  
  <div class="user_select_01">
  <span class="uboxstyle_name">城市</span>
  <div id="uboxstyle1" class="uboxstyle">
      <select id="language1" name="city" >
        <option value="">请选择</option>       
      </select>  
  </div>
  </div>
  
  <div class="user_select_01">
  <span class="uboxstyle_name">区县</span>
  <div id="uboxstyle2" class="uboxstyle">
    <select id="language2" name="area">
        <option id="" value="">请选择</option>      
    </select>  
    </div>
  </div>
    
  <!-- 街道地址-->
    <div class="new_tbl_type">
           <span class="new_tbl_cell new_txt_w38">街道</span>
             <span class="new_tbl_cell">
                 <div class="new_post_wr">
                     <textarea name="address" id="address_where" rows="5" cols="30" title="" class="new_textarea"></textarea>
                  </div>
             </span>                        
    </div>

    <div class="item item_btns">
         <!--如果有文本框中全部输入信息 则在a标签class中去掉btn_disabled ，否则加上btn_disabled 
         <a class="btn_login" href="">确定</a>-->
         <input type="submit" value="确定" class="btn_login">
      </div>
   </div>

</div>
</form>
<?php $this->load->view_part("sz_front/common/footer")?>