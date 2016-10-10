<?php if ( $recycled == 1 ) {?>
	<li><button type="submit" name="do" value="recycled" class="btn" onclick="return confirmDelete()"><span  class="btn-Bulkdelete">彻底删除</span></button></li>
<?php } else {?>
	<li><button type="submit" name="do" value="delete" class="btn" onclick="return confirmDelete()"><span  class="btn-Bulkdelete">批量删除</span></button></li>
<?php }?>
<li><label>
		<a href="<?php echo base_url( $this->_site_path."/" . $model . "/" . $action . "?recycled=1" );?>">回收站</a>
<a href="<?php echo base_url( $this->_site_path."/" . $model . "/" . $action . "?recycled=0" );?>">列表</a>
	</label></li>
