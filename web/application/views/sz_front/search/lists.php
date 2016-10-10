<?php $this->load->view_part("sz_front/common/header") ?>
<script src="<?php echo base_url('theme/front/js/js.js') ?>"></script>
</head>
<body>
    <!--header start here-->
    <div class="u_header">
        <form method="post" action="<?php echo base_url("sz_front/search/lists/")."/".$id; ?>">
            <a href="javascript:history.go(-1)" class="new_a_back new_a_cancel"><span>取消</span></a>
            <div class="header_search_box">
                <div class="header_search_input input_width">
                    <input id="layout_newkeyword" name="name_like" type="text" cleardefault="no" autocomplete="off" value="<?php echo $this->input->get('name_like'); ?>">
                </div> 
                 <!--<a href="javascript:void(0);" class="icon_close" id="index_clear_keyword" style="display: none;"></a>-->
                 <input id="index_clear_keyword" type="button" class="icon_close" >
                <button type="submit" class="header_icon_search icon_search"><span class="glyphicon glyphicon-search">查询</span></button>
          		<input type="hidden" name="submit" value="2">
            </div>     
        </form>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span><div>菜单</div></div>
    </div>
    <div class="header-main">
        <div class="top-nav">
            <ul class="nav nav-pills nav-justified res">
                <li><a class="active no-bar" href="<?php echo base_url("sz_front/index"); ?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
                <li><a href="<?php echo base_url("sz_front/search/index"); ?>"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
                <li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
                <li><a href="<?php echo base_url($this->_site_path . '/user/userhome'); ?>"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
            </ul>
            <!-- script-for-menu -->
            <script>
                $("div.header_icon").click(function () {
                    $("ul.res").slideToggle(300, function () {
                        // Animation complete.
                    });
                });
            </script>
            <!-- /script-for-menu -->
        </div>
        <div class="clearfix"> </div>
    </div>	
    <div class="list_head">
    <?php //p($name_like)?>
    <!--  
        <ul id="tag">
            <li <?php if ('' == $order) { ?> class="current"<?php } ?>><a href="<?php echo base_url($this->_site_path . '/search/lists') . "/" . $id; ?>">综合</a></li>
            <li <?php if ('sales' == $order) { ?> class="current"<?php } ?>><a href="<?php echo base_url($this->_site_path . '/search/lists') . "/" . $id . "?orders=sales"; ?>">销量</a></li>
            <li <?php if ('price' == $order) { ?> class="current"<?php } ?>><a href="<?php echo base_url($this->_site_path . '/search/lists') . "/" . $id . "?orders=price"; ?>">价格</a></li>
        </ul>
  -->
  <?php if ($id){?>
  		<ul id="tag">
                      <li <?php if( 'all' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/search/lists')."/".$id."/all";?>">全部</a>
					  </li>
					   <li <?php if( 'sales' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/search/lists')."/".$id."/sales"."?name=".$name_like?>">销量</a>
					  </li>
					   <li <?php if( 'price' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/search/lists')."/".$id."/price"."?name=".$name_like;?>">价格</a>
					  </li>					
            </ul>  
  <?php }else {?>
  			<ul id="tag">
                      <li <?php if( 'all' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/search/check')."/all";?>">全部</a>
					  </li>
					   <li <?php if( 'sales' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/search/check')."/sales"."?name=".$name_like?>">销量</a>
					  </li>
					   <li <?php if( 'price' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/search/check')."/price"."?name=".$name_like;?>">价格</a>
					  </li>					
            </ul>  
  <?php }?>

        <!--点击筛选弹出tag_showbox-->
        <div class="tag_box"><a id="check">筛选</a></div>
        <script type="text/javascript">
            if (document.getElementById) { //DynamicDrive.com change
                document.write('<style type="text/css">\n')
                document.write('.submenu{display: none;}\n')
                document.write('</style>\n')
            }
            function SwitchMenu(obj) {
                if (document.getElementById) {
                    var el = document.getElementById(obj);
                    var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
                    if (el.style.display != "block") { //DynamicDrive.com change
                        for (var i = 0; i < ar.length; i++) {
                            if (ar[i].className == "submenu") //DynamicDrive.com change
                                ar[i].style.display = "none";
                        }
                        el.style.display = "block";
                    } else {
                        el.style.display = "none";
                    }
                }
            }
        </script>
        <script type="text/javascript">
				$(function(){
					//
					$("#frm").hide();
					$("#check").click(function(){
						$("#frm").show();
					})
					$("#cancel").click(function(){
						$("#frm").hide();
					})
					
					$("#index_clear_keyword").hide();
					$("#layout_newkeyword").mousedown(function(){
						$("#index_clear_keyword").show();
					}) 

					$("#index_clear_keyword").click(function(){
							//alert($("#layout_newkeyword").val());
						$("#layout_newkeyword").val("");
						$("#index_clear_keyword").hide();
					})
				})
        </script>
<script type="text/javascript">
$(function(){
	$(".allrow").click(function () {
		$(this).siblings().removeClass("checked");
        $(this).addClass("checked");
		//alert($(this).find("input").val());	
		//alert($(this).find("span").html());
		$("#sp").html($(this).find("input").val());		
		$("#allbran").html($(this).find("span").html());	
    });

    $(".checked").click(function(){
		//alert($(this).attr("class"));
		if($(this).attr('class')=="class"){
			$(this).removeClass("checked");
		}else{
			$(this).siblings().removeClass("checked");
			$(this).addClass("checked");
		}
		$("#allbran").html("全部");	
    });

    $("#one").click(function(){
        //alert($(this).attr('class'));
    	if($(this).attr('class')==""){
    		$(this).siblings().removeClass("checked");
			$(this).addClass("checked");			
		}else{
			$(this).removeClass("checked");
		}
    	$("#allprice").html("全部");	
    });
    
    $(".price_allrow").click(function(){
    	$(this).siblings().removeClass("checked");
        $(this).addClass("checked");
        //alert($(this).find("input").val());	
        $("#sp1").html($(this).find("input").val());	
        $("#allprice").html($(this).find("span").html());	
    });
    
    $("#shaixuan").click(function(){        
    	var a = $('#sp').text();
    	var b = $("#sp1").text();
        $('#brand_id').val(a);
        $('#price_search').val(b);
        var url = "<?php echo base_url("sz_front/search/filter") ."/".$id; ?>";
        $('#frm').attr('action', url);
        $('#frm').submit();
		
    });
});

</script>

	<form id="frm" method="post" action="">
        <!--点击筛选弹出tag_showbox-->
        
            <div class="tag_showbox"  style="display:block">
                <div class="top">筛选<a class="cancel_btn" id="cancel">取消</a>
                    <button type="submit" class="determine_btn" id="shaixuan"><span>确定</span></button>
                </div>
                <ul class="body" id="masterdiv">
                
                    <li class="menutitle" onClick="SwitchMenu('sub1')">
                        <a id="" href="javascript:void(0);">
                            <i class="arrow"></i>
                            <span> 品牌</span>
                            <small class="sort_of_brand" id="allbran">全部</small>
                        </a>
                    </li>
                    <div class="submenu" id="sub1">
                        <ul class="tab_con">
                            <li class="checked">                           
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <span>全部</span>
                            </li>
                            <span id="sp" style="display:none"></span>
                            <input type="hidden" name="brand_id" value="" id="brand_id" />
                            <?php foreach ($brand_data as $k => $single) { ?>
                                <li class="allrow" >
                                    <i class="tick glyphicon glyphicon-ok"></i>
                                    <input type="hidden" value="<?php echo $single['brand_id']; ?>" />
                                    <span><?php echo $single['brand_name']; ?></span>
                                </li>
                            <?php } ?> 

                        </ul>
                    </div>
                    
                    <li class="menutitle" onClick="SwitchMenu('sub2')">
                        <a id="" href="javascript:void(0);">
                            <i class="arrow"></i>
                            <span>价格</span>
                            <small class="sort_of_brand" id="allprice">全部</small>
                        </a>
                    </li>
                    
                    <div class="submenu" id="sub2">
                        <ul class="tab_con">
                            <li class="" id="one">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <span>全部</span>
                            </li>
                            <span id="sp1" style="display:none"></span>
                            <input name="price_search" type="hidden" value="" id="price_search"/>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input type="hidden" value="0-100" />
                                <span>0-100</span>
                            </li>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok "></i>
                                <input type="hidden" value="101-200" />
                                <span>101-200</span>
                            </li>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input type="hidden" value="201-300" />
                                <span>201-300</span>
                            </li>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input type="hidden" value="301-400" />
                                <span>301-400</span>
                            </li>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input type="hidden" value="401-500" />
                                <span>401-500</span>
                            </li>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input type="hidden" value="501-600" />
                                <span>501-600</span>
                            </li>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input type="hidden" value="1000" />
                                <span>1000以上</span>
                            </li>
                            <li class="price_allrow">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input type="hidden" value="2000" />
                                <span>2000以上</span>
                            </li>
                        </ul>

                    </div>

                    <!--   <li class="menutitle" onclick="SwitchMenu('sub3')">
                                <a id="" href="javascript:void(0);">
                                <i class="arrow"></i>
                                <span> 材质</span>
                           		<small class="sort_of_brand">全部</small>
                                </a>
                           </li>
                           <div class="submenu" id="sub3">
                               <ul class="tab_con">
                                    <li class="">
                                        <i class="tick glyphicon glyphicon-ok"></i>
                                        <span>全部</span>
                                    </li>
                                    <li class="">
                                        <i class="tick glyphicon glyphicon-ok"></i>
                                        <input name="Fruit" type="radio" value="" /><span>棉</span>
                                    </li>
                                    <li class="">
                                        <i class="tick glyphicon glyphicon-ok"></i>
                                        <input name="Fruit" type="radio" value="" /><span>羊毛</span>
                                    </li>
                                    <li class="">
                                        <i class="tick glyphicon glyphicon-ok"></i>
                                        <input name="Fruit" type="radio" value="" /><span>真丝</span>
                                    </li>
                                </ul>
                           </div> -->
                </ul> 
            </div> 

            <input type="hidden" name="is_submit" value="1">
        </form>
    </div>

    <div id="tagContent" class="list">
        <ul class="list_body" style="display:block;">
            <?php foreach ($goods as $value) { 
            //p($value);
            	?>
                <li>
                    <a style=" text-decoration:none;" href="<?php echo base_url("sz_front/index/detail/{$value['id']}"); ?>" class="J_ping">
                        <div class="list_thumb"><img width="85" height="85" src="<?php echo site_url($value['photo']); ?>"></div>
                        <div class="list_descriptions">
                            <div class="list_descriptions_wrapper">
                                <div class="product_name"><?php echo $value['name']; ?></div>
                                <div class="price_spot"><span class="product_price">￥<span><?php echo $value['price']; ?></span></span></div>
                                <div class="reputation"><span class="ratings">97%好评(14278人)</span></div></div></div></a>
                </li>
            <?php } ?> 
        </ul>
    </div>

    <?php //echo $pagination; ?>

    <?php $this->load->view_part("sz_front/common/footer") ?>
