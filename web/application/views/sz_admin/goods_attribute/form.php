<?php
$data['flag'] = 1;
$this->load->view_part($this->_site_path . "/main/breadcrumb", $data);
?>
<?php echo js("js/kindeditor/kindeditor.js"); ?>
<?php echo js("js/kindeditor/lang/zh_CN.js"); ?>
<script>
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id');
    });
</script>
<!--  添加信息页面-->

<?php get_messagebox(); // 获取提示框    ?>
<div class="box box-radius">
    <form method="post" id="form">
        <!-- 必填项-->
        <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               
            <tr>
                <td width="10%" class="tdbg"><label for="password">属性名称</label></td>
                <td width="84%" colspan="3">
                    <input type="text" name="attr_name" id="attr_name" class="m_inpt_border" placeholder="名称" value="<?php echo isset($goods_attribute_data['attr_name']) ? $goods_attribute_data['attr_name'] : $this->input->post('attr_name'); ?>">
                    <span class="span">*</span>
                </td>
            </tr>

            <tr>
                <td width="10%" class="tdbg"><label for="type_id">商品所属类别</label></td>
                <td width="84%" colspan="3">
                    <select name='type_id' class="m_inpt_border">
                        <option value='0'>---请选择---</option>
                        <?php foreach ($goods_category_data as $v): ?>
                            <option value='<?php echo $v['cat_id']; ?>' <?php if (isset($goods_attribute_data['type_id']) && $goods_attribute_data['type_id'] == $v['cat_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['cat_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td width="10%" class="tdbg"><label for="real_name">属性录入方式</label></td>
                <td width="84%" colspan="3">&nbsp;
                    <label>&nbsp;<input type="radio" id="attr_shou" <?php if (isset($goods_attribute_data['attr_input_type']) && $goods_attribute_data['attr_input_type'] == 1) { ?> checked="checked" <?php } ?> value="1" name="attr_input_type"/>&nbsp;手工录入 </label>
                    <label>&nbsp;<input type="radio" id="attr_duo" <?php if (isset($goods_attribute_data['attr_input_type']) && $goods_attribute_data['attr_input_type'] == 3) { ?> checked="checked" <?php } ?> value="3" name="attr_input_type"/>&nbsp;多选框 </label> 
                </td>
            </tr>

            <tr> 
                <td width="10%" class="tdbg"><label for="real_name">属性值</label></td>
                <td width="84%" colspan="3"  id="attr_value">
                    <input type="text" name="attr_value" id="attr" class="m_inpt_border" placeholder="红色,白色,黑色" value="<?php echo isset($goods_attribute_data['attr_value']) ? $goods_attribute_data['attr_value'] : $this->input->post('attr_value'); ?>">
                    <span class="span">*</span>
                </td>
            </tr>

            <tr>
                <td width="10%" class="tdbg"><label for="email">排序</label></td>
                <td width="84%" colspan="3">
                    <input type="text" name="sort_order" id="sort_order" class="m_inpt_border" placeholder="名称" value="<?php echo isset($goods_attribute_data['sort_order']) ? $goods_attribute_data['sort_order'] : $this->input->post('sort_order'); ?>">
                    <span class="span">*</span>
                </td>
            </tr>
        </table>
        <!--选填项-->
        <div class="control_group btn_group">
            <label class="control_label" for="body"></label>
            <div class="controls">
                <button type="button" id="tijiao" class="btn btn_style1"><span>提交</span></button>
                <button type="reset" class="btn btn_style1"><span>重置</span></button>
            </div>
        </div>
        <input type="hidden" name="is_submit" value="1">
    </form>  
    <div class="float_clear"></div>
</div>          
</div>
</div>
<script>
    $(function () {
        //$("#attr_value").css('display', 'none');
    });

    $("#attr_duo").click(function () {
        $("#attr_value").css('display', 'block');
        $(this).addClass('attr_duo');
        $("#attr_shou").removeClass('attr_shou');
    });
    
    $("#attr_shou").click(function () {
        $(this).addClass('attr_shou');
        $("#attr_duo").removeClass('attr_duo');
        $("#attr_value").css('display', 'none');
    });

    $("#tijiao").click(function () {
        var attr_duo = $("#attr_duo").hasClass("attr_duo");
        if (attr_duo) {
            var str = $("#attr").val();
            if (str) {
                $('#form').attr('action', '<?php echo base_url("sz_admin/goods_attribute/add/") ?>');
                $('#form').submit();
            }
            else {
                alert("属性值未填写！");
                return false;
            }
        } else {
            $('#form').attr('action', '<?php echo base_url("sz_admin/goods_attribute/add/") ?>');
            $('#form').submit();
        }
    });

</script>
