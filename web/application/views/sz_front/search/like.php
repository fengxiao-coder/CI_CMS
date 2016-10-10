<?php $this->load->view_part("sz_front/common/header") ?>
<script src="<?php echo base_url('theme/front/js/js.js') ?>"></script>
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
        <ul id="tag">
            <li class="current" ><a href=""style="display:block;">综合</a></li>
            <li>销量</a></li>
            <li>价格</li>
        </ul>
        <!--点击筛选弹出tag_showbox-->
        <div class="tag_box"><a href="">筛选</a></div>
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
        <!--点击筛选弹出tag_showbox-->
        <form method="post" action="<?php echo base_url("sz_front/search/lists") . "/" . $id; ?>">
            <div class="tag_showbox"  style="display:none">
                <div class="top">筛选<a class="cancel_btn" >取消</a>
                    <button type="submit" class="btn btn_style1"><span>确定</span></button>
                </div>
                <ul class="body" id="masterdiv">
                    <li class="menutitle" onClick="SwitchMenu('sub1')">
                        <a id="" href="javascript:void(0);">
                            <i class="arrow"></i>
                            <span> 品牌</span>
                            <small class="sort_of_brand">全部</small>
                        </a>
                    </li>
                    <div class="submenu" id="sub1">
                        <ul class="tab_con">
                            <li class="checked">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <span>全部</span>
                            </li>
                            <?php foreach ($brand_data as $k => $single) { ?>
                                <li class="">
                                    <i class="tick glyphicon glyphicon-ok"></i>
                                    <input name="brand_id" type="radio" value="<?php echo $single['brand_id']; ?>" /><span><?php echo $single['brand_name']; ?></span>
                                </li>
                            <?php } ?> 

                        </ul>
                    </div>
                    <li class="menutitle" onClick="SwitchMenu('sub2')">
                        <a id="" href="javascript:void(0);">
                            <i class="arrow"></i>
                            <span>价格</span>
                            <small class="sort_of_brand">全部</small>
                        </a>
                    </li>
                    <div class="submenu" id="sub2">
                        <ul class="tab_con">
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <span>全部</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input name="price_search" type="radio" value="0-100" /><span>0-100</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok "></i>
                                <input name="price_search" type="radio" value="101-200" /><span>101-200</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input name="price_search" type="radio" value="201-300" /><span>201-300</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input name="price_search" type="radio" value="301-400" /><span>301-400</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input name="price_search" type="radio" value="401-500" /><span>401-500</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input name="price_search" type="radio" value="501-60" /><span>501-600</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input name="price_search" type="radio" value="1000" /><span>1000以上</span>
                            </li>
                            <li class="">
                                <i class="tick glyphicon glyphicon-ok"></i>
                                <input name="price_search" type="radio" value="2000" /><span>2000以上</span>
                            </li>
                        </ul>

                    </div>

                    <!--                        <li class="menutitle" onclick="SwitchMenu('sub3')">
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
            <?php foreach ($goods as $value) { ?>
                <li>
                    <a style=" text-decoration:none;" href="<?php echo base_url("sz_front/index/detail/{$value['id']}"); ?>" class="J_ping">
                        <div class="list_thumb"><img width="85" height="85" src="<?php echo site_url($value['photo']); ?>"></div>
                        <div class="list_descriptions">
                            <div class="list_descriptions_wrapper">
                                <div class="product_name"><?php echo $value['name']; ?></div>
                                <div class="price_spot"><span class="product_price">￥<span><?php echo $value['price']; ?></span></span></div>
                                <div class="reputation"><span class="ratings">97%好评(14278人)</span></div>
                             </div>
                         </div>
                     </a>
                </li>
            <?php } ?> 
        </ul>

        <ul class="list_body" style="display:none;">
            <?php foreach ($sales as $value) { ?>
                <li>
                    <a style=" text-decoration:none;" href="<?php echo base_url("sz_front/index/detail/{$value['id']}"); ?>" class="J_ping">
                        <div class="list_thumb"><img width="85" height="85" src="<?php echo site_url($value['photo']); ?>"></div>
                        <div class="list_descriptions">
                            <div class="list_descriptions_wrapper">
                                <div class="product_name"><?php echo $value['name']; ?></div>
                                <div class="price_spot"><span class="product_price">￥<span><?php echo $value['price']; ?></span></span></div>
                                <div class="reputation"><span class="ratings">97%好评(14278人)</span></div>
                            </div>
                        </div>
                    </a>
                </li>
            <?php } ?> 
        </ul> 

        <ul class="list_body" style="display:none;">
            <?php foreach ($price as $value) { ?>
                <li>
                    <a style=" text-decoration:none;" href="<?php echo base_url("sz_front/index/detail/{$value['id']}"); ?>" class="J_ping">
                        <div class="list_thumb"><img width="85" height="85" src="<?php echo site_url($value['photo']); ?>"></div>
                        <div class="list_descriptions">
                            <div class="list_descriptions_wrapper">
                                <div class="product_name"><?php echo $value['name']; ?></div>
                                <div class="price_spot"><span class="product_price">￥<span><?php echo $value['price']; ?></span></span></div>
                                <div class="reputation"><span class="ratings">97%好评(14278人)</span></div>
                            </div>
                         </div>
                     </a>
                </li>
            <?php } ?> 
        </ul> 

        <ul class="list_body" style="display:none;">
            <?php foreach ($price as $value) { ?>
                <li>
                    <a style=" text-decoration:none;" href="<?php echo base_url("sz_front/index/detail/{$value['id']}"); ?>" class="J_ping">
                        <div class="list_thumb"><img width="85" height="85" src="<?php echo site_url($value['photo']); ?>"></div>
                        <div class="list_descriptions">
                            <div class="list_descriptions_wrapper">
                                <div class="product_name"><?php echo $value['name']; ?></div>
                                <div class="price_spot"><span class="product_price">￥<span><?php echo $value['price']; ?></span></span></div>
                                <div class="reputation"><span class="ratings">97%好评(14278人)</span></div>
                            </div>
                        </div>
                     </a>
                </li>
            <?php } ?> 
        </ul> 
    </div>
    <?php echo $pagination; ?>
    <?php $this->load->view_part("sz_front/common/footer") ?>
