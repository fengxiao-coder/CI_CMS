<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id, 'user_name');
?>
<?php $this->load->view_part("sz_front/common/header") ?>
<link href="<?php echo base_url('theme/front/css/login.css') ?>" rel="stylesheet" type="text/css" media="all">
<script>
    $(function () {
        $(".address_row").click(function () {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            $("#consignee", parent.document).css('display', 'none');
            $("#order_address", parent.document).css('display', 'block');
            $("#testid", parent.document).val($(this).find("input")[0].value);
            $("#testid1", parent.document).html($(this).find("input")[1].value);
            $("#testid2", parent.document).html($(this).find("input")[2].value);
            $("#testid3", parent.document).html($(this).find("input")[3].value);
            parent.$.fancybox.close();
        });
    });
</script>
</head>
<body>
    <!--header start here-->
    <div class="u_header">
        <h2>收货地址</h2>
    </div>

    <div class="addresBox">
        <ul id="addressList" class="addressList">
            <?php
            foreach ($rows as $v) {
                $province = $this->user_province_model->get_value_by_pk($v['province'], "province_name");
                $city = $this->user_city_model->get_value_by_pk($v['city'], "city_name");
                $area = $this->user_area_model->get_value_by_pk($v['area'], "area_name");
                ?>
                <li style="display:block" class="address_row <?php
                if ($add_id == $v['address_id']) {
                    echo "active";
                } else {
                    echo "";
                }
                ?>">
                    <div class="font_32">
                        <label>收货人:</label> 
                        <input type="hidden" name ="address_id" value="<?php echo $v['address_id'] ?>">
                        <label name="user_name"><?php echo $v['consignee'] ?></label>
                        <input type="hidden" name = "user_name" value="<?php echo $v['consignee'] ?>">
                        <label name="phone_num" style="float: right"><?php echo $v['mobile'] ?></label>
                        <input type="hidden" name = "phone_num" value="<?php echo $v['mobile'] ?>">
                    </div>
                    <div class="font_24">
                        <label>收货地址:</label>
                        <input type="hidden" name = "address" value="<?php echo $province . $city . $area . $v['address'] ?>">
                        <label name="address"><?php echo $province . $city . $area . $v['address'] ?></label>
                    </div>
                    <span class="right_icons">
                        <i class="glyphicon glyphicon-ok"></i>
                    </span>
                </li>
            <?php } ?> 
        </ul>
    </div>
    <div class="item item_btns">
        <a class="btn_login" href="<?php echo base_url($this->_site_path . '/order_info/add_address'); ?>">新建收货地址</a>
    </div>
</body>
</html>
