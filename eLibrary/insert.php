<?php 
include_once("include/db_conn.php");
?>



<?php
$qid=substr(date('Y'),2);//2014 turn to 14

$sqlstr="INSERT INTO xm_lib (name,sn,alias,subject,imagepath,dateofissue,expiredate,place,owner,parentclass,qid,barcode,isvalid,description,remark,updatedate)
VALUES
('$_POST[name]','$_POST[sn]','$_POST[alias]','$_POST[subject]','$_POST[picpath_hidden]','$_POST[dateofissue]','$_POST[expiredate]','$_POST[place]','$_POST[owner]','$_POST[selectparentclass]','$qid','$_POST[barcode]','$_POST[isvalid]','$_POST[description]','$_POST[remark]',now())";
//echo $sqlstr;

$mysqli->set_charset("uft8");
if (!mysqli_query($mysqli,$sqlstr))
  {
  die('Error description: ' . mysqli_error($mysqli));
  }
echo "1 record added. <br /><br /><br />";

mysqli_close($mysqli);

include_once("log.php"); // write to log file elibrary.log.

setcookie("picpath", "", time()-60);// cookie "picpath" end here, which birth in line 53 of ajax_upfiles/doupfiles.php.

echo "<a href=form_addinfo.php>继续添加宝贝</a>&nbsp;&nbsp;&nbsp;";
echo "<a href=index.html>返回首页</a>";
?>
