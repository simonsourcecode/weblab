
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>





 


<div>

</div>

<table style="margin-left:200px;" border="0" align="center" cellpadding="0" cellspacing="0">
  
    
	<?php
	 $owner=$_GET["id"];
	 $pid=$_GET["pid"];
	 if(empty($pid) || empty($owner)){
			$owner = "";
			$pid = 66;
		}
	 
	$mysqli = new mysqli("localhost", "root", "apache", "db_library");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	
	mysqli_query($mysqli,"SET NAMES 'UTF8'");
	$query = $mysqli->query("select * from xm_lib_type where id='$pid' order by id");
	while($a = $query->fetch_array(MYSQLI_BOTH)){
		
		}
	?>  
      
	  
	
	  
			<?php
	if(0){
	?>	
		
       
        
		   <?php } ?>
        
  <tr>
  <td align="right"style="padding-right:2px;"> 
  <?php
 
Function getstr($pid)
{
$x=$pid;
$str66 = 'location="./ajax_upfiles/form_addinfo.php"';
//$str66 = 'window.open("./ajax_upfiles/form_addinfo.php","_blank")';

$str67 = 'location="upload_file.php"';
$str68 = 'location="kindeditor-4.1.7/php/form_adddoc.php"';
$str=array($str66,$str67,$str68);
Switch($x)
{
Case 66:
	Return $str[0];
	Break;
Case 67:
	Return $str[1];
	Break;
Default:
	Return $str[2];
}
}

?>

		 <span> <input id="Button01" type="button" value="新增" class="button" onclick='<?=getstr($pid)?>' />
		  <input id="Button02" type="button" value="刷新" class="button" onclick="location='#'" />
		  <input id="Button03" type="button" name="Button3" value="删除" onclick=""  class="button" /></span>
 </td>
 </tr>      
    </table>
	<?php
	$query=$mysqli->query("select * from xm_year where id<16 order by subject desc ");
	while($a=$query->fetch_array(MYSQLI_BOTH)){
	   //added by simon here
       //$f=$query->get_one("select count(*) as c from xm_lib where qid='$a[id]' and pid='$pid' and isvalid=1");
       //if($f['c']>0){
       //end
	?>
	<table  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="left" valign="top" style=" padding-right:20px;font-family:Arial, Helvetica, sans-serif; color:#C7C9C8;font-weight:bold; font-size:24px;"><?=$a['subject']?>&nbsp;&nbsp;<img src="images/yearicon.jpg" width="14" height="13" align="absmiddle" /></td>
        <td  align="left" valign="top"><table  border="0" cellspacing="0" cellpadding="0">
          <?php
		  
		 $query1=$mysqli->query("select * from xm_lib where qid='$a[id]' and pid='$pid' and owner='$owner' and isvalid=1 order by addtime desc,id desc ");
		 // $query1=$mysqli->query("select * from xm_lib  ");
		 while($b=$query1->fetch_array(MYSQLI_BOTH)){
		  ?>
		  <tr>
            <td  height="20" style="padding-left:15px;">[<?=$b['addtime']?>]&nbsp;&nbsp;&nbsp;</td>
			
			<?php if($pid!=68)
			{ ?>
			
			
   
            <td  class="autocut" style="line-height:28px">
			<a href="library-detail.php?id=<?=$b['id']?> & time=<?=$b['addtime']?> & subject=<?=$b['subject']?> & imagepath=<?=$b['imagepath']?>" target="_blank"><?=$b['subject']?></a>
			
			</td>
			<?php }
			else
			{ ?>
			
	
			<td  class="autocut">
			<?=$b['subject'] ?>
			</td>
			<?php } ?>
			
          </tr>
		  <?php } ?>
          <tr>
            <td colspan="2">- - - - - - - - - - -</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="15" colspan="2" align="center" valign="top">&nbsp;</td>
        </tr>
    </table>
	
	<?php  }?>
	
    </td>
  </tr>
</table>
<div style="position:fixed; bottom:100px;right:30px;"> <a id="gotop" href="javascript:void(0)" title="返回顶部">返回顶部</a></div>




</body>
</html>
