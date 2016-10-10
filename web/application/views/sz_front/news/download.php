		
		<?php $this->load->view_part($this->_site_path.'/common/banner');?>
		<?php $this->load->view_part($this->_site_path.'/common/left');?>
		<!-- main -->
		<div class="main float-left">
					
			<!-- top-bar -->
			<?php //$this->load->view_part( $this->_site_path.'/common/top_bar');?>
			<!-- top-bar -->
			
			<!-- main-head -->
			<?php //$this->load->view_part( $this->_site_path.'/common/classify');?>
			<!-- main-head -->
			
			<!-- main-wrap -->
			<div class="detail">
				<div class="detail-title"><?php echo $info['title'];?></div>
				<div class="detail-source"><?php echo date('Y-m-d', $info['created']);?>　|　作者:<?php echo $info['author'];?>　|　来源:<?php echo $info['article_source'];?></div>
				<!--content here start-->
				<div class="detail-content" id="detail-content">
					<p><?php echo $info['description'];?></p>
					<p><b>下载地址</b></p>
					<p><a href='<?php echo base_url($this->_site_path . '/main/download?url=' . rawurlencode(strip_tags($info['content'])));?>' target='_blank'>本地下载</a></p>
				</div>
				<!--content here end-->
			</div>
			<!-- main-wrap -->
		</div>		

 <script type="text/javascript">
 (function($){
	 $(function(){
		 var url = '<?php echo base_url($this->_site_path . '/news/add_article_clicks/' . $info['id'])?>';
		 var query = {};
		 //增加文章点击数
		 $.get(url, query);
	 });	
})(jQuery);
</script>

