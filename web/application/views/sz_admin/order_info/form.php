<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<div  >
<?php get_messagebox();// 获取提示框 ?>
<div class="box box-radius">
	<form method="post">
		<table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               

                <tr>
                    <td width="10%" class="tdbg"><label for="password">名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="sName" class="m_inpt_border"  value="<?php echo isset( $store_data['sName'] ) ? $store_data['sName'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">地址</label></td>
                    <td width="84%">
                    <textarea name="sAddr" class="textarea_border"><?php echo isset( $store_data['sAddr'] ) ? $store_data['sAddr'] : ''; ?></textarea>
                    <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">联系电话</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="sPhone" id="name" class="m_inpt_border" value="<?php echo isset( $store_data['sPhone'] ) ? $store_data['sPhone'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>                           
                <tr>
                    <td width="10%"class="tdbg"><label>联系人</label></td>
                    <td width="84%">
                    <input name="sUser" type="text" class="x_inpt_border" value="<?php echo isset( $store_data['sUser'] ) ? $store_data['sUser'] : ''; ?>" >
                    <span class="span">*</span>
                    </td>                  
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>联系人电话</label></td>
                    <td width="84%">
                    <input name="sTel" type="text" class="x_inpt_border" value="<?php echo isset( $store_data['sTel'] ) ? $store_data['sTel'] : ''; ?>" >
                    </td>
                </tr>                           
            </table>
 <!--__TOKEN__-->
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


