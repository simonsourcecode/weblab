
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>文档库</title>
</head>
<body>
<style>
html,body{margin:10;
height:100%}
#left,#right{position:absolute;
top:0;
width:20px;
height:100%;}
#left{left:0;
background:#a0b3d6;}
#right{right:0;
background:#a0b3d6;}
#main{}
</style>
<div id="left"></div>

<div id="main" style="margin-left:20px;margin-right:20px;">
<?php 
//---allowed file type "pdf" here, upload folder is "upload";
 ?>
 <h1>文档库</h1>
 <form action="upload_file.php" method="post" enctype="multipart/form-data">
<label for="file">选择文档:</label>
<input type="file" name="file" id="file"  required="required" /> 

<input type="submit" name="submit" value="上传文档" />
</form>

<?php

/* Connect to a MySQL server  连接数据库服务器 */ 
    $mysqli = mysqli_connect( 
                'localhost',  /* The host to connect to 连接MySQL地址 */ 
                'root',      /* The user to connect as 连接MySQL用户名 */ 
                'apache',  /* The password to use 连接MySQL密码 */ 
                'db_library');    /* The default database to query 连接数据库名称*/ 
    
    if (!$mysqli) { 
       printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error()); 
       exit; 
    } 

//文件名称自动编码生成，当前日期取年月日为字符串加上3位随机数字；


$prefix="file";
$suffix=date('Ymd');

$temp=rand(100,999);
$str=$suffix.strval($temp);
$fileid=$str;
//echo $fileid;
//echo gettype($_POST);
//print_r($_POST);

//upload a file
if($_POST){
if ((($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "application/pdf"))
&& ($_FILES["file"]["size"] < 10240000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/".$fileid))
      {
     // echo $_FILES["file"]["name"] . " already exists. ";
     echo $fileid."already exists.";
      }
    else
      {
	  //如果当前位置不存在上传目录，就创建它
	  if (!file_exists('upload')){ mkdir ("upload"); }
       $originalfilename = $_FILES["file"]["name"];
	   $destinationfilename=$fileid.".pdf";
	  move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $destinationfilename);
	 
	  $docpath="upload/".$destinationfilename;
      echo "Stored in: " . $docpath;
	  
	  
	
	  $sqlstr="INSERT INTO tb_doc_library (title,class,doctype,docpath,updatedate)
VALUES('$originalfilename','上传类','pdf','$docpath',NOW())";
//echo $sqlstr;

$mysqli->set_charset("uft8");
if (!mysqli_query($mysqli,$sqlstr))
  {
  die('Error description: ' . mysqli_error($mysqli));
  }
echo "<br>1 file uploaded and write to database. <br /><br /><br />";


//include_once("log.php"); // write to log file elibrary.log.


//echo "<a href=index.html>返回首页</a>";
      }
    }
  }
else
  {
  echo "Invalid file";//要注意的一点是upload文件夹权限需设置为Others Folder access: Create and delete files才可以上传到指定文件夹中的

  }
  
  
  //echo "<br /><br /><br />";
  //echo "<a href=upload_file.php>继续添加</a>&nbsp;&nbsp;&nbsp;";
  //echo "<a href=home.php>返回首页</a>";
  
  }
  
  
?>


<hr /><br />

<link rel="stylesheet" href="tablesorter/docs/css/jq.css" type="text/css" media="print, projection, screen" />
	<link rel="stylesheet" href="tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />
 		
		<script type="text/javascript" src="tablesorter/jquery-latest.js"></script>

<script type="text/javascript" src='tablesorter/jquery.tablesorter.js'></script> 

	<script type="text/javascript" src="tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>

	
<script type="text/javascript">
	$(function() {
		$("table")
			.tablesorter({widthFixed: true, widgets: ['zebra']})
			.tablesorterPager({container: $("#pager")});
	});
	</script>
<pre>
[只允许上传pdf文档]
</pre>

<table id="filetable" class="tablesorter" border="0" style="border-collapse:collapse">
<thead><tr><th align="center" width="30%">ID</th><th align="left" width="58%">文档名称</th><th  align="center">操作</th></tr></thead>
<tbody>
<?php
$query=$mysqli->query("select * from tb_doc_library ");
	while($a=$query->fetch_array(MYSQLI_BOTH)){
	?>
<tr style="border:1px;"><td style="border:hidden" align="left"><?=$a["id"]?></td><td><img src="images/pdf.png" width="66" height="66" title="<?=$a["title"]?>" align="absmiddle" /></td><td><a href="<?=$a["docpath"]?>">view</a>&nbsp;<a href="download.php?FileName=">download</a></td></tr>

<?php } 

mysqli_close($mysqli);

?>
</tbody>
</table>
<div id="pager" class="pager">
	<form>
		<img src="tablesorter/addons/pager/icons/first.png" class="first"/>
		<img src="tablesorter/addons/pager/icons/prev.png" class="prev"/>
		<input type="text" class="pagedisplay"/>
		<img src="tablesorter/addons/pager/icons/next.png" class="next"/>
		<img src="tablesorter/addons/pager/icons/last.png" class="last"/>
		<select class="pagesize">
			<option selected="selected"  value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
		</select>
	</form>
</div>

</div>

<div id="right"></div>



</body>
</html>