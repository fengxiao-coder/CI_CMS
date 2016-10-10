	<?php foreach ($articles as $v):?>
	<div class="single">
			<a href="<?php echo base_url($this->_site_path . '/news/article/' . $v['id']);?>"><img src="<?php echo base_url($v['imagemark'] ? $v['imagemark'] : 'uploads/defaultpic.gif');?>" /></a>
			<h4><a href="#"><i class="icon icon-slogo"></i><?php echo mb_substr($v['title'], 0, 14, 'utf-8');?></a></h4>
			<p><?php echo mb_substr(strip_tags(str_replace(array('&nbsp;', ' ', '　'), '', $v['content'])), 0, 60, 'utf-8');?><a href="<?php echo base_url($this->_site_path . '/news/article/' . $v['id']);?>">...查看全文</a></p>
			<div class="single-footer">
				<span><?php echo date('Y-m-d', $v['created']);?></span>
				<span>浏览(<?php echo $v['clickcount'];?>)</span>
			</div>
		</div>
	<?php endforeach;?>
