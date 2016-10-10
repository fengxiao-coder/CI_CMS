<?php
foreach ( $articles as $k => $v ) :
	?>
	<?php
	//添加js切换图片功能
		 if($words == 7 || $words == 20 ){
		 	$imgpath=ltrim($imagemark[$k],"/");
		 	echo "<li onmouseover=\"changepic('$imgpath','$words',$k)\" >";
		 }else{
		 	echo '<li>';
		 }
	?>
		<a href='<?php echo base_url ( $this->_site_path . '/news/article/' . $k );?>'>
		
			<?php
				//id=6 工作要闻栏目 	不同栏目截取不同的标题长度
				if($pid == 6){
					//当前文章的发布时间
					$str='【'.date('Y-m-d',$created[$k]).'】';
					echo (mb_strlen($v) >= 36)? mb_substr ( $v, 0 ,10 ,'utf8') .$str: $v.$str;
				}else if($words == 13 && $pid != 6){
					echo (mb_strlen ( $v ) >= 10) ? mb_substr ( $v, 0, 15, 'utf8' ) : $v;
				}else{
					echo (mb_strlen ( $v ) >= 10) ? mb_substr ( $v, 0, 12, 'utf8' ) : $v;
				}
			?>
			
		</a>
	</li>
<?php
endforeach;

?>
