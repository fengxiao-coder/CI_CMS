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
				<div class="detail-source"><?php echo date('Y-m-d', $info['created']);?> 发布</div>
				<div class="detail-fontsize">
					字号：
					<a href="javascript:void(0);" onclick="fontsize(this, 16);">大</a>
					<a href="javascript:void(0);" onclick="fontsize(this, 14);"><b>中</b></a>
					<a href="javascript:void(0);" onclick="fontsize(this, 12);">小</a>
				</div>
				<!--content here start-->
				<div class="detail-content" id="detail-content"><?php echo $info['content'];?></div>
				<!--content here end-->
				<div class="detail-footer">
					<!-- JiaThis Button BEGIN -->
					<div class="jiathis_style_32x32"><span class="jiathis_txt">分享到：</span>
					<a class="jiathis_button_qzone"></a>
					<a class="jiathis_button_tsina"></a>
					<a class="jiathis_button_tqq"></a>
					<a class="jiathis_button_renren"></a>
					<a class="jiathis_button_kaixin001"></a>
					<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
					</div>
					<script type="text/javascript" >
					var jiathis_config={
						summary:"",
						hideMore:false
					}
					</script>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
					<!-- JiaThis Button END -->
				</div>
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
 //调节文章内容字体大小
 function fontsize(it, fontsize){
	$('#detail-content').css({'font-size' : fontsize});
	$('.detail-fontsize a').each(function(){
		if($(this).find('b').length > 0){
			$(this).html($(this).find('b').html());
		}
	});
	$(it).html('<b>'+$(it).html()+'</b>');
}
</script>

