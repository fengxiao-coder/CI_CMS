<?php if ( $recycled == 1 ) {?>
	<a href="<?php echo query_url( $this->_site_path."/" . $model . "/recycled/" . $id );?>" >恢复</a>
<?php } else {?>
	<a href="<?php echo base_url( $this->_site_path."/" . $model . "/view/" . $id );?>">查看</a>
	<a href="<?php echo query_url( $this->_site_path."/" . $model . "/edit/" . $id );?>">修改</a>
	<a href="<?php echo query_url( $this->_site_path."/" . $model . "/delete/" . $id );?>" onclick="return confirmDelete()">删除</a>
<?php }?>
