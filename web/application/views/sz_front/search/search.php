<?php $this->load->view_part("sz_front/common/header") ?>
    </head>
    <body>
        <!--header start here-->
        <div class="u_header">
            <form method="get" action="<?php echo base_url("sz_front/search/like/"); ?>">
                <a href="javascript:history.go(-1)" class="new_a_back new_a_cancel"><span>取消</span></a>
                <div class="header_search_box">
                    <div class="header_search_input input_width">
                        <input id="layout_newkeyword" name="name" type="text" cleardefault="no" autocomplete="off" value="<?php echo $this->input->get('name'); ?>">
                    </div> 
                    <a href="javascript:void(0);" class="icon_close" id="index_clear_keyword" style="display: block;"></a>
                    <button type="submit" class="header_icon_search icon_search"><span class="glyphicon glyphicon-search">查询</span></button>
                </div>     
            </form>
            <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
        </div>
        <div class="header-main">
            <div class="top-nav">
                <ul class="nav nav-pills nav-justified res">
                    <li><a class="active no-bar" href="Index.htm"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
                    <li><a href="SearchIndex.htm"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
                    <li><a href="user/Cart.htm"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
                    <li><a href="user/UserHome.htm"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
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
        <div class="search_lading_area" >
            <!-- 当收索框input没值时，显示此div， 有值则隐藏-->
            <div class="landing_tags" style="display:none;">
                <div class="hot_search_bar">热门收索</div>
                <a id="hotKeyWordBtn_0" href="List.htm"><span>男装</span></a>
                <a id="hotKeyWordBtn_1" href="List.htm"><span>女装</span></a>
                <a id="hotKeyWordBtn_2" href="List.htm"><span>化妆品</span></a>
                <a id="hotKeyWordBtn_3" href="List.htm"><span>月饼</span></a>
                <a id="hotKeyWordBtn_4" href="List.htm"><span>化妆品</span></a>
                <a id="hotKeyWordBtn_5" href="List.htm"><span>月饼</span></a>
            </div>
            <!-- 当收索框input没值时，隐藏此div， 有值则显示-->
            <ul class="landing_keywords" style="display:block;">
                <?php foreach ($goods as $value) { ?>
                    <li><a href="<?php echo base_url("sz_front/index/detail/{$value['id']}"); ?>"><i class="glyphicon glyphicon-search"></i><span><?php echo $value['name']; ?></span></a></li>
                            <?php } ?> 
            </ul>
        </div>
    </body>
</html>
