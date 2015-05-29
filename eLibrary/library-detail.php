
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


</head>
<body>

<style>
html,body{margin:0;
height:100%}
#left,#right{position:absolute;
top:0;
width:200px;
height:100%;}
#left{left:0;
background:#a0b3d6;}
#right{right:0;
background:#a0b3d6;}
#main{}
</style>
<div id="left"></div>

<div id="main">
<!-- top menu  支持 chrome firefox -->
<style>
*{
	margin:0;
	padding:0;
}
.clear:after {
    clear: both;
    content: ".";
    display: block;
    height: 0;
    visibility: hidden;
}
nav{
	display:inline-block;
	border:1px solid #505255;
	border-bottom: 1px solid #282C2F;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	margin:5px;
	-webkit-box-shadow:1px 1px 3px #292929;
    -moz-box-shadow:1px 1px 3px #292929;
}
li{
	list-style:none;
	float:left;
	border-right: 1px solid #2E3235;
	position: relative;
	/*background: -moz-linear-gradient(top, #fff, #555D5F 2% ,#555D5F  50%,#3E4245 100%);
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), color-stop(2%, #555D5F), color-stop(50%, #555D5F),to(#3E4245));*/
	background:#555D5F;
}
li:hover{
	/*background: -moz-linear-gradient(top, #fff, #3E4245 2% ,#555D5F  80%,#555D5F 100%);
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), color-stop(2%, #3E4245), color-stop(80%, #3E4245),to(#555D5F));*/
	background:#3E4245;
	-moz-transition: background 1s ease-out;
	-webkit-transition: background 1s ease-out;
}
li a{
	display:block;
	height:40px;
	line-height:40px;
	padding:0 30px;
	font-size:12px;
	color:#fff;
	text-shadow: 0px -1px 0px #000;
	text-decoration:none;
	white-space:nowrap;
	border-left: 1px solid #999E9F;
    border-top: 1px solid #999E9F;
	-moz-border-top-left-radius: 2px;
	-webkit-border-top-left-radius: 2px;
	
	z-index:100;
}
li > a{
	position:relative;
}
li.first a{
	-moz-border-radius-topleft: 4px;
	-moz-border-radius-bottomleft: 4px;
	-webkit-border-top-left-radius: 4px;
	-webkit-border-bottom-left-radius: 4px;
}
li.last{
	border-right: 0 none;
}


dl{
	position:absolute;
	display:block;
	top:40px;
	left: -25px;
	
	width:165px;
	
	background:#222222;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	
	-webkit-box-shadow:1px 1px 3px #292929;
    -moz-box-shadow:1px 1px 3px #292929;
	
	z-index:10;
            
}
li:hover dl{
	top:50px;
	display:block;
	width:145px;
	padding:10px;
}
dl a{
	background:transparent;
	border:0 none;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-transition: background 0.5s ease-out;
	-webkit-transition: background 0.5s ease-out;
	
	z-index:50;
}
dl a:hover{
	color:#FFF;
	background:#999E9F;
	-moz-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
	-webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
}
dd{
	margin-top:-40px;
	opacity:0;
	width:145px;
	-webkit-transition-property:all;
	/*-webkit-transition-timing-function: cubic-bezier(5,0,5,0);*/
	-moz-transition-property: all;
	/*-moz-transition-timing-function: cubic-bezier(5,0,5,0);*/
	/*-webkit-transition-delay:5s;
	-moz-transition-delay:5s;*/
}
li:hover dd{
	margin-top:0;
	opacity:1;
}
li dd:nth-child(1){
	-webkit-transition-duration: 0.1s;
	-moz-transition-duration: 0.1s;
}
li dd:nth-child(2){
	-webkit-transition-duration: 0.2s;
	-moz-transition-duration: 0.2s;
}
li dd:nth-child(3){
	-webkit-transition-duration: 0.3s;
	-moz-transition-duration: 0.3s;
}
li dd:nth-child(4){
	-webkit-transition-duration: 0.4s;
	-moz-transition-duration: 0.4s;
}
dt{
	display:none;
	margin-top:-25px;
	padding-top:15px;
	height:10px;
}
li:hover dt{
	display:block;
}
.Darrow{
	float:right;
	margin:18px 10px 0 0;
	border-width:5px;
	border-color:#FFF transparent transparent transparent;
	border-style:solid;
	width:0;
	height:0;
	line-height:0;
	overflow:hidden;
	
	cursor:pointer;
	
	text-shadow: 0px -1px 0px #000;
	
	-webkit-box-shadow:0px -1px 0px #000;
    -moz-box-shadow:0px -1px 0px #000;
}
.arrow{
	margin:0 auto;
	margin-top:-5px;
	display:block;
	width:10px;
	height:10px;
	background:#222222;
	-webkit-transform: rotate(45deg);
	-moz-transform: rotate(45deg);
}
</style>

