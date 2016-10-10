	
	<?php $this->load->view_part($this->_site_path.'/common/banner');?>
	<?php $this->load->view_part($this->_site_path.'/common/left');?>
		
<div class="main float-left">
	<div class="detail goods-list">
		<ul class="goods">
			<?php foreach ($lists as $v):?>
            <li>
                <a href='<?php echo base_url($this->_site_path . '/news/article/' . $v['id']);?>' class='goods-img'><img src='<?php echo $v['imagemark']?base_url($v['imagemark']):base_url('uploads/defaultpic.gif');?>' width='180px' height='125px'/></a>
				<a href="<?php echo base_url($this->_site_path . '/news/article/' . $v['id']);?>"  class="goods-title"><?php echo $v['title'];?></a>
			</li>
			<?php endforeach;?>
		</ul>
		<div class="clear"></div>
		<!-- 分页 -->
		<div class="pagelist"><?php echo $pagination; ?></div>
	</div>
	<!-- main-wrap -->
</div>		