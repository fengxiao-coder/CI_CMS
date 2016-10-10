<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id, "user_name");
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<script src="<?php echo base_url('theme/front/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('theme/front/js/responsiveslides.min.js') ?>"></script>       
<script src="<?php echo base_url('theme/front/js/js.js') ?>"></script> 
<script>
    $(function () {
        if ($('#num').html() === "缺货") {
            $(".text_box").val(0);
        }
        // $("#pan").html($(".text_box").val());
        $("#slider").responsiveSlides({
            auto: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            pager: true
        });
    });
    var obj = {
        colorSpan: "",
        sizeSpan: ""
    };
    function change(i)
    {
        $('i[name="' + $(i).attr('name') + '"]').each(function () {
            if (this.checked && this !== i)
            {
                this.className = "";
                this.checked = false;
            }
        });
        obj[$(i).attr('name')] = i.innerHTML;
        // alert();
        i.className = "check";
        i.checked = true;
        select();
    }
    function select()
    {
        var html = '';
        var str = '';
        for (var i in obj)
        {
            if (obj[i] !== '')
            {
                str += obj[i] + '、';
                html = str.substring(0, str.length - 1);
            }
        }
        html = html.slice(0, html.length);
        // html = html.slice(0, html.length);
        $('#resultSpan').html(html);
    }
</script>

