
<?php
//download page
if( empty($_GET['FileName'])|| empty($_GET['FileDir'])|| empty($_GET['FileId'])){
    echo'<script> alert("非法连接 !"); location.replace ("index.php") </script>'; exit();
}
$file_name=$_GET['FileName'];
$file_dir=$_GET['FileDir'];
$FileId=$_GET['FileId'];
$file_dir = $file_dir."/";
if   (!file_exists($file_dir.$file_name))   {   //检查文件是否存在  
  echo   "文件找不到";  
  exit;    
  }   else   {  
$file = fopen($file_dir . $file_name,"r"); // 打开文件
// 输入文件标签
Header("Content-type: application/octet-stream");
Header("Accept-Ranges: bytes");
Header("Accept-Length: ".filesize($file_dir . $file_name));
Header("Content-Disposition: attachment; filename=" . $file_name);
// 输出文件内容
echo fread($file,filesize($file_dir . $file_name));
fclose($file);
exit();
}
?> 