<?php $data['flag'] = 1;
$this->load->view_part($this->_site_path . "/main/breadcrumb", $data);
?>
<!--  添加信息页面-->
<div>
<?php get_messagebox(); // 获取提示框   ?>

    <div class="box box-radius">
        <form method="post" enctype="multipart/form-data">
            <!-- 必填项-->
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">
                <tr>
                    <td width="10%" class="tdbg"><label for="password">名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="adv_title" id="name" class="m_inpt_border" placeholder="名称" value="<?php echo isset($adv_data['adv_title']) ? $adv_data['adv_title'] : $this->input->post('adv_title'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">广告链接</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="adv_url" id="name" class="m_inpt_border" placeholder="广告链接" value="<?php echo isset($adv_data['adv_url']) ? $adv_data['adv_url'] : $this->input->post('adv_url'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">广告内容</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="adv_content" id="name" class="m_inpt_border" placeholder="广告内容" value="<?php echo isset($adv_data['adv_content']) ? $adv_data['adv_content'] : $this->input->post('adv_content'); ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">幻灯片排序</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="sort" id="name" class="m_inpt_border" placeholder="幻灯片排序" value="<?php echo isset($adv_data['sort']) ? $adv_data['sort'] : $this->input->post('sort'); ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg" style="height:90px;"><label>广告图片</label></td>
                    <td width="84%" colspan="3" ><input name="photo" type="file"  class="x_inpt_border"  /><span class="span">*</span>
                        <div class="images" style="<?php echo 'display:', isset($adv_data['photo']) ? 'block' : 'none'; ?>"><img style="width:100px;height:70px;" src="<?php echo site_url(isset($adv_data['photo']) ? $adv_data['photo'] : ''); ?>" /></div>
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
