<?php
$province = $this->user_province_model->get_value_by_pk($address['province'], "province_name");
$city = $this->user_city_model->get_value_by_pk($address['city'], "city_name");
$area = $this->user_area_model->get_value_by_pk($address['area'], "area_name");
?>

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

<script type="text/javascript">
    (function ($) {
        $("#check_consignee").click(function () {
            var url = "<?php echo base_url($this->_site_path . "/order_info/address"); ?>?id=" + $(this).find("input").val();
            //获取采样任务列表数据
            $.fancybox({
                href: url,
                type: 'iframe',
                padding: 5
            });
        });
    })(jQuery);
</script>
