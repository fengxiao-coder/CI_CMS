		<?php $this->load->view_part( $this->_site_path."/common/banner" );?>
		<?php $this->load->view_part( $this->_site_path."/common/left" );?>
		<div class="main float-left">
		
			<!-- top-bar -->
			<?php //$this->load->view_part( $this->_site_path.'/common/top_bar');?>
			<!-- top-bar -->
			
			<!-- main-head -->
			<?php //$this->load->view_part( $this->_site_path.'/common/classify');?>
			<!-- main-head -->
			
			<!-- main-wrap -->
			<?php if($pid == 1):?>
				<div class="detail channel channel-nopadding">
				<?php foreach ($newssort_data as $k=>$v):?>
					<div class="box box-class box-class-single">
						<h3 class="title"><?php echo $v;?></h3>
						<div class="box-inner" url="<?php echo base_url($this->_site_path . '/news/get_channel_article/' . $k . '/'. $pid);?>"></div>
						<div class="clear"></div>
					</div>
				<?php endforeach;?>
			</div>
			<?php else:?>
			<div class="detail channel">
			<?php foreach ($newssort_data as $k=>$v):?>
				<div class="box box-class">
					<h3 class="title"><?php echo $v;?><a href="<?php echo base_url($this->_site_path . '/news/lists/' . $k);?>" class="more">更多</a></h3>
					<div class="box-inner" url="<?php echo base_url($this->_site_path . '/news/get_channel_article/' . $k);?>"></div>
				</div>
			<?php endforeach;?>
			</div>
			<?php endif;?>
			<!-- main-wrap -->
		</div>		
 
 <script type="text/javascript">
 (function($){
	 $(function(){
		 var len = $('.box-inner').length ;
		 for(var i=0; i<len; i++){
			 //回去新闻数据
			 getInfo($('.box-inner').eq(i));
		 }
	 });	
})(jQuery);
</script>

