<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id, 'user_name');
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/shipp.css') ?>" rel="stylesheet" type="text/css" media="all">
<script src="<?php echo base_url('js/system.js') ?>"></script>
</head>
<body>
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>购物车</h2>
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
                });</script>
            <!-- /script-for-menu -->
        </div>
        <div class="clearfix"> </div>
    </div>	
    <form method="post" id="form">
        <!-- 一次循环开始-->
        <div class="shop_group_item" id="test">       
            <!--主体开始   -->    
            <ul class="shp_cart_list">
                <?php foreach ($cart_order as $key => $single) { ?>
                    <!--二次循环开始-->
                    <li name="productGroup">
                        <div class="items">
                            <div class="check_wrapper">
                                <span>
                                    <input type="checkbox" class="check" value="<?php echo $single['cart_id']; ?>" id="<?php echo $single['cart_id']; ?>" name="ids[]" />
                                    <label for="<?php echo $single['cart_id']; ?>"></label>
                                </span>
                            </div>
                            <div class="shp_cart_item_core">
                                <a class="cart_product_cell_pic" href="#"><img class="cart_photo_thumb" alt="" src="<?php echo site_url($single['goods_img']); ?>"></a>
                                <div class="car_product_cell_box">
                                    <div class="cart_product_name"><a href="#"><span><?php echo $single['goods_name']; ?></span></a></div>
                                    <div class="cart_product_price">
                                        ￥<span class="shp_cart_item_price"><?php echo $single['market_price']; ?></span>
                                    </div>
                                    <div class="quantity_wrapper" id="span">
                                        <span class="quantity_decrease">-</span>
                                        <input class="count-input quantity" name="num[]" type="text" value="<?php echo $single['goods_number']; ?>"/>
                                        <span class="quantity_increase">+</span>
                                        <span class="none error_mag"></span>
                                        <div class="clear"></div>
                                        <div class="wastebin_container"id="btn1">
                                            <a href="<?php echo base_url($this->_site_path . "/cart/delete/{$single['goods_id']}"); ?>" onClick="return confirmDelete()"><i class="wastebin_up"></i></a>
                                        </div>
                                        <input type="hidden" readonly="readonly" name="subtotal[]"  value="<?php echo $single['subtotal']; ?>"/>
                                        <input type="hidden" name ="goods_num" value="<?php echo $this->goods_model->get_value_by_pk($single['goods_id'], 'num'); ?>"/>
                                        <input type="hidden" name="goods_attr[]" value="<?php echo $single['goods_attr']; ?>"/>
                                    </div>
                                </div><!--car_product_cell_box 结束-->
                            </div><!--shp_cart_item_core 结束-->
                        </div><!--items 结束-->
                    </li>
                    <!--二次循环开始-->
                <?php } ?>   
            </ul>
        </div>
        <!-- 一次循环开始-->
        <div class="clearing" style="<?php
        if (empty($cart_order)) {
            echo "display:none";
        } else {
            echo "display:block";
        }
        ?>">

            <div class="shp_chk">
                <span class="cart_checkbox">
                    <input id="Checkbox123" type="checkbox"  class="check-all check"/>
                    <label for="Checkbox123"></label>
                </span>
                <span class="cart_checkbox_text">全选</span>
            </div>
            <div class="shp_cart_info">
                <strong class="shp_total_price  mt10">合计:￥<span class="bottom_bar_price tb3_td3" id="priceTotal">0.00</span></strong>
            </div> 
            <button type="button" id="settlement" class="btn_right_block">去结算(<span id="selectedTotal">0</span>)</button>
        </div>
        <input type="hidden" name="is_submit" value="1">
    </form>
    <div class="cart_msg" style="<?php
    if (empty($cart_order)) {
        echo "display:block";
    } else {
        echo "display:none";
    }
    ?>">
        <div class="cart_empty_pic"></div>
        <div class="cart_empty_info">
            <p class="old">购物车还是空的</p>
            <p>去挑几件喜欢的商品吧</p>
            <p class="url"><a href="<?php echo base_url("sz_front/index"); ?>">去逛逛</a></p>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    var selectInputs = $(".check"); // 所有勾选框
    var checkAllInputs = $(".check-all"); // 全选框
    var tr = $("#test li");
    var selectedTotal = $("#selectedTotal"); //已选商品数目容器
    var priceTotal = $("#priceTotal"); //总计
//    更新总数和总价格
    function getTotal() {
        var seleted = 0;
        var price = 0;
        for (var i = 0, len = tr.length; i < len; i++) {
            var trr = parseInt(tr.eq(i).find("input").eq(1).val());//商品的数目
            var t = parseInt(tr.eq(i).find("input").eq(3).val());//库存
            if (parseInt(trr) > parseInt(t)) {
                tr.eq(i).find("input").eq(1).val(trr);
                tr.eq(i).find("span").eq(5).html("很抱歉，最多只能买" + t + "件哟！！");
                tr.eq(i).find('input').get(0).checked = false;
            } else {
                tr.eq(i).find("span").eq(5).html("");
                // tr.eq(i).find('input').get(0).checked = true;
            }
            if (tr.eq(i).find('input').get(0).checked) {
                seleted += parseInt(tr.eq(i).find('input').eq(1).val());//商品的数目++
                price += parseFloat(tr.eq(i).find('input').eq(2).val());//商品的小计++
                //tr.eq(i).find('span').eq(0).addClass("checked");
            }
            else {
                tr.eq(i).className = '';
                //tr.eq(i).find('span').eq(0).removeClass("checked");
            }
        }
        selectedTotal.html(seleted);
        priceTotal.html(price.toFixed(2));

    }
