<?php $data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);?>
<!--  添加信息页面-->
<div  >
    <?php get_messagebox();// 获取提示框 ?>
    <!--<div class="breadcrumb">
        <div class="breadcrumb_i">您当前所在的位置：<span>配送中心</span>&nbsp;-&nbsp;<span>售前检测管理</span>&nbsp;-&nbsp;<span class="orange">添加</span></div>
        <div class="breadcrumb_div"><a href="#" class="breadcrumb-return">返回</a></div>
        <div class="breadcrumb_div"><a href="list.htm"  target="home"class="breadcrumb-list">列表</a></div>    
        <div class="breadcrumb_div"><a href="addinfo.htm" target="home" class="breadcrumb-add">添加</a></div> 
    </div>-->
    <!--  添加-->
    <div class="box box-radius">
     	<form method="post">
		 <table cellspacing="0" cellpadding="0" border="0" class="addinfo_table">
		            <tbody>
                <tr>
                    <td width="10%" class="tdbg"><label for="operation_name">权限名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text"  class="m_inpt_border"   name="operation_name" id="operation_name" placeholder="" value="<?php echo isset($operations_data['operation_name'] ) ? $operations_data['operation_name'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="module">控制器</label></td>
                    <td width="84%" colspan="3">
                        <input type="text"  class="m_inpt_border"   name="module" id="module" placeholder="" value="<?php echo isset($operations_data['module'] ) ? $operations_data['module'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="action">动作</label></td>
                    <td width="84%" colspan="3">
                        <input type="text"   class="m_inpt_border"  name="action" id="action" placeholder="" value="<?php echo isset($operations_data['action'] ) ? $operations_data['action'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="operations_type_id">权限类别</label></td>
                    <td width="84%" colspan="3">
                        <?php echo form_dropdown('operations_type_id',$this->operations_type_model->get_values('type_id','type_name',array('orders'=>array('type_id'=>'desc'))),isset($operations_data['operations_type_id'] ) ? $operations_data['operations_type_id'] : '',' class="m_inpt_border" ',"--请选择--");?>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="remark">备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea id="remark" class="textarea_border" cols="80" rows="5" name="remark"><?php echo isset($operations_data['remark'] ) ? $operations_data['remark'] : ''; ?></textarea>
                        
                    </td>
                </tr>
            </tbody>
        </table>
		<div class="control-group btn_group">
                    <label for="body" class="control_label"></label>
                    <div class="controls">
			<button type="submit" class="btn btn_style1"><?php echo isset($operations_data['operation_id'])?'修改' : '提交' ;?></button>
			<button type="reset" class="btn btn_style1">重置</button>
                     </div>    
		</div>
		<input type="hidden" name="is_submit" value="1">
		<!--__TOKEN__-->
	</form>
        <div class="float_clear"></div>

    </div>          

    </div>
</div>

