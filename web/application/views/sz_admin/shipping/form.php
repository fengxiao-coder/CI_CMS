<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<div  >
<?php get_messagebox();// 获取提示框 ?>
<div class="box box-radius">
	<form method="post">
		<table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               

                <tr>
                    <td width="10%" class="tdbg"><label for="password">配送名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="shipping_name" class="m_inpt_border"  value="<?php echo $shipping_data['shipping_name']?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">配送描述</label></td>
                    <td width="84%">
                    <textarea name="shipping_desc" class="textarea_border"><?php echo $shipping_data['shipping_desc']?></textarea>
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

    </div>


