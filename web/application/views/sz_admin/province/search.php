<div class="floa-clear"></div>
<div class=" btn-group search-group ">
<h4>查询条件</h4>
<form method="get">
	<?php foreach( $this->$modelname->list_array as $k=>$v ):?>
    <div class="search">
    	<label class="control-label" ><?php echo $v;?></label>
    	<input type="text" name="<?php echo $k;?>" value="<?php echo $this->input->get($k);?>" class="input_medium search_query" />
    </div>
    <?php endforeach;?>	
		<div class="floa-Left button_group">
		<button class="btn-success btn floa-Left" type="submit"><i class="icon-search icon-white"></i> 查询</button>
		<button type="submit" class="btn  btn-blue floa-Left">重置</button>
	</div>
	</form>
</div>
<div class="floa-clear"></div>
