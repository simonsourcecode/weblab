
<html>
<head>
<meta HTTP-EQUIV="Page-Enter" CONTENT="revealtrans(duration=6.0, transition=5)"> 
<meta HTTP-EQUIV="Page-Exit" CONTENT="revealtrans(duration=6.0, transition=4)"> 

</head>
<body>
//版本
//环境参数显示
//软件安装检测
Js 检测客户端是否安装Acrobat pdf阅读器
<button onclick="isAcrobatPluginInstall()" >检测</button>
<script>
function isAcrobatPluginInstall(){
//如果是firefox浏览器
if (navigator.plugins && navigator.plugins.length) {
for (x=0; x<navigator.plugins.length;x++) {

if (navigator.plugins[x].name== 'Adobe Acrobat')
return true;
alert("有");
}
}
//下面代码都是处理IE浏览器的情况
else if (window.ActiveXObject)
{
for (x=2; x<10; x++)
{
try
{
oAcro=eval_r("new ActiveXObject('PDF.PdfCtrl."+x+"');");
if (oAcro)
{
return true;
alert("有");
}
}
catch(e) {}
}
try
{
oAcro4=new ActiveXObject('PDF.PdfCtrl.1');
if (oAcro4)
return true;
}
catch(e) {}
try
{
oAcro7=new ActiveXObject('AcroPDF.PDF.1');
if (oAcro7)
return true;
}
catch(e) {}
}
}
</script>

<?php
	//single php file,return value
	 
	$mysqli = new mysqli("localhost", "root", "apache", "db_library");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	
	mysqli_query($mysqli,"SET NAMES 'UTF8'");
	$query = $mysqli->query("select * from xm_lib_type ");
	
	$type=66;
	$data[$type]=array();
	
	while($a = $query->fetch_array(MYSQLI_BOTH)){
	$pid=$a["id"];
		$year=14;
		 $queryyear = $mysqli->query("select * from xm_year ");
			while($b = $queryyear->fetch_array(MYSQLI_BOTH)){
			
			$qid=$b["id"];
			$str = $mysqli->query("select * from xm_lib where pid='$pid' and qid='$qid' ");
			$data[$type][$year++]=mysqli_num_rows($str);
						
			}
			$type++;
			$data[$type]=array();
			}
	$json=json_encode($data);
	echo $json;
	?>  
	
	</body>
	</html>