//小计
    function getSubtotal(tr) {
        var price = tr.getElementsByTagName('span')[2]; //单价
        var subtotal = tr.getElementsByTagName('input')[2]; //小计td
        var countInput = tr.getElementsByTagName('input')[1]; //实际数目input
        subtotal.value = (parseInt(countInput.value) * parseFloat(price.innerHTML)).toFixed(2);//小计
        var t = parseInt(tr.getElementsByTagName('input')[3].value);//库存
        var p = tr.getElementsByTagName('span')[5];//提醒
        if (parseInt(countInput.value) > t) {
            p.innerHTML = "很抱歉，最多只能买" + t + "件哟！！";
            tr.getElementsByTagName('input')[0].checked = false;
        } else {
            p.innerHTML = "";
            tr.getElementsByTagName('input')[0].checked = true;
        }
        var goods_number = parseInt(tr.getElementsByTagName('input')[1].value);//数目
        var goods_subtotal = parseFloat(tr.getElementsByTagName('input')[2].value).toFixed(2);//小计
        var cart_id = parseInt(tr.getElementsByTagName('input')[0].value);
        var url = "<?php echo base_url('sz_front/cart/cart_updata'); ?>";
        $.post(url, {goods_subtotal: goods_subtotal, goods_number: goods_number, cart_id: cart_id}, function (str) {
        });
    }
//点击加号和减号 触发事件
    for (var i = 0; i < tr.length; i++) {
        tr[i].onclick = function (e) {
            var e = e || window.event;
            var el = e.target || e.srcElement; //通过事件对象的target属性获取触发元素
            var cls = el.className; //触发元素的class
            var countInout = this.getElementsByTagName('input')[1]; // 数目input
            var value = parseInt(countInout.value); //数目
            //通过判断触发元素的class确定用户点击了哪个元素
            switch (cls) {
                case 'quantity_increase': //点击了加号
                    countInout.value = value + 1;
                    getSubtotal(this);
                    break;
                case 'quantity_decrease': //点击了减号
                    if (value > 1) {
                        countInout.value = value - 1;
                        getSubtotal(this);
                    }
                    break;
            }
            getTotal();
        };
//直接填入数量
        tr.eq(i).find('input').eq(1).blur(function () {
            var p = $(this).parent("div").parent("div").find("span").eq(4);//提醒
            var t = parseInt($(this).parent("div").parent("div").find("input").eq(2).val());//库存
            var va = $(this).val(); // 数目input
            var reg = /^[\d]+(\.[\d]+)?$/;
            if (!reg.test(va)) {
                $(this).val(1);
                $(this).parent("div").parent("div").parent("div").siblings().children().children().get(0).checked = true;
            }
            var subtotal = $(this).parent("div").parent("div").find("input").eq(1);//小计
            var price = $(this).parent("div").parent("div").find("span").eq(1);//单价
            var countInput = $(this).parent("div").parent("div").find("input").eq(0); //个数
            subtotal.val((parseInt(countInput.val()) * parseFloat(price.html())).toFixed(2));//赋值给小计
            if (parseInt(countInput.val()) > t) {
                p.html("很抱歉，最多只能买" + t + "件哟！！");
                $(this).parent("div").parent("div").parent("div").siblings().children().children().get(0).checked = false;
            } else {
                p.html("");
                $(this).parent("div").parent("div").parent("div").siblings().children().children().get(0).checked = true;
            }
            getTotal();
            var goods_number = parseInt(countInput.val());//数目
            var goods_subtotal = parseFloat(subtotal.val()).toFixed(2);//小计
            var cart_id = parseInt($(this).parent("div").parent("div").parent("div").siblings().children().children().eq(0).val());
            var url = "<?php echo base_url('sz_front/cart/cart_updata'); ?>";
            $.post(url, {goods_subtotal: goods_subtotal, goods_number: goods_number, cart_id: cart_id}, function (str) {
            });
        });
    }
//检查是全选
    for (var i = 0; i < selectInputs.length; i++) {
        selectInputs[i].onclick = function (e) {
            if (this.className.indexOf('check-all') >= 0) { //如果是全选，则吧所有的选择框选中
                for (var j = 0; j < selectInputs.length; j++) {
                    selectInputs[j].checked = this.checked;
                }
            }
            if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) {
                    checkAllInputs[i].checked = false;
                }
            }
            getTotal();//选完更新总计
        };
    }
    checkAllInputs.get(0).checked = true;
    checkAllInputs.get(0).onclick();

    $("#settlement").click(function () {
        var val = $("#selectedTotal").html();
        //alert(val);
        if (val == '0') {
            alert("请选中商品！");
            return false;
        } else {
            $('#form').attr('action', '<?php echo base_url("sz_front/order_info/index/"); ?>');
            $('#form').submit();
        }
    });
</script>




