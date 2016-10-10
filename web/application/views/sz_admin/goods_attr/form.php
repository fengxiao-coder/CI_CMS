<?php $data['flag'] = 1;
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
<div  >
<?php get_messagebox(); // 获取提示框   ?>
    <div class="box box-radius">
        <form method="post">
            <!-- 必填项-->
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">
                <tr style="display: none">
                    <td width="10%" class="tdbg"><label for="password">商品</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="goods_id" id="goods_id" class="m_inpt_border" placeholder="名称" value="<?php echo $goods_id  ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">属性</label></td>
                    <td width="84%" colspan="3">
                      <select name="attr_id" class="m_inpt_border" >
                            <option value="">---请选择---</option>
                            <?php foreach ($goods_attribute as $v): ?>
                                <option value='<?php echo $v['attr_id']; ?>' <?php if (isset($goods_data['attr_id']) && $goods_data['attr_id'] == $v['attr_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['attr_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">属性值</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="attr_value" id="attr_value" class="m_inpt_border" placeholder="名称" value="<?php echo isset($goods_type_data['attr_value']) ? $goods_type_data['attr_value'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">属性价格</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="attr_price" id="attr_price" class="m_inpt_border" placeholder="名称" value="<?php echo isset($goods_type_data['attr_price']) ? $goods_type_data['attr_price'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
            </table>
            <!--选填项-->
            <div class="control_group btn_group">
                <label class="control_label" for="body"></label>
                <div class="controls">
                    <button type="submit" class="btn btn_style1"><span>提交</span></button>
                    <button type="reset" class="btn btn_style1"><span>重置</span></button>
                </div>
            </div>
            <input type="hidden" name="is_submit" value="1">
        </form>  
        <div class="float_clear"></div>
    </div>          
</div>
</div>



