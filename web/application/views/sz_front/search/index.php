<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id, 'user_name');
?>
<?php $this->load->view_part("sz_front/common/header") ?>
</head>
<body>
    <!--header start here-->
    <div class="u_header">
        <form method="post" action="<?php echo base_url("sz_front/search/check/"); ?>">
            <a href="javascript:history.go(-1)" class="new_a_back new_a_cancel"><span>取消</span></a>
            <div class="header_search_box">
                <div class="header_search_input input_width">
                    <input id="layout_newkeyword" name="name_like" type="text" cleardefault="no" autocomplete="off" value="<?php echo $this->input->get('name'); ?>">
                </div> 
                 <!--<a href="javascript:void(0);" class="icon_close" id="index_clear_keyword" style="display: none;"></a>-->
                 <input id="index_clear_keyword" type="button" class="icon_close">
                <button type="submit" class="header_icon_search icon_search"><span class="glyphicon glyphicon-search">查询</span></button>
          		<input type="hidden" name="submit" value="2">
            </div>     
        </form>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
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
    <script language="javascript" type="text/javascript">
        function change_bg(obj) {
            var a = document.getElementsByClassName("tags")[0].getElementsByTagName("a");
            for (var i = 0; i < a.length; i++) {
                a[i].className = "";
            }
            obj.className = "selectTag";
        }
    </script>
    <script type="text/javascript">
				$(function(){
					
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
    <!-- 代码 开始 -->
    <div id="con" >
        <ul id="tags" class="tags">
            <li><a <?php if ($cart_id == "") { ?> class="selectTag"<?php } ?> href="<?php echo base_url("sz_front/search/index"); ?>">热门推荐</a> </li>
            <?php foreach ($category as $k => $single) {  //分类?>
                <li><a <?php if ($cart_id == $single['cat_id']) { ?> class="selectTag"<?php } ?> href="<?php echo base_url($this->_site_path . '/search/index') . "/" . $single['cat_id']; ?>"><?php echo $single['cat_name']; ?></a> </li>
            <?php } ?>  
        </ul>
        <?php //p($goods_category)?>
        <div  class="tagContent_warp">
            <div id="tagContent" class="tagContents">
                <?php foreach ($goods_category as $key => $value1) { 
                //p($value1);
                	?>   
                    <div class="tagContent selectTag" id="tagContent0">
                        <h1 class="h_title"><?php echo $this->goods_category_model->get_value_by_pk($key, 'cat_name'); ?></h1>
                        <ul>
                            <?php foreach ($value1 as $value2) {
//p($value2);
                            	?>
                                <li>
                                    <a href="<?php echo base_url("sz_front/search/lists/{$value2['cat_id']}"); ?>"><img src="<?php echo site_url($value2['photo']); ?>" ></a>
                                    <span><?php echo $value2['cat_name']; ?></span>
                                </li>
                            <?php } ?>                       
                        </ul>
                    </div>
                <?php } ?> 
            </div>
        </div>
    </div>
    <script type=text/javascript>
        function selectTag(showContent, selfObj) {
            //  操作标签
            var tag = document.getElementById("tags").getElementsByTagName("li");
            var taglength = tag.length;
            for (i = 0; i < taglength; i++) {
                tag[i].className = "";
            }
            selfObj.parentNode.className = "selectTag";
            // 操作内容
            for (i = 0; j = document.getElementById("tagContent" + i); i++) {
                j.style.display = "none";
            }
            document.getElementById(showContent).style.display = "block";
        }
    </script>
    <!-- 代码 结束 -->
</body>
</html>
