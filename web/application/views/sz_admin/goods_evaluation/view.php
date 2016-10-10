<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>
<!--  详情-->
<?php 
if ($info['evaluation']==0){
	$str="好评";
}elseif ($info['evaluation']==1){
	$str="中评";
}elseif ($info['evaluation']==2){
	$str="差评";
}
?>
<div class="box  box-radius">
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="details_tab">	
	<tr>
		<td width="12%"><strong>用户名称</strong></td>
		<td width="88%" colspan="5"><?php echo $this->user_model->get_value_by_pk($info["user_id"],"user_name") ?></td>
	</tr>
	<tr>
		<td width="12%"><strong>商品名称</strong></td>
		<td width="88%" colspan="5"><?php echo $this->goods_model->get_value_by_pk($info["goods_id"],"name") ?></td>
	</tr>
	<tr>
		<td width="12%"><strong>评价等级</strong></td>
		<td width="88%" colspan="5"><?php echo $str;?></td>
	</tr>
	<tr>
		<td width="12%"><strong>评价时间</strong></td>
		<td width="88%" colspan="5"><?php echo  date('Y-m-d H:i:s', $info['created_time'])?></td>
	</tr>
	<tr>
		<td width="12%"><strong>评价内容</strong></td>
		<td width="88%" colspan="5"><?php echo $info['content']?></td>
	</tr>
	<tr>
		<td width="12%"><strong>回复内容</strong></td>
		<td width="88%" colspan="5" >
		<?php foreach ($reply_info as $k=>$v){?>
				<a href="<?php echo base_url($this->_site_path."/goods_evaluation/edit/{$v['rep_id']}"); ?>">
				<?php echo ($k+1)."、".$v["content"];?>
				</a>				
				<a href="<?php echo base_url($this->_site_path."/goods_evaluation/delete/{$v['rep_id']}"); ?>">&nbsp;&nbsp;删除</a><br/>
		<?php }?>		  
		</td>
	</tr>
	<tr>
		<td width="12%"><strong>回复时间</strong></td>
		<td width="88%" colspan="5"><?php echo  date('Y-m-d H:i:s', $v['created_time'])?></td>
	</tr>
   	</table>
</div>
<div class="tips">
     <div class="float_left">
     <a href="<?php echo base_url($this->_site_path . "/goods_evaluation/reply"). "/" . $info['id']; ?>">
     <button type="submit" class="btn btn_style1"><span>回 复</span></button></a></div>
</div>