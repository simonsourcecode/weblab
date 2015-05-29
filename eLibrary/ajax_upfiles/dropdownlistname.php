<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>php name dropdownlist</title>
</head>
<body>



<!--<form action="" method="post">-->
<select name="owner" id="owner" >
<option value="0">请选择</option>
<?php
 
 //数据库连接及参数初始化********************************** 
$link = mysql_connect( 'localhost', 'root', 'apache') or die('Could not connect to mysql server.' );
        mysql_select_db('db_library', $link) or die('Could not select database.');
        echo "connected to mysql server ok.";
 mysql_query("set names utf8");
 $sql="select UserName,UserName from tb_user where UserID>0 ";
 $datas=mysql_query($sql);

 while($data=mysql_fetch_array($datas)){
  //$data[1]=iconv("GB2312","UTF-8",$data[1]);
  //echo $data[2];
  echo "<option value='$data[0]'>$data[1]</option><br/>";
 }
?>
</select>

<!--</form>-->

</body>
</html>