<!-- top menu -->
<nav>
	<ul class="clear">
    	<li class="first"><a href="index.html">首页</a></li>
        <li>
        	<span class="Darrow"></span>
            <a href="#">选项</a>
        	<dl>
            	<dt><span class="arrow"></span></dt>
                <dd><a href="#">修改个人信息</a></dd> 
                <dd><a href="#">查看个人信息</a></dd>
                
            </dl>
        </li>
        <li>
        	<span class="Darrow"></span>
            <a href="#">档案管理</a>
        	<dl>
            	<dt><span class="arrow"></span></dt>
                <dd><a href="cstype.php?func=showtype">档案分类</a></dd>
                
                <dd><a href="/ajax_upfiles/form_addinfo.php">档案添加</a></dd>
				<dd><a href="#">档案编辑</a></dd>
            </dl>
        </li>
        
               <li><a href="#">档案查询</a></li>
       
        <li class="last"><a href="#">帮助</a></li>
    </ul>
</nav>
</div>

<!-- top menu end -->

<?php 
$addtime=$_GET['time'];
$subject=$_GET['subject'];
$imagepath=$_GET['imagepath'];
?>
<table  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/history.jpg" width="100%" height="188" /></td>
  </tr>
</table>

<div style="margin-left: 20%; ">
<table  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100" height="300" align="left" valign="top" background="images/pbg4.jpg"><table width="100" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
	<?php
	
	$mysqli = new mysqli("localhost", "root", "apache", "db_library");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	$i=0;
	mysqli_query($mysqli,"SET NAMES 'UTF8'");
	$query = $mysqli->query("select * from xm_lib_type where id!='69' order by id");
	while($a = $query->fetch_array(MYSQLI_BOTH)){
		$i++;
		if(empty($pid) && $i==1){
			$pid = $a['id'];
		}
	?>  
      <tr>
        <td height="28" class="<?=$pid==$a['id']?"subc":"subnoc"?>"><div>
		<a href="library.php?pid=<?=$a['id']?>"><?=$a['subject']?></a>
		</div></td>
      </tr>
	 <?php } ?> 
	  
    </table>
	<table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="40">&nbsp;</td>
        </tr>
			<?php
	if(0){
	?>	
		
        <tr>
          <td height="38" align="right" style="padding-right:2px;"><a href="nav.php" class="lightwindow"><img src="images/navigator.jpg" width="161" border="0" /></a></td>
        </tr>
        
		   <?php } ?>
        
    </table>
	
    </td>
    <td align="left" valign="top" style="padding-top:20px; padding-left:20px; padding-right:20px;">
	
	<table  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td align="center" style="float:none;"><a href="map.php" ><img src="<?=$imagepath?>" width="500" height="366" border="2" /></a></td>
        </tr><tr>
        <td height="20" style="color:#00A13E; font-size:12px; font-family:Arial, Helvetica, sans-serif">Last Updated <?=str_replace("-",".",$addtime)?> </td>
      </tr>
      <tr>
        <td height="28" class="bt"><?=$subject?></td>
      </tr>
      <tr>
        <td><hr size="1" color="#CCCCCC" /></td>
      </tr>
      <tr>
        <td height="200" valign="top" class="content"  >
		<?//=iconv("utf-8","utf-8",file_get_contents("doc/passcard.txt"));?>
		</td>
      </tr>
	  
	  <tr><td style="padding-top:10px; overflow:auto;"><!---begin--->
<style type="text/css">
*{margin:0;padding:0;}	
body { font-size: 13px; line-height: 130%; padding: 60px }
#panel { width: 500px; border: 1px solid #0050D0 }
.head { padding: 5px; background: #96E555; cursor: pointer }
.content { padding: 10px; text-indent: 2em; border-top: 1px solid #0050D0;display:block; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
</script>
<script type="text/javascript">
$(function(){
    $("#panel h5.head").click(function(){
	     $(this).next("div.content").slideToggle();
	})
})
</script>


<div id="panel">
	<h5 class="head">Specification</h5>
	<div class="content" >
		
		<table border="1px solid black" style="border-collapse:collapse; table-layout:fixed; " >
		        <tr><td>档案编号：</td><td></td></tr>
				<tr><td>档案名称：</td><td><?=$subject?></td></tr>
		        <tr><td>归档日期：</td><td>Last Updated <?=str_replace("-",".",$addtime)?></td></tr>
		        <tr><td>存放位置：</td><td></td></tr>
		        <tr><td>安全级别：</td><td></td></tr>
			    <tr><td>有效期：</td><td></td></tr>
		        <tr><td>档案描述：</td><td><?//=iconv("utf-8","utf-8",file_get_contents("doc/passcard.txt"));?>
</td></tr>
		        <tr><td>档案加密：</td><td></td></tr>
		        <tr><td>档案备注：</td><td></td></tr>


		</table>
	</div>
</div>
<!---end---></td></tr>
    </table></td>
  </tr>
</table>
</div>


<div style="height:300px"> </div>
<p align="center"><button class="btn" onclick="javascript:window.close();">关闭</button></p>  
<br />
<p align="center"><?php echo "Copyright © 2014 HM.COM. All Rights Reserved."; ?><img src="images/logo.gif" width="32" height="32" align="absmiddle" /></p>

</div>

<div id="right"></div>
</body>
</html>
