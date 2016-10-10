
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
<div>
    <?php get_messagebox(); // 获取提示框     ?>
    <!--  添加-->
    <div class="box box-radius">
        <form method="post" enctype="multipart/form-data">
            <!-- 必填项-->
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               
                <tr>
                    <td width="10%" class="tdbg"><label for="password">名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="name" id="name" class="m_inpt_border" placeholder="名称" value="<?php echo isset($goods_service['name']) ? $goods_service['name'] : $this->input->post('name'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg" style="height:90px;"><label>标识图</label></td>
                    <td width="84%" colspan="3" >
                        <input name="img" type="file"  class="x_inpt_border" style="height:25px;" />
                        <span class="span">*</span>
                        <div class="images" style="<?php echo 'display:', isset($goods_service['img']) ? 'display;' : 'none;'; ?>"><img src="<?php echo site_url(isset($goods_service['img']) ? $goods_service['img'] : $this->input->post('img')); ?>" /></div>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="remark">备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="remark" id="remark" style="width:500px;height:300px;margin:5px;"><?php echo isset($goods_service['remark']) ? $goods_service['remark'] : $this->input->post('remark'); ?></textarea>
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

