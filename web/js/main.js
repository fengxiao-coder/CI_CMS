//获取信息
function getInfo(item)
{
	var url = item.attr("url");
	var query = {} ;
	showInfo(item, url, query) ;
}

function removeInfo(item)
{
	item.removeAttr("url");
}

//显示信息
function showInfo(item, url, query)
{
	$.get(url, query, function(data)
	{
		item.html(data);
	});  
}

//获取并显示留言
function getMsg(table, form, query){
	
	var url = $(form).attr('url');
	$.post(url, query, function(data){
		if(data.content != 'ok'){
			alert(data.content); return false;
		}
		//追加留言
		var html = '<tr class="tr-grey"><td width="7%">&nbsp;</td><td width="7%"><i class="icon icon-talkbox">0</i></td><td class="td-content" width="60%">';
		var T = new Date();
		var y = T.getFullYear();
		var m = T.getMonth();
		var d = T.getDate();
		var h = T.getHours();
		var m = T.getMinutes();
		var time = y+'-'+m+'-'+d+'&nbsp;'+h+':'+m;
		html += '<p></p><div class="rebox">'+$(".nicEdit-main").html()+'</div><p></p></td><td><ul><li>'+time+'</li>';
		html += '<li class="comment-user"><i class="icon icon-user"></i>'+form.uname.value+'</li></ul></td></tr>';
		$('.table-comment').prepend(html);
		//清空表单数据
		form.validate.value = ''; $(".nicEdit-main").html('');
		//刷新验证码
		changeCode();
	}, 'json');  
}

$(function(){
	//所有a标签点击后立即失去焦点
	$('a').click(function(){
		$(this).blur();
	});
})