</head>
<body>
    <!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>商品详情</h2>
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
        </div>
        <div class="clearfix"> </div>
    </div>	
    <!--banner-slider start here-->
    <div class="slider ">
        <div class="callbacks_container">
            <ul class="rslides callbacks callbacks1" id="slider">
                <?php foreach ($goods_photo as $key => $value) { ?>
                    <li id="callbacks1_s<?php echo $key; ?>" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; -webkit-transition: opacity 500ms ease-in-out; transition: opacity 500ms ease-in-out;" class="">
                        <img src="<?php echo site_url($value['photo']); ?>" alt="" class="img-responsive">
                    </li>
                <?php } ?> 

            </ul>
        </div>
    </div>

    <div class="detail">
        <div class="title"><?php echo $goods_data['name']; ?></div>
        <div class=" price pull-left">
            <span>原价：<?php echo $goods_data['original_price']; ?>元</span>
            <?php if ($goods_data['shipping_fee'] == 0): ?>
                <span>卖家包邮</span>
            <?php else : ?>
                <span>邮费&nbsp;<?php echo $goods_data['shipping_fee']; ?>元</span>
            <?php endif ?>   
        </div>
        <div class="pull-right">
            <div class="price-bg">
                <span class="font-size">¥<?php
                    if ($goods_data['is_special'] == 1) {
                        echo $goods_data['activity_price'];
                    } else {
                        echo $goods_data['price'];
                    }
                    ?></span>
            </div>
        </div>
        <div style="clear:both;"></div>
        <form  id="temp" name="temp" method=post>
            <div class="list_entry">
                <div class="row01"><div id="cool" style="display:none">规格：<span id='resultSpan'></span><span id='pan'></span><?php //echo $this->config_model->get_value_by_pk($goods_data['item_unit'], 'value');                        ?></div>
                </div>
                <div class="row02" id="row02">
                    <div id="addr1">
                        <?php foreach ($goods_attr as $key => $value) { ?>
                            <div class="dgscp_c">
                                <h3 ><?php echo $this->goods_attribute_model->get_value_by_pk($key, 'attr_name'); ?></h3>
                                <p class="dgsc_pc">
                                    <?php foreach ($value as $key1 => $single) { ?> 
                                        <i class='unchecked'  name='<?php echo $key; ?>' checked='false' onclick='change(this);' ><?php echo $single['attr_value'] ?></i>
                                    <?php } ?> 
                                </p>
                                <div class=" clear"></div>
                            </div>
                        <?php } ?>    
                    </div>
                    <div class="quantity_num_input">
                        <div class="title margin">数量</div>
                        <div class="quantity_wrapper">
                            <ul>
                                <input class="quantity_decrease min" id="4" value="-" type="button">
                                <input type="text" class="quantity text_box" size="12" onChange="" value="1" name="num" >
                                <input class="quantity_increase add" id="5" value="+" type="button">
                            </ul>
                            <span style="margin:3px 0 0 10px;"><?php
                                if ($goods_data['num'] == '0') {
                                    echo "<span id='num'>缺货</span>";
                                } else {
                                    echo "库存: ";
                                    echo "<span id='num'>";
                                    echo $goods_data['num'];
                                    echo "</span>";
                                    echo $this->config_model->get_value_by_pk($goods_data['item_unit'], 'value');
                                }
                                ?></span>
                        </div>
                    </div>
                    <span id="ts" style="float:left"></span>
                </div>
            </div>
            <input type="hidden" name="attr" value="" id="attri">
            <input type="hidden" name="is_submit" value="1">
        </form>
        <div class="row02 ">
            <span class="col01 ">提示：</span>
            <?php foreach ($service as $value) { ?>
                <span class="col02" id="fareMoney"><img src="<?php echo site_url($value['img']); ?>" width="15" height="15" > <?php echo $value['name']; ?> </span>
            <?php } ?> 
        </div>

        <!-- 代码 开始 -->
        <div class="wrap">
            <ul id="tag">
                <li class="current" >商品介绍</li>
                <li>商品参数</li>
                <li class="good">商品评价</li>
            </ul>
            <!-- tagContent-->
            <div id="tagContent">
                <div class="desc_info" style="display:block;">
                    <ul class="rslides">
                        <?php echo $goods_data['detail']; ?>
                    </ul>
                </div>
                <div class="desc_info">
                    <ul class="desc">
                        <?php foreach ($goods_par as $value) { ?>
                            <li><?php echo $this->goods_attribute_model->get_value_by_pk($value['attr_id'], 'attr_name'); ?>：<?php echo $value['attr_value']; ?></li>
                        <?php } ?>                       
                    </ul>
                </div>
                <div class="desc_info">
                    <div class="tabItems">
                        <div class="tab_item"  style="display:block;">
                            <div class="app_count">
                                <span class="good">好评（<?php echo $good_evaluation; ?>）</span>
                                <span class="medium">中评（<?php echo $medium_evaluation; ?>）</span>
                                <span class="bad">差评（<?php echo $bad_evaluation; ?>）</span>
                            </div>
                            <div id="duoduo"></div>

                        </div><!--tab-item-->
                    </div>
                </div>
            </div>
            <!--tagContent-->
        </div>
    </div>

    <!-- 代码 结束 -->
    <div class="footer">
        <ul class="ui_grid_b">
            <?php if ($user) { ?>
                <li class="foottel"><p><?php echo $user; ?></p></li>
                <li class="footmail"><a href="<?php echo base_url($this->_site_path . '/user/logout'); ?>" title="退出"><p>退出</p></a></li>
            <?php } else { ?>
                <li class="foottel"><a href="<?php echo base_url($this->_site_path . '/user/register'); ?>" title="用户注册"><p>注册</p></a></li>
                <li class="footmail"><a href="<?php echo base_url($this->_site_path . '/user/login'); ?>" title="用户登录"><p>登录</p></a></li>
            <?php } ?>  
            <li class="footmap"><a href="<?php echo base_url($this->_site_path . '/index/suggest'); ?>" title="意见反馈"><p>意见反馈</p></a></li>
            <li class="footmap " style="border:0"><a href="" title="置顶"><p>置顶</p></a></li>
        </ul>
    </div>
    <footer>
        <ul class="ui_grid_b">
            <li class="foottel"><a href="<?php echo base_url($this->_site_path . "/goods_focus/add/{$goods_data['id']}"); ?>" title="收藏"><p>收藏</p></a></li>
            <li class="footmail"><a href="<?php echo base_url($this->_site_path . "/cart/index/"); ?>" title="购物车"><p><span class="glyphicon glyphicon-shopping-cart"></span>(<font ><?php echo isset($count) ? $count : '0'; ?></font>)</p></a></li>
            <li class="btn-buy "><input class="btn_right_block" type=button value="加入购物车"></li>
            <li class="btn-cart " style="border:0"><input class="btn_left_block"  type=button value="立即购买"></li>
        </ul>
    </footer>
</body>
</html>

<script type="text/javascript">
    var t = $("input[name=num]");
    var r = $('#num');
