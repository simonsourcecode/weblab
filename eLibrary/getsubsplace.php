<?php
 header("Content-type: text/html; charset=utf-8");
 //数据库连接及参数初始化********************************** 
$link = mysql_connect( 'localhost', 'root', 'apache') or die('Could not connect to mysql server.' );
        mysql_select_db('db_library', $link) or die('Could not select database.');
        echo "connected to mysql server ok.";
 mysql_query("set names utf8");
 $type=$_GET['type'];
 $area=$_GET['area'];
 //echo $type.$area;
 //exit();
 $text="";
 if($type == 1){
  $sql="select id,type from tb_location where uid=$area ";
 }
 
 if ($type == 2){
  //$sql="select id,pid,name,region_level from fanwe_region_conf where region_level=4 and pid=$area";
  $sql="select id,type from tb_location where uid=$area ";
 }
 //if($type==2){
 //echo $sql;
 //exit();
 //}
 $datas=mysql_query($sql);
 while($data=mysql_fetch_array($datas)){
  //$data[2]=iconv("GB2312","UTF-8",$data[2]);
  $text.="|".$data[0]."|".$data[1];
 }  
 echo $text;
?>