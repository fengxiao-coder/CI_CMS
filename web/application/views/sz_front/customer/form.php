<?php $data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);?>
<script>
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id');
    });
</script>
    <div class="box box-radius">
<?php get_messagebox();// 获取提示框 ?>
	<form method="post">
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">  
		<?php foreach( $this->$modelname->form_array as $k=>$v ):?>
                
                <tr>
                    <td width="10%" class="tdbg"><label for="<?php echo $k?>"><?php echo $v ?></label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="<?php echo $k ?>" id="<?php echo $k ?>" class="m_inpt_border" placeholder="" value="<?php echo isset( $supplier_data[$k] ) ? $supplier_data[$k] : '' ; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
		<?php endforeach;?>
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
</div>
