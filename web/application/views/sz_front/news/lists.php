	

	<?php $this->load->view_part($this->_site_path.'/common/banner');?>
	<?php $this->load->view_part($this->_site_path.'/common/left');?>
<div class="main float-left">

	<!-- top-bar -->
	<?php //$this->load->view_part( $this->_site_path.'/common/top_bar');?>
	<!-- top-bar -->
	
	<!-- main-head -->
	<?php //$this->load->view_part( $this->_site_path.'/common/classify');?>
	<!-- main-head -->
	
	<!-- main-wrap -->
	<div class="detail list">
		<?php if(isset($newssort_data)):?><h2 class="list-class-title"><?php echo $p_title;?></h2><?php endif;?>
		<table class="table">
			<tbody>
			<?php foreach ($lists as $v):?>
				<tr>
					<td class="align-left"><a href="<?php echo base_url($this->_site_path . '/news/' . (isset($newssort_data) ? 'article/' : 'download/') . $v['id']);?>"><?php echo $v['title'];?></a></td>
					<td><?php echo date('Y-m-d', $v['created']);?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<!-- 分页 -->
		<div class="pagelist"><?php echo $pagination; ?></div>
	</div>
	<!-- main-wrap -->
</div>		
