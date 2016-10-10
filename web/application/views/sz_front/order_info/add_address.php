<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
</head>
<script type="text/javascript">
    $(function () {
        $("#language").change(function () {
            //alert($(this).val());
            $.ajax({
                type: "get",
                url: "<?php echo base_url($this->_site_path . '/user/getcity'); ?>?random=" + Math.random() + "&oneid=" + $(this).val(),
                dataType: "html",
                success: function (data) {
                    $("#language1").html(data);
                }
            });
        });

        $("#language1").change(function () {
            $.ajax({
                type: "get",
                url: "<?php echo base_url($this->_site_path . '/user/getarea'); ?>?random=" + Math.random() + "&cityid=" + $(this).val(),
                dataType: "html",
                success: function (data) {
                    $("#language2").html(data);
                }
            });
        });

    });
</script>
<body>
    <!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>新建收货地址</h2>
        <div class="header_icon"><span class="glyphicon glyphicon-list-alt"></span></div>
    </div>
    <div class="header-main">
        <div class="top-nav">
            <ul class="nav nav-pills nav-justified res">
                <li><a class="active no-bar" href="<?php echo base_url($this->_site_path . '/index/index'); ?>"><i class="glyphicon glyphicon-home"> </i>首页</a></li>
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
    <form name="form1" action="<?php echo base_url($this->_site_path . '/order_info/do_addr') . "/" . $id; ?>" method="post" onsubmit="return checkInfo();">
        <div class="user main" >
            <ul>
                <li><span>收货人姓名</span><input class="txt_input" name="consignee" value=""></li> 
                <li><span>手机号码</span><input id="userTel" class="txt_input" name="mobile" value=""><div id="div" style="color:#ff0000; font-size:12px"></div></li>
                <li><span style="font-size:18px; font-weight:bold;">收货地址</span></li> 
            </ul>
        </div>
        <div class="user_select">
            <div class="user_select_01">
                <span class="uboxstyle_name">省份</span>
                <div id="uboxstyle" class="uboxstyle">
                    <select id="language" name="province">
                        <option value="-1">请选择</option>
                        <?php foreach ($pro_arr as $v) { ?>
                            <option value="<?php echo $v['id']; ?>"><?php echo $v['province_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="user_select_01">
                <span class="uboxstyle_name">城市</span>
                <div id="uboxstyle1" class="uboxstyle">
                    <select id="language1" name="city" >
                        <option value="">请选择</option>       
                    </select>  
                </div>
            </div>
            <div class="user_select_01">
                <span class="uboxstyle_name">区县</span>
                <div id="uboxstyle2" class="uboxstyle">
                    <select id="language2" name="area">
                        <option id="" value="">请选择</option>      
                    </select>  
                </div>
            </div>
            <!-- 街道地址-->
            <div class="new_tbl_type">
                <span class="new_tbl_cell new_txt_w38">街道</span>
                <span class="new_tbl_cell">
                    <div class="new_post_wr">
                        <textarea name="address" id="address_where" rows="5" cols="30" title="" class="new_textarea"></textarea>
                    </div>
                </span>                        
            </div>
            <div class="item item_btns">
                <input type="button" value="确定" id="fb_close"  class="btn_login">
            </div>
        </div>
    </div>
</form>
</body>
</html>

<script type="text/javascript">

    $("#fb_close").click(function () {
        var consignee = $("input[name=consignee]").val();
        var mobile = $("input[name=mobile]").val();
        var province = $("select[name=province]").val();
        var city = $("select[name=city]").val();
        var area = $("select[name=area]").val();
        var address = $("#address_where").val();
        $.post('<?php echo base_url('sz_front/order_info/do_addr') ?>', {'consignee': consignee, 'mobile': mobile, 'province': province, 'city': city, 'area': area, 'address': address}, function (dat) {
            $("#consignee", parent.document).css('display', 'none');
            $("#order_address", parent.document).css('display', 'block');
            $("#order_address", parent.document).html(dat);
            parent.$.fancybox.close();
        });
    });


    function checkInfo() {
        //验证表单是否有空值
        for (var i = 0; i < document.form1.elements.length - 1; i++) {
            if (document.form1.elements[i].value == "") {
                alert("请填写完整的信息");
                document.form1.elements[i].focus();
                return false;
            }
        }
    }

    //验证手机格式
    $("#userTel").blur(function () {
        var phone = $(this).val();
        var isMob = /^1[3-5,8]{1}[0-9]{9}$/;
        var isTel = /^0\d{2,3}-?\d{7,8}$/;
        if (!isMob.test(phone) && !isTel.test(phone)) {
            $("#div").css('display', 'block');
            $("#div").html("请输入正确的手机号码");
            $(this).val("");
        } else {
            $("#div").css('display', 'none');
        }
    });
</script>