<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>打印产品编码</title>
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
function printDo(enName,cnName,codeContent,proCode,price,origin){
	print_epl.Print_Winfont(30, 0, enName, "宋体", 25, 0, "True", "False", "False", "False", "False");
	if (cnName.strLen()>16) {
		print_epl.Print_Winfont(216, 45, cnName.subCHStr(0,16), "宋体", 22, 0, "True", "False", "False", "False", "False");
		print_epl.Print_Winfont(216, 75, cnName.subCHStr(16,16), "宋体", 22, 0, "True", "False", "False", "False", "False");
		if (cnName.strLen()>28) print_epl.Print_Winfont(216, 105, cnName.subCHStr(28,16), "宋体", 22, 0, "True", "False", "False", "False", "False");
		//if (cnName.strLen()>48) print_epl.Print_Winfont(210, 135, cnName.subCHStr(48,16), "宋体", 22, 0, "True", "False", "False", "False", "False");
	} else {
		print_epl.Print_Winfont(216, 45, cnName, "宋体", 22, 0, "True", "False", "False", "False", "False");
	}
	//print_epl.Print_QRPIC(0, 24, price, 190);
	//print_epl.Print_Winfont(190, 140, origin, "宋体", 22, 0, "True", "False", "False", "False", "False");
	//print_epl.Print_Winfont(190, 170, price, "宋体", 22, 0, "True", "False", "False", "False", "False");
	 print_epl.Print_Winfont(216, 140, origin, "宋体", 22, 0, "True", "False", "False", "False", "False");
	 print_epl.Print_Winfont(216, 170, price, "宋体", 22, 0, "True", "False", "False", "False", "False");

	//print_epl.Print_QRPIC(0, 24, codeContent, 190);
	//print_epl.Print_QRPIC(5, 24, codeContent, 190);
	print_epl.Print_QRPIC(25, 24, codeContent, 190);
	//print_epl.Print_Winfont(20, 196, proCode, "宋体", 20, 13, "True", "False", "False", "False", "False");
}

//打印机结束
function printEnd(){
	print_epl.End_Job();
}

function printCode(enName,cnName,codeContent,proCode,price,origin,count){
	var enName 			= (typeof(arguments[0])=="undefined") ? true : arguments[0];//第一个参数
   	var cnName 			= (typeof(arguments[1])=="undefined") ? true : arguments[1];//第二个参数
   	var codeContent 	= (typeof(arguments[2])=="undefined") ? true : arguments[2];//第三个参数
	var proCode 		= (typeof(arguments[3])=="undefined") ? true : arguments[3];//第四个参数
	var price 			= (typeof(arguments[4])=="undefined") ? true : arguments[4];//第五个参数
	var origin 			= (typeof(arguments[5])=="undefined") ? true : arguments[5];//第六个参数
	var count 			= (typeof(arguments[6])=="undefined") ? 1 : arguments[6];//第七个参数

	//开始打印
	for(var i=0;i<count;i++ ) {
		printBegin();
		printDo(enName,cnName,codeContent,proCode,price,origin);
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

<?php
$countnum = count($message);
for($i=0;$i<$countnum;$i++){

	$count = 1 ;
	if ($message[$i]['count']) {
		$count = $message[$i]['count'];
	}
	 $cnName = $message[$i]['cn_name'];
	 $enName = $message[$i]['en_name'];
	 $proCode = $message[$i]['goods_sn'];
	 $proCode = $message[$i]['goods_sn'];
	 $codeContent = $message[$i]['code_content'];
	 $price = '价格:￥'.$message[$i]['price'];
	 $origin = '产地:'.$message[$i]['origin'];
?>
printCode('<?php echo $enName?>','<?php echo $cnName ?>','<?php echo $codeContent ?>','<?php echo $proCode?>','<?php echo $price?>','<?php echo $origin?>','<?php echo $count?>');
<?php
}
?>
printClose();
</script>
</body>
</html>