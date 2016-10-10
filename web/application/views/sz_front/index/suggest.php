<?php $this->load->view_part("sz_front/common/header") ?>
</head>
<body>
    <!--header start here-->
    <div class="u_header">
        <a href="javascript:history.go(-1)" class="new_a_back"><span>返回</span></a>
        <h2>意见反馈</h2>
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
    <form method="post" name="form1" onsubmit="return checkInfo();" id="form">
        <div class="feedback">
            <ul>
                <li class="title">关于跨境电商平台（手机版）相关问题，请填写以下表格</li>
                <li><span>手机类型：</span> 
                    <input type="text" name="phone_type" id="phone_type" class="m_inpt_border" placeholder="手机类型" value="<?php echo isset($goods_data['phone_type']) ? $goods_data['phone_type'] : $this->input->post('phone_type'); ?>">
                </li>
                <li><span>反馈类型：</span>
                    <select name="feedback_type">
                        <option value="" selected="selected">请选择</option> 
                        <option value="功能意见">功能意见</option>
                        <option value="界面意见">界面意见</option>
                        <option value="您的新需求">您的新需求</option>
                        <option value="操作意见">操作意见</option>
                        <option value="其他">其他</option>
                    </select>
                </li>  
                <li><span>反馈内容：</span>
                    <textarea name="feedback_content" id="feedback_content" placeholder="有什么想说的，尽管来吐槽吧~" maxlength="250"><?php echo isset($goods_data['feedback_content']) ? $goods_data['feedback_content'] : $this->input->post('feedback_content'); ?></textarea>

                </li> 
                <li><span>联系方式： </span><input type="text" name="phone_number" id="phone_number" class="m_inpt_border" placeholder="联系方式" value="<?php echo isset($goods_data['phone_number']) ? $goods_data['phone_number'] : $this->input->post('phone_number'); ?>"><div id="div" style="color:#ff0000; font-size:12px"></div></li>    
            </ul>
            <div class="item_btns">
                <button type="button" id="tijiao" class="btn btn_login">确定</button>
            </div>
        </div>
        <input type="hidden" name="is_submit" value="1">
    </form> 
    <?php $this->load->view_part("sz_front/common/footer") ?>
    <script type="text/javascript">
        //验证手机格式
        $("input[name=phone_number]").blur(function () {
            var phone = $(this).val();
            var isMob = /^1[3-5,8]{1}[0-9]{9}$/;
            var isTel = /^0\d{2,3}-?\d{7,8}$/;
            if (!isMob.test(phone) && !isTel.test(phone)) {
                alert('电话格式不正确!');
                $(this).val("");
            }
        });

        $("#tijiao").click(function () {
            if (checkInfo()) {
                $.ajax({
                    type: "post",
                    url: '<?php echo base_url("sz_front/index/suggest/"); ?>',
                    data: $("#form").serialize(),
                    success: function (msg) {
                        if (msg) {
                            alert("提交成功");
                            $("#form")[0].reset();
                        } else {
                            alert("提交失败");
                        }
                    }
                });
            } else {
                return false;
            }
        });

        function checkInfo() {
            //验证表单是否有空值
            for (var i = 0; i < document.form1.elements.length - 2; i++) {
                if (document.form1.elements[i].value == "") {
                    alert("请填写完整的信息");
                    document.form1.elements[i].focus();
                    return false;
                }
            }
            return true;
        }
    </script>




