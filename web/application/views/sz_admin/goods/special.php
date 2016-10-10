
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css'); ?>" media="print"/>
<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <form method="post" action="<?php echo base_url($this->_site_path . "/goods/special_edit"); ?>" id="form">
                <div class="list_box">
                    <table id="tb" class="table table-striped table-condensed table-bordered">
                        <thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>名称</th>
                                <th>特价</th>
                                <th>品牌</th>
                                <th>库存</th>
                            </tr>
                        </thead>
                        <?php foreach ($goods_data as $k => $single) { ?>
                            <!--  鼠标悬停，整行变色，-->
                            <tr>
                                <td>
                                    <input name="id[]" class="check" value="<?php echo $single['id']; ?>" type="checkbox"  tagname="<?php echo $single['tagname']; ?>" en_name="<?php echo $single['en_name']; ?>" goods_sn="<?php echo $single['goods_sn']; ?>" codeContent="<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>"/>
                                </td>
                                <td  class="align_left" style="cursor:pointer;cursor:hand"><?php echo $single['name']; ?></td>
                                <td style="cursor:pointer;cursor:hand"><input class="activity_price" type="text" name="activity_price[]" value="<?php echo $single['activity_price']; ?>">&nbsp;<?php echo $this->config_model->get_value_by_pk($single['coin_unit'], 'value'); ?></td>
                                <td style="cursor:pointer;cursor:hand">
                                    <?php echo $this->brand_model->get_value_by_pk($single['brand_id'], 'brand_name'); ?> 
                                </td>
                                <td  class="align_left" style="cursor:pointer;cursor:hand"><?php echo $single['num']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['item_unit'], 'value'); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div id="test"></div>
                <div class="tips">
                    <div class="float_left">
                        <input type="submit" value="提交" class="cencle btn_style1">
                    </div>
                    <?php echo $pagination; ?>
                </div>
                <input type="hidden" name="is_submit" value="1">
            </form>

        </div>
    </div>
</div>   
<script>
    $(function () {
        $('.check').attr('checked', true);
    });

    $(".activity_price").blur(function () {
        var price = $(this).val();
        var reg = /^(0|[1-9][0-9]{0,9})(\.[0-9]{1,2})?$/;
        if (!reg.test(price)) {
            alert('价格不合法，请重新输入！');
            $(this).val("0");
        }
    });

    $('.cencle').click(function () {
        $('#form').attr('action', '<?php echo base_url($this->_site_path . "/goods/special_edit"); ?>');
        $('#form').submit();
        parent.$.fancybox.close();
        parent.window.location.href = parent.window.location.href;
    });


    $('input[name=checkAll]').click(function () {
        if ($(this).attr("checked") == 'checked') {
            $('.check').attr('checked', true);
        } else {
            $('.check').removeAttr('checked');
        }
    });

</script>
