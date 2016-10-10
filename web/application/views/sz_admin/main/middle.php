<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品管理CMS系统</title>
<?php echo css( 'css/style.css' );?>
<style type="text/css">
</style>
</head>
<body>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
  <tr>
    <td width="213"  height="100%;" id=frmTitle noWrap name="fmTitle"  valign="top" tyle="overflow-x:hidden;">
	<iframe style="overflow-x:hidden; width:213px; *width:230px;" name="left" height="100%" src="<?php echo base_url($this->_site_path."/main/left");?>"  frameborder="0">
	浏览器不支持嵌入式框架，或被配置为不显示嵌入式框架。</iframe></td>
    <td width="8" valign="middle" bgcolor="#edf8fc" onclick=switchSysBar()>
        <span class="navPoint"><img src="<?php echo base_url();?>/theme/default/images/main_55.jpg" name="img1" width=8 height=172 id=img1 style="cursor:pointer;"></span>
    </td>
    <td align="left" valign="top"  height="100%" >
        <iframe name="main" height="100%" width="100%" border="0" frameborder="0" src="<?php echo base_url($this->_site_path."/main/right");?>"> 浏览器不支持嵌入式框架，或被配置为不显示嵌入式框架。</iframe></td>

  </tr>
</table>
</body>
</html>
<script>
function switchSysBar(){ 
	var locate=location.href.replace('<?php echo base_url($this->_site_path."/site/middle");?>','');
	var ssrc=document.getElementById("img1").src.replace(locate,'');
	if (ssrc=="<?php echo base_url();?>/theme/default/images/main_55.jpg")
	{ 
		document.getElementById("img1").src="<?php echo base_url();?>/theme/default/images/main_55_1.jpg";
		document.getElementById("frmTitle").style.display="none" 
	} 
	else
	{ 
		document.getElementById("img1").src="<?php echo base_url();?>/theme/default/images/main_55.jpg";
		document.getElementById("frmTitle").style.display="" 
	} 
} 
</script>
