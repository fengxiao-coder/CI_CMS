<?php $data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);?>

<div class="box box-headtitle box-radius">
<?php get_messagebox();// 获取提示框 ?>
	<form method="post">
		<?php foreach( $this->$modelname->form_array as $k=>$v ):?>
		<div class="control-group">
		<label class="control-label" for="<?php echo $k?>"><?php echo $v ?></label>
			<div class="controls">
				<input type="text" name="<?php echo $k ?>" id="<?php echo $k ?>" placeholder="" 
				value="<?php echo isset( $city_data[$k] ) ? $city_data[$k] : '' ; ?>">
			</div>
		</div>
		<?php endforeach;?>
		<div class="control-group control-group-submit">
			<button type="submit" class="btn  btn-blue  floa-Left"><?php echo isset($city_data['city_id'])?'修改':'添加';?></button>
			<button type="submit" class="btn  btn-blue">重置</button>
		</div>
		<input type="hidden" name="is_submit" value="1">
	</form>
</div>