//判断数量
    $("input[name=num]").blur(function () {
        var num = t.val();
        var reg = /^[\d]+(\.[\d]+)?$/;
        if (!reg.test(num)) {
            t.val(1);
        }
        if (parseInt(t.val()) > parseInt(r.html())) {
            alert("您的宝贝数量超过库存");
            t.val(1);
        }

    });
//显示规格
    $(".unchecked").click(function () {
        $("#cool").css('display', 'block');
    });
//商品加
    $(".add").click(function () {
        if ((t.val() > r.html() - 1) || (r === "缺货")) {
            alert("您的宝贝数量超过库存");
        } else {
            t.val(parseInt(t.val()) + 1);
        }
    });
//商品减
    $(".min").click(function () {
        t.val(parseInt(t.val()) - 1);
        if (parseInt(t.val()) < 1) {
            t.val(1);
        }
    });
//右侧菜单
    $("div.header_icon").click(function () {
        $("ul.res").slideToggle(300, function () {
        });
    });
//右上角菜单
    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });
//加入购物车
    $(".btn_right_block").click(function () {
        var a = $('#resultSpan').text();
        var result = a.split("、").length;
        var str = $('div[class="dgscp_c"]').length;

        if (parseInt(t.val()) > parseInt(r.html())) {
            alert("您的宝贝数量超过库存");
        } else {
            if (result < str || (!a && str !== 0)) {
                alert("请选择属性");
            } else {
                var url = "<?php echo base_url("sz_front/cart/add_cart/{$goods_data['id']}"); ?>";
                $('#attri').val(a);
                $('#temp').attr('action', url);
                $('#temp').submit();
            }
        }
    });
//直接购买
    $(".btn_left_block").click(function () {
        var a = $('#resultSpan').text();
        var result = a.split("、").length;
        var str = $('div[class="dgscp_c"]').length;
        if (parseInt(t.val()) > parseInt(r.html())) {
            alert("您的宝贝数量超过库存");
        } else {
            if (result < str || (!a && str !== 0)) {
                alert("请选择属性");
            } else {
                var url = "<?php echo base_url("sz_front/order_info/imme/{$goods_data['id']}"); ?>";
                $('#attri').val(a);
                $('#temp').attr('action', url);
                $('#temp').submit();
            }
        }
    });
//制作函数(ajax去获得分页信息)
    function showpage(url) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                document.getElementById('duoduo').innerHTML = xhr.responseText;
            }
        };
        xhr.open('get', url);
        xhr.send(null);
    }
//好评
    $(".good").click(function () {
        $(".good").siblings().removeClass("old");
        $(".good").addClass("old");
        $.ajax({
            type: 'get', //可选get
            url: '<?php echo base_url("sz_front/index/evaluation"); ?>', //这里是接收数据的程序
            data: "goods_id=" +<?php echo $goods_data['id']; ?> + "&evaluation=0",
            dataType: 'html', //服务器返回的数据类型 可选XML ,Json jsonp script html text等
            success: function (msg) {
                $("#duoduo").html(msg);
            },
            error: function () {
                alert('对不起失败了');
            }
        });
    });
//中评
    $(".medium").click(function () {
        $(this).siblings().removeClass("old");
        $(this).addClass("old");
        $.ajax({
            type: 'get', //可选get
            url: '<?php echo base_url("sz_front/index/evaluation"); ?>', //这里是接收数据的程序
            data: "goods_id=" +<?php echo $goods_data['id']; ?> + "&evaluation=1",
            dataType: 'html', //服务器返回的数据类型 可选XML ,Json jsonp script html text等
            success: function (msg) {
                $("#duoduo").html(msg);
            },
            error: function () {
                alert('对不起失败了');
            }
        });
    });
//差评
    $(".bad").click(function () {
        $(this).siblings().removeClass("old");
        $(this).addClass("old");
        $.ajax({
            type: 'get', //可选get
            url: '<?php echo base_url("sz_front/index/evaluation"); ?>', //这里是接收数据的程序
            data: "goods_id=" +<?php echo $goods_data['id']; ?> + "&evaluation=2",
            dataType: 'html', //服务器返回的数据类型 可选XML ,Json jsonp script html text等
            success: function (msg) {
                $("#duoduo").html(msg);
            },
            error: function () {
                alert('对不起失败了');
            }
        });
    });
</script>