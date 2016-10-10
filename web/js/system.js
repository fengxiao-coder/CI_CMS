function showFileEditPage(URL,tWidth,tHeight)
{
	dlgFeatures = "dialogWidth:"+screen.width+"px;dialogHeight:"+screen.height+"px;resizable:yes;center:yes;location:no;status:no;";
	window.open(URL,"",dlgFeatures);
}

function checkAllfuck(){
	if($("input[name='checkAll']").attr("checked")==='checked'){
		$("input[name='ids[]']").attr('checked','checked');
	}else{
		$("input[name='ids[]']").removeAttr('checked');
	}
}
function checkInversefuck(){
	$("input[name='ids[]']").each(function(){
		if($(this).attr("checked")==='checked'){
			$(this).removeAttr('checked');
		}else{
			$(this).attr('checked','checked');
		}
	});
}
/*
$("input[name='checkAll']").click(function(){
	if($(this).attr("checked")==='checked'){
		$("input[name='ids[]']").attr('checked','checked');
	}else{
		$("input[name='ids[]']").removeAttr('checked');
	}
});
$("input[name='checkInverse']").click(function(){
	$("input[name='ids[]']").each(function(){
		if($(this).attr("checked")==='checked'){
			$(this).removeAttr('checked');
		}else{
			$(this).attr('checked','checked');
		}
	});
});
 */
/**
 * 从某个dom获取值去url请求数据以改变令一个dom的值
 * @param string to 要改变的dom
 * @param string from 因为from的变化而改变
 * @param string url 请求的url
 * @param string to_val 要改变的dom的默认值
 */
function get_value(to,from,url,to_val){
	from_value=$('#'+from).val();
	//console.info(from_value);
	$.post(url,{'from':from_value,'to':to_val},function(data){
		$('#'+to).html(data);
	});
}
/**
 * 从某个dom获取值去url请求数据添加到to容器中
 * @param string to 要改变的dom
 * @param string from 因为from的变化而改变
 * @param string url 请求的url
 * @param string to_val 要改变的dom的默认值
 */
function get_value_add(to,from,url,to_val){
	from_value=$('#'+from).val();
	$.post(url,{'from':from_value,'to':to_val},function(data){
		console.info(data);
		$('#'+to).html(data);
	});
}
/**
 * 可以通过to_val传递多个参数
 *	参数传递方式形如：a=22&b=99
 */
function get_ajax_value(to,from,url,to_val){
	from_value=$('#'+from).val();
	to_val+="&from="+from_value;
	$.ajax({
		type:"POST",
		url: url,
	    data: to_val,
	    success: function(data){
			$('#'+to).html(data);
	   }
	});
}
// 设置cookie
function set_cookie(name,value) {
	var exp  = new Date();
	exp.setTime(exp.getTime() + 24*60*60*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
//取cookies函数
function get_cookie(name) {
	var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	if(arr != null) return unescape(arr[2]);
	return null;

}
//删除cookie
function del_cookie(name) {
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie(name);
	if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}
/**
 * 确认要删除吗
 */
function confirmDelete() {
    if (confirm("确认要删除吗？"))
        return true;
    else return false;
}

function confirmDo() {
    if (confirm("确认要执行吗？"))
        return true;
    else return false;
}

function tiao_url(url){
    location=url;
}

 function ajax_update_user_password(href){       
        $.fancybox({
            'type':'iframe',
            'hideOnOverlayClick':false,
            'hideOnContentClick':false,
            'enableEscapeButton':false,
            'autoDimensions':false,
            'width':600,
            'height':410,
            'href' : href
        });
    }