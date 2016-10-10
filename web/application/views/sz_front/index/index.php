<?php
//$user = $this->session->userdata('user_name');
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id, 'user_name');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="跨境手机平台,手机购物,二维码购物">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-transform">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="layoutmode" content="standard">
        <meta name="renderer" content="webkit">
        <!--uc浏览器判断到页面上文字居多时，会自动放大字体优化移动用户体验。添加以下头部可以禁用掉该优化-->
        <meta name="wap-font-scale" content="no">
        <meta content="telephone=no" name="format-detection">
        <meta http-equiv="Pragma" content="no-cache">
        <title>跨境手机平台</title>
        <link href="<?php echo base_url('theme/front/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo base_url('theme/front/css/style.css') ?>" rel="stylesheet" type="text/css" media="all">
        <script src="<?php echo base_url('theme/front/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('theme/front/js/responsiveslides.min.js') ?>"></script>
    </head>

    <body>
        <div class="header">
            <div class="container">
                <div class="header_main">
                    <div class="logo">
                        <a href="<?php echo base_url("sz_front/search/index"); ?>"><img src="<?php echo base_url('theme/front/images/logo.png') ?> " alt=""></a>
                    </div>
                    <div class="clearfix"> </div>
                </div>	
            </div>
        </div>

        <!--banner-slider start here-->
        <div class="banner-slider clear">
            <script>
                $(function () {
                    $("#slider").responsiveSlides({
                        auto: true,
                        nav: true,
                        speed: 500,
                        namespace: "callbacks",
                        pager: true,
                    });
                });
            </script>
            <!-- 焦点图开始-->
            <div class="slider ">
                <div class="callbacks_container">
                    <ul class="rslides callbacks callbacks1" id="slider">
                        <?php foreach ($slides as $k => $single) { ?>
                            <li id="callbacks1_s<?php echo $k; ?><?php
                            if ($k = 0) {
                                echo "class='callbacks1_on'";
                            }
                            ?> " style=" position: absolute; opacity: 0; z-index: 1; display: list-item; -webkit-transition: opacity 500ms ease-in-out; transition: opacity 500ms ease-in-out;" class=""><img class="goods_view_img" src="<?php echo site_url($single['photo']); ?>" /></li>
                            <?php } ?>
                    </ul>
                </div>
            </div>
            <!-- 焦点图结束-->
            <!-- 快捷导航开始-->

            <nav class="app-nav">
                <li class="app-link">
                    <a href="<?php echo base_url("sz_front/search/index"); ?>"><div class="circle"><span class="glyphicon glyphicon-list mt" ></span></div>
                        <span class="g_mullinkFont">查询列表</span></a>
                </li>
                <li class="app-link">
                    <a href="<?php echo base_url("sz_front/goods_focus/index/"); ?>"><div class="circle bg-red"><span class="glyphicon glyphicon-heart"></span></div>
                        <span class="g_mullinkFont">我的关注</span></a>
                </li>
                <li class="app-link">
                    <a href="<?php echo base_url("sz_front/cart/index"); ?>"><div class="circle  bg-green" ><span class="glyphicon glyphicon-shopping-cart"></span></div>
                        <span class="g_mullinkFont">购物车</span></a>
                </li>
                <li class="app-link">
                    <a href="<?php echo base_url($this->_site_path . '/user/userhome') ?>"><div class="circle bg-orgen" ><span class="glyphicon glyphicon-user"></span></div>
                        <span class="g_mullinkFont">我的账户</span></a>
                </li>
                <div class="clearfix"></div>
            </nav>
            <!-- 快捷导航结束-->
        </div>
        <div  class="ondiv"></div>   
        <div class="bann">
            <div class="bann-title">
                <h1>特价产品</h1>
            </div>
            <div class="bann-info">
                <?php foreach ($special_goods as $k => $single) { ?>
                    <div class=" bann-info-grid" onclick="tiao_url('<?php echo $show_url; ?>')">
                        <a href="<?php echo base_url("sz_front/index/detail/{$single['id']}"); ?>">					
                            <center>
                                <img src="<?php echo site_url($single['photo']); ?>" alt="" class="img-responsive">
                            </center>
                        </a>
                        <div class="ban-info-details">
                            <h3><?php echo $single['name']; ?></h3>
                            <p>¥<?php echo $single['activity_price']; ?></p>
                        </div>
                    </div>
                <?php } ?>       
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="bann">
            <div class="bann-title">
                <h1>热卖产品</h1>
            </div>
            <div class="bann-info">
                <?php foreach ($hot_goods as $k => $single) {
                    ?>
                    <div class=" bann-info-grid">
                        <a href="<?php echo base_url("sz_front/index/detail/{$single['id']}"); ?>">	
                            <center>
                                <img src="<?php echo site_url($single['photo']); ?>" alt="" class="img-responsive">
                            </center>
                        </a>
                        <div class="ban-info-details">
                            <h3><?php echo $single['name']; ?></h3>
                            <p>¥<?php
                                if ($single['is_special'] == 1) {
                                    echo $single['activity_price'];
                                } else {
                                    echo $single['price'];
                                }
                                ?></p>
                        </div>
                    </div>
                <?php } ?>          
                <div class="clearfix"> </div>
            </div>
        </div>
        <footer>
            <ul class="ui_grid_b">
                <?php if ($user) { ?>
                    <li class="foottel"><p><?php echo $user; ?></p></li>
                    <li class="footmail"><a href="<?php echo base_url($this->_site_path . '/user/logout'); ?>" title="退出"><p>退出</p></a></li>
                <?php } else { ?>
                    <li class="foottel"><a href="<?php echo base_url($this->_site_path . '/user/register'); ?>" title="用户注册"><p>注册</p></a></li>
                    <li class="footmail"><a href="<?php echo base_url($this->_site_path . '/user/login'); ?>" title="用户登录"><p>登录</p></a></li>
                <?php } ?>
                <li class="footmap "><a href="<?php echo base_url($this->_site_path . '/index/suggest'); ?>" title="意见反馈"><p>意见反馈</p></a></li>
                <li class="footmap " style="border:0"><a href="<?php echo base_url($this->_site_path . '/user/userhome'); ?>" title="我的账户"><p>我的账户</p></a></li>
            </ul>
        </footer>
    </body>
</html>




