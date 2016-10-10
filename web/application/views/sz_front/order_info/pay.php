<?php $this->load->view_part("sz_front/common/header") ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });
        </script>
        <link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo base_url('theme/front/css/shipp.css') ?>" rel="stylesheet" type="text/css" media="all">


    </head>
    <body>
        <!--header start here-->
        <div class="u_header">
            <a href="javascript:history.go(-2)" class="new_a_back"><span>返回</span></a>
            <h2>在线支付</h2>
            <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
        </div>
        <div class="header-main">
            <div class="top-nav">
                <ul class="nav nav-pills nav-justified res">
                    <li><a class="active no-bar" href="<?php echo base_url("sz_front/index"); ?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
                    <li><a href="<?php echo base_url("sz_front/search/index"); ?>"><i class="glyphicon glyphicon-search"> </i>分类收索</a></li>
                    <li><a href="<?php echo base_url("sz_front/cart/index"); ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>购物车</a></li>
                    <li><a href="<?php echo base_url($this->_site_path . '/user/userhome') ; ?>"><i class="glyphicon glyphicon-user"> </i>我的账户</a></li>
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
        <div class="payment">
            <div class="order_bar">
                <span class="pay_tip">请选择支付方式</span>
                <span class="pay_total"><?php echo number_format($pay_total,2); ?>元</span>
            </div>
            <ul class="pay_list">
                <li class="list_item">
                    <a href="OnlinePayment_1.htm" class="list_link">
                        <img class="pay_pic" src="../images/zs_blnk.png"> 
                        <span class="pay_icon"></span>
                        <span class="title_main">招商银行</span>
                    </a>
                </li>
                <li class="list_item">
                    <a href="OnlinePayment_1.htm" class="list_link">
                        <img class="pay_pic" src="../images/js_blnk.png"> 
                        <span class="pay_icon"></span>
                        <span class="title_main">建设银行</span>
                    </a>
                </li>
                <li class="list_item">
                    <a href="#" class="list_link">
                        <img class="pay_pic" src="../images/jt_blnk.png">
                        <span class="pay_icon"></span>
                        <span class="title_main">交通银行</span>
                    </a>
                </li>
                <li class="list_item">
                    <a href="#" class="list_link">
                        <img class="pay_pic" src="../images/gs_blnk.png">
                        <span class="pay_icon"></span>
                        <span class="title_main">工商银行</span>
                    </a>
                </li>
            </ul>
        </div>

    </body>
</html>
