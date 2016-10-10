<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>商品信息详情</title>
<meta name="keywords" content="商品信息查询" />
<meta name="description" content="商品信息详情" />
<?php echo css("css/mobile.css","front");?>
</head>

<body>
<!--<header class="ui_header">
	<h1>商品详情</h1>
    <div class="ui_header_left"><a class="ui_header_ico_return" href="/">< 返回</a></div>
    <div class="ui_header_right"><a id="openMenu" class="ui_header_ico_menu" href="/"></a></div>
    <div class="clearfix"></div>
</header>-->

<center class="product">
 <div class="product_wrap">
    <div class="img"><img src="<?php echo base_url($contents["photo"]);?>" ></div>
    <h1><?php echo $contents["name"];?></h1> <!-- 商品名称-->
    <h2>商品价格：<?php echo $contents["price"];?>元</h2>
    <h2>商品编号：<?php echo $contents["goods_sn"];?></h2>
    <h2>品牌:<?php echo $brand["brand_name"];?><img class="img_logo" style="max-height:30px; max-width:100px;" src="<?php echo base_url($brand["brand_logo"]);?>"/></h2>

 </div>
</center>

<div class="clearfix"></div>
<article class="neir">
     <div class="detail_title">商品详情介绍</div>
     <div class="detail">
           <?php echo $contents["remark"];?>
     </div>
     <div class="txt_msg" style="margin-bottom:20px;">此信息已阅完毕</div>
 </article>

<footer>
<ul class="ui_grid_b">
    <li class="foottel ui_block_a"><a href="tel:075583709725" title="电话"><p>电话</p></a></li>
    <li class="footmail ui_block_b"><a href="1477600952@qq.com" title="邮箱"><p>邮箱</p></a></li>
    <li class="footmap ui_block_c" style="border:0"><a href="#" title="MAP"><p>MAP</p></a></li>
</ul>
</footer>
<script>
$(function(){
$('#slider').mBanner('slider');
});
</script>
<div style="display:none"></div><script>
       var allA = document.getElementsByTagName('a');
			for(var i=0;i<allA.length;i++){
				if(allA[i].href.indexOf('tel')){
				  allA[i].href = allA[i].href + '#mp.weixin.qq.com';
				}
			}
       </script>
	  </body>
</html>
