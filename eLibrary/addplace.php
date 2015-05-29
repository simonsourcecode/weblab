<?php
//.....库位管理，添加库位信息，编辑库位信息等功能实现
//.....调用方式 http://localhost/eLibrary/cstype.php?func=createtype(showtype or save)
//.....
//数据库连接及参数初始化********************************** 
$link = mysql_connect( 'localhost', 'root', 'apache') or die('Could not connect to mysql server.' );
        mysql_select_db('db_library', $link) or die('Could not select database.');
        echo "connected to mysql server database ok.";
		
		echo "<hr>";

	$func=$_GET["func"];
	//echo $func;
	$uid = 0;
	//$uid = $_GET["uid"];
	$id = 0;
	$type = "1";
	$route_id = "";
	$route_char = "";
	$php_self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	
//编码处理	
	mysql_query("SET NAMES 'UTF8'");

//设置默认页 
if (empty($func)) $func = 'showtype';


//设置父分类的 uid 
if (empty($uid)) $uid = "0"; 
if (empty($id)) $id = 0; 

//数据库存储************************************************ 
if ($func == 'save'):

 // $uid = $_POST["uid"];//如果得不到正确值会返回一个布尔值而不是resource 类型；
  
  $x = $_POST["province"];
  if(!empty($x))
  {$uid = $x;
  $x = $_POST["diqu"];}
  
  if(!empty($x))
  {$uid = $x;
  $x = $_POST["city"];}
  
  if(!empty($x))
  $uid = $x;
	//$id = $_POST["id"];
	$type = $_POST["type"];
	$route_id = "";
	$route_char = $_POST["route_char"];
	
	
$fields = ""; //数据表tb_location各相关字段的集合
$values = ""; 

if ($uid!="0") { 
$fields .= ",uid"; 
$values .=",'$uid'"; 
} 
if ($type!="") { 
$fields .= ",type"; 
$values .=",'$type'"; 
} 
if ($route_id == "") { 
//取得父分类的 route_id 
if ($uid !='0' ) { 
$result = mysql_query("select * from tb_location where id=$uid "); 

$route_id = mysql_result($result,0,'route_id'); 
$route_char = mysql_result($result,0,'route_char'); 
} else { 
$route_id ='0'; 
} 

//形成自己的 route_id 
$fields .=",route_id";
//echo $route_id;

$values.=",'$route_id'"; 
} 
//形成自己的 route_char 
if ($route_char !="") { 
$fields .= ",route_char"; 
//$route_char .=":".$type; 
$values.=",'$route_char'"; 
} else { 
$fields .= ",route_char"; 
$route_char=$type; 
$values.=",'$route_char'"; 
} 


$fields = substr($fields,1,strlen($fields)-1); 
$values = substr($values,1,strlen($values)-1); 
//echo $fields;
//echo "<br>";
//echo $values;
//echo $route_char;
//echo $_POST["province"];echo $_POST["diqu"];
echo $uid;

//$result = mysql_query("insert into tb_location ($fields) values ($values)"); 
//... 
endif; /* end save */ 
//分类上传************************************************ 
if ($func=='createtype'): 
//取得自己的 id 
$result = mysql_query("select * from tb_location order by id desc") OR die(mysql_error()); 
$num = mysql_num_rows($result); 
if (!empty($num)) { 
$cat = mysql_result($result,0,'id'); 
} else { 
$cat=0; 
} 
//判断分类的状态 
if ($uid != 0) { 
$result = mysql_query("select * from tb_location where id=$uid "); 
$type = mysql_result($result,0,'type'); 
$route_char = mysql_result($result,0,'route_char'); 
} else { 
$type='root'; 
} 


echo "<FORM ACTION='$php_self?func=save' METHOD='POST'>"; 
$cat=$cat+1; 
echo "<table>"; 
echo "<tr><td>所属空间:$type</td></tr>"; 
echo "<tr><td>添加新库位:<input type='text'  id='type' name='type'  SIZE='10' MAXLENGTH='100'>*</td></tr>"; 
echo "<tr><td>上级分类ID:<input type='hidden' id='uid' name='uid' SIZE='10' MAXLENGTH='100'>*</td></tr>";
echo "<tr><td>选择容器:";
include_once("dropdownlistplace.php");
echo "</td></tr>";
echo "<tr><td><input type='hidden' id='route_id'  name='route_id' SIZE=10 MAXLENGTH=100></td></tr>";
echo "<tr><td><input type='hidden' id='route_char' name='route_char' SIZE=10 MAXLENGTH=100></td></tr>";

echo "<tr><td>"; 


echo "<INPUT TYPE=submit NAME='Save' VALUE='保存'></td></tr>"; 
echo "</table>"; 
echo "</form>"; 
endif; /* end createtype */ 
//显示分类************************************************ 
if ($func=='showtype'): 
echo "<table>"; 
//判断分类的状态 
if ($uid!=0) { 
$result=mysql_query("select * from tb_location where uid=$uid"); 

$type=mysql_result($result,0,'type'); 

//******** 新加入的代码 *************** 
$route_id=mysql_result($result,0,'route_id'); 
$route_char=mysql_result($result,0,'route_char'); 
$path=explode(":",$route_id); 
$path_gb=explode(":",$route_char); 
echo "<tr><td>"; 
for ($i=0;;$i++) { 
$a=$i+1; 
echo "<a href='$php_self?func=showtype&uid=$path[$a]'>$path_gb[$i]</a>"; 
if (empty($path_gb[$i])) { 
break; 
} 
} 
echo "</td></tr>"; 
//******** end ***********************

} else { 
$type='父分类'; 
} 
echo "<tr><td><a href='$php_self?func=createtype&uid=$uid'>创建分类</a></td></tr>"; 
echo "<tr><td>$type</td></tr>"; 

$result = mysql_query("select * from tb_location where uid=$id ") OR die(mysql_error()); 
$num = mysql_num_rows($result); 

if (!empty($num)) { 
for ($i=0;$i<$num;$i++) { 
$id = mysql_result($result,$i,'id'); 
$type = mysql_result($result,$i,'type'); 
echo "<tr><td>"; 
echo "<a href='$php_self?func=showtype&uid=$id'>$type</a>"; 
echo "</td></tr>"; 
} 
} 
echo "</table>"; 
endif; /* end showtype */ 
//..... 
//..... 
?>