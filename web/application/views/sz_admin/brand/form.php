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
<div  >
    <?php get_messagebox(); // 获取提示框    ?>
    <!--  添加-->
    <div class="box box-radius">
        <form method="post" enctype="multipart/form-data">
            <!-- 必填项-->
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               
                <tr>
                    <td width="10%" class="tdbg"><label for="">名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="brand_name" id="brand_name" class="m_inpt_border" placeholder="名称" value="<?php echo isset($brand_data['brand_name']) ? $brand_data['brand_name'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>品牌类型</label></td>
                    <td width="84%" colspan="3">&nbsp;
                        <?php foreach ($brand_category as $key => $val) { ?>
                            <label style="float:left">
                                &nbsp;<input type="checkbox"
                                <?php
                                foreach ($brand_data['category'] as $k => $v) {
                                    if ($v['cat_id'] == $val['cat_id']) {
                                        ?> checked="checked" <?php
                                                 }
                                             }
                                             ?> value="<?php echo $val['cat_id']; ?>" name="cat_id[]"><?php echo $val['cat_name']; ?>
                            </label>
                        <?php } ?>
                    </td>
                </tr> 
                <tr>
                    <td width="10%" class="tdbg"><label for="">网址</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="site_url" id="site_url" class="m_inpt_border" placeholder="请输入格式如 www.test.com 的网址" value="<?php echo isset($brand_data['site_url']) ? $brand_data['site_url'] : ''; ?>">

                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg" style="height:90px;"><label>Logo</label></td>
                    <td width="84%" colspan="3" >
                        <input name="brand_logo" type="file"  class="x_inpt_border" style="height:25px;" />
                        <span class="span">*</span>
                        <div class="images" style="<?php echo 'display:', isset($brand_data['brand_logo']) ? 'display;' : 'none;'; ?>"><img src="<?php echo site_url(isset($brand_data['brand_logo']) ? $brand_data['brand_logo'] : ''); ?>" /></div>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="">描述</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="brand_desc" id="editor_id" style="width:500px;height:300px;"><?php echo isset($brand_data['brand_desc']) ? $brand_data['brand_desc'] : ''; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="">排序</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="sort" id="sort" class="m_inpt_border" placeholder="排序" value="<?php echo isset($brand_data['sort']) ? $brand_data['sort'] : '0'; ?>">
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



