<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>打印店铺编码</title>
</head>
<body>
<object id="print_epl" style="display: none; visibility: hidden" width="51" height="21" codebase="EPL.ocx#version=1,0,0,0" classid="CLSID:64CBDF17-E597-4309-A586-4BB8051452AB" visible="false"></object>
<script language="javascript">

//计算字符串长度
String.prototype.strLen = function() {
    var len = 0;
    for (var i = 0; i < this.length; i++) {
        if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0) len += 2; else len ++;
    }
    return len;
}
//将字符串拆成字符，并存到数组中
String.prototype.strToChars = function(){
    var chars = new Array();
    for (var i = 0; i < this.length; i++){
        chars[i] = [this.substr(i, 1), this.isCHS(i)];
    }
    String.prototype.charsArray = chars;
    return chars;
}
//判断某个字符是否是汉字
String.prototype.isCHS = function(i){
    if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0)
        return true;
    else
        return false;
}
//截取字符串（从start字节到end字节）
String.prototype.subCHString = function(start, end){
    var len = 0;
    var str = "";
    this.strToChars();
    for (var i = 0; i < this.length; i++) {
        if(this.charsArray[i][1])
            len += 2;
        else
            len++;
        if (end < len)
            return str;
        else if (start < len)
            str += this.charsArray[i][0];
    }
    return str;
}
//截取字符串（从start字节截取length个字节）
String.prototype.subCHStr = function(start, length){
    return this.subCHString(start, start + length);
}

//连接打印机
function printContent(){
	print_epl.Open_Port("USB");
}

//打印机设置
function printBegin(){
	print_epl.Begin_Job("2", "12", "False", "B");
}

//打印采样编码
function printDo(codeContent){
	
	//print_epl.Print_QRPIC(0, 24, codeContent, 190);
	//print_epl.Print_QRPIC(5, 24, codeContent, 190);
	print_epl.Print_QRPIC(25, 24, codeContent, 190);
}

//打印机结束
function printEnd(){
	print_epl.End_Job();
}

function printCode(codeContent,count){
	var codeContent 			= (typeof(arguments[0])=="undefined") ? true : arguments[0];//第一个参数
   	var count 			= (typeof(arguments[1])=="undefined") ? true : arguments[1];//第二个参数

	//开始打印
	for(var i=0;i<count;i++ ) {
		printBegin();
		printDo(codeContent);
		printEnd();
	}
}

//关闭打印机
function printClose(){
	print_epl.Close_Port();
	print_epl.Printing_USBPORT("ZDesigner GK888t (EPL)");  // // prot 打印机名称 从 控制面板  ”设备和打印机“ 拷贝
	alert("打印成功!");
	window.open('','_parent');
	window.close();
}
printContent();

printCode('<?php echo $codeContent ?>','<?php echo $count?>');


printClose();
</script>
</body>
</html>