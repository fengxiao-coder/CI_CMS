<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id, 'user_name');
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<script src="<?php echo base_url('js/jquery.js') ?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/front/css/shipp.css') ?>" media="all">
<script type="text/javascript" src="<?php echo base_url('js/fancybox/lib/jquery.mousewheel.pack.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/fancybox/lib/jquery.fancybox.pack.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/fancybox/lib/jquery.fancybox.css') ?>" media="screen" />
</head>
<body>
    <!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>填写订单</h2>
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
                    });
                });</script>
            <!-- /script-for-menu -->
        </div>
        <div class="clearfix"> </div>
    </div>	
    <?php
    $address = $this->user_address_model->get_by_attributes(array('user_id' => $user_id, 'mark' => 1));
    $province = $this->user_province_model->get_value_by_pk($address['province'], "province_name");
    $city = $this->user_city_model->get_value_by_pk($address['city'], "city_name");
    $area = $this->user_area_model->get_value_by_pk($address['area'], "area_name");
    ?>
    <form method="post" id="form">
        <div class="Edit_order">
            <!-- 用户有收货地址时-->
            <div class="order_address" id="order_address" style="<?php
            if (empty($address)) {
                echo "display:none";
            } else {
                echo "display:block";
            }
            ?>">
                <div class="address_icon" id="testid4"></div>
                <div class="step1">
                    <a class="icon_more" id="check_consignee">
                        <div class="mt_new"> 
                            <input name="address_id" id="testid" type="hidden" value="<?php echo $address['address_id']; ?>" />
                            <span id="testid1"><?php echo $address['consignee']; ?></span>
                            <span id="testid2"><?php echo $address['mobile']; ?></span>
                        </div>
                        <div class="step1_inds">
                            <span id="testid3"><?php echo $province . $city . $area . $address['address'] ?></span>
                        </div>
                        <span class="s_point"></span>
                    </a>
                </div>
            </div>
            <!-- 用户未添加收货地址时-->
            <div class="item_btns alert" id="consignee" style="<?php
            if (empty($address)) {
                echo "display:block";
            } else {
                echo "display:none";
            }
            ?>">
                <div id="btn_login" class="btn_login" >新建收货地址</div>
            </div>
            <div class="order_product" id="test">  
                <?php foreach ($edit_order as $key => $single) { ?>
                    <li>
                        <div class="order_product_items">
                            <div class="items_top">
                                <div class="item_l"><img  class="cart_photo_thumb" src="<?php echo site_url($single['goods_img']); ?>"></div>
                                <div class="item_m">
                                    <p name="goods_name" class="goods_name" value="<?php echo $single['goods_name']; ?>"><?php echo $single['goods_name']; ?></p>
                                    <p name="goods_number" class="goods_number" value="<?php echo $single['goods_number']; ?>">× <?php echo $single['goods_number']; ?></p>
                                    <input name="goods_id[]" type="hidden" value="<?php echo $single['goods_id']; ?>" />
                                    <input name="goods_name[]" type="hidden" value="<?php echo $this->goods_model->get_value_by_pk($single['goods_id'], "name"); ?>" />
                                    <input name="goods_sn[]" type="hidden" value="<?php echo $this->goods_model->get_value_by_pk($single['goods_id'], "goods_sn"); ?>" />
                                    <input name="price[]" type="hidden" value="<?php echo $single['market_price']; ?>" />
                                    <input name="goods_number[]" type="hidden" value="<?php echo $single['goods_number']; ?>" />
                                    <div class="item_r" name="subtotal" value="<?php echo $single['subtotal']; ?>">￥<?php echo $single['subtotal']; ?> <span></span></div>
                                </div>
                            </div>
                            <div class="items_btt">
                                <p><span class="cell title">配送方式</span><span style=" display:block; text-align:right; margin-right:10px; color:#666"><input name="shipping_fee[]" class="msg"  value="10" type="hidden">运费：<?php echo $single['shipping_fee'] == 0.00 ? 包邮 : $single['shipping_fee']; ?></span></p>
                                <p><span class="cell title">给卖家留言</span> <input type="text" name="postscript[]" id="postscript" class="msg"  placeholder="建议填和卖家达成一致的留言" value=""></p>
                                <input type="hidden"  name="goods_attr[]" value="<?php echo $single['goods_attr']; ?>"/>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </li>
                <?php } ?> 
                <input type="hidden"  name="store_id" value="<?php echo $this->user_model->get_value_by_pk($user_id, 'store_id'); ?>"/>
            </div><!--order_product-->
        </div>
        <div class="clearing">
            <div class="shp_cart_info shp_cart_int">
                <span>共<font style="color:#F60; font-size:18px; font-weight:bold;" name="count" id="count" value="<?php echo $count; ?>"><?php echo $count; ?></font>件</span>
                <strong class="shp_total_price">实付款:<font style=" font-size:18px" name="total" id="total" value="<?php echo $total; ?>">￥<?php echo number_format($total,2); ?></font></strong>
                <input name="goods_amount" type="hidden" value="<?php echo $total; ?>" />
                <input name="shipping_fee" type="hidden" value="
                <?php
                foreach ($edit_order as $value) {
                    $shipping_fee = $shipping_fee + $value['shipping_fee'];
                }
                echo $shipping_fee;
                ?> 
                       "/>
            </div> 
            <span  id="mark" style="display:none;"></span>
            <input type="button" id="order" class="btn_right_block" style="width:35%; text-align:center" value="提交订单"/>
        </div>
    </form>
    <script type="text/javascript">
        $("#order").click(function () {
            <?php
                foreach ($edit_order as $key => $value) {
                    if ($value['goods_number'] > $this->goods_model->get_value_by_pk($value['goods_id'], "num")) {
                        $data[$key] = $this->goods_model->get_value_by_pk($value['goods_id'], "name");
                    }
                }
                $string = implode(",", $data);
            ?>
            var str = "<?php echo $string ?>";
            var address = $("#testid3").html();
            if (address) {
                if (str) {
                    alert("<?php echo $string ?>库存不足！");
                    return false;
                } else {
                    $('#form').attr('action', '<?php echo base_url("sz_front/order_info/order/") ?>');
                    $('#form').submit();
                }
            } else {
                alert("请填写收货地址!");
            }
        });

        $("#order_address").click(function () {
            var url = "<?php echo base_url($this->_site_path . "/order_info/address"); ?>?id=" + $(this).find("input").val();
            //获取采样任务列表数据
            $.fancybox({
                href: url,
                type: 'iframe',
                padding: 5
            });
        });

        $("#consignee").click(function () {
            var url = "<?php echo base_url($this->_site_path . "/order_info/add_address"); ?>";
            //获取采样任务列表数据
            $.fancybox({
                href: url,
                type: 'iframe',
                padding: 5
            });
        });
    </script>
</body>
</html>