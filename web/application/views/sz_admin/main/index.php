<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta  http-equiv=Content-Type content="text/html; charset=UTF-8">
    <?php echo css( 'css/style.css' );?>
<title>产品管理CMS系统</title>
</head>

<?php
//header("Cache-control:no-cache,no-store,must-revalidate"); 
//header("Pragma:no-cache"); 
//header("Expires:0"); 
?>
	<frameset frameBorder=0 border=0 frameSpacing=0  rows="107,*,32">
		<frame name="top" src="<?php echo base_url($this->_site_path."/main/top");?>" frameBorder=0 noResize scrolling=no>
		<frame name="middle" src="<?php echo base_url($this->_site_path."/main/middle");?>" frameBorder=0 noResize scrolling=no>
		<frame name="foot" src="<?php echo base_url($this->_site_path."/main/foot");?>" frameBorder=0 noResize scrolling=no>
	</frameset>
	<noframes>
	</noframes>
</html>
