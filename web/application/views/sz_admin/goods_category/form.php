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
                    <td width="10%" class="tdbg"><label for="password">名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="cat_name" id="cat_name" class="m_inpt_border" placeholder="名称" value="<?php echo isset($goods_category['cat_name']) ? $goods_category['cat_name'] : $this->input->post('cat_name'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">分类</label></td>
                    <td width="84%" colspan="3">
                        <select name='pid' class="m_inpt_border" >
                            <option value='0'>---请选择---</option>
                            <?php foreach ($category_data as $v): ?>
                                <option value='<?php echo $v['cat_id']; ?>' <?php if (isset($goods_category['pid']) && $goods_category['pid'] == $v['cat_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['cat_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>  
                <tr>
                    <td width="10%" class="tdbg" style="height:90px;"><label>图片</label></td>
                    <td width="84%" colspan="3" ><input name="photo" type="file"  class="m_inpt_border" /><span class="span">*</span>
                        <div class="images" style="<?php echo 'display:', isset($goods_category['photo']) ? 'display;' : 'none;'; ?>"><img src="<?php echo site_url(isset($goods_category['photo']) ? $goods_category['photo'] : ''); ?>" /></div>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="real_name">描述</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="remark" id="editor_id" style="width:500px;height:300px;"><?php echo isset($goods_category['remark']) ? $goods_category['remark'] : $this->input->post('remark'); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="email">排序</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="text" id="depth" placeholder="排序" name="sort" value="<?php echo isset($goods_category['sort']) ? $goods_category['sort'] : '0'; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
            </table>
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
    <script type="text/javascript">
        $("select[name=pid]").change(function () {
            var type_id = $("select[name=pid]").val();
            var url = "<?php echo base_url('sz_admin/goods_category/ajax_select_category'); ?>";
            $.post(url, {type_id: type_id}, function (str) {
                if (str > 2) {
                    alert('只允许有三级分类！');
                    $("select[name=pid]").val("");
                }
            });
        });
//        $("select[name=pid]").change(function () {
//            var pid = $("select[name=pid]").val();
//            var id =<?php echo $goods_category['cat_id']; ?>;
//<?php if (isset($goods_category['cat_id'])) { ?>
            //                $.ajax({
            //                    type: 'get',
            //                    url: <?php echo "'" . base_url("sz_admin/goods_category/ajax_get_tree") . "'"; ?>,
            //                    data: "id=" + id + "&pid=" + pid,
            //                    success: function (ret) {
            //                        if (ret) {
            //
            //                        } else {
            //                            alert('分类选择有误！');
            //                            $("#pid").val(<?php echo $goods_category['pid']; ?>);
            //                        }
            //                    }
            //                });
            //<?php } ?>
//            ajax_select_category();
//        });
    </script>

</div>
</div>


