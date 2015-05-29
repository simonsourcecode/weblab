
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<style>
html,body{margin:0;
height:auto;}
#left,#right{

position:absolute;
top:0;
width:20%;
height:auto;}
#left{left:0;
background:#a0b3d6;}
#right{right:0;
background:#a0b3d6;}
#main{}
</style>
<div id="left"></div>

<div id="main" style="min-width:300px;overflow:scroll;">
<div>
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
                
                <dd><a href="./ajax_upfiles/form_addinfo.php">添加档案</a></dd>
				 <dd><a href="./kindeditor-4.1.7/php/form_adddoc.php">添加文档</a></dd>
				<dd><a href="#">编辑文档</a></dd>
				<dd><a href="http://localhost/elibrary/kindeditor-4.1.7/examples/file-dialog.html">上传文件</a></dd>
            </dl>
        </li>
        
               <li><a href="addplace.php">库位管理</a></li>
       
        <li class="last"><a href="#">帮助</a></li>
    </ul>
</nav>
</div>

<!-- top menu end -->
<div id="searchbox" style="margin-left:300px; padding:30px 30px;" >
<form method="post" action="searchsite.php">
<input type="text" name="key"  placeholder="input here to search in site" style="width:300px;height:33px;border:2px solid #a1a1a1;border-radius:9px;"> 
<input type="submit" value=""  style="vertical-align:middle;height:33px; width:33px;border-radius:9px;border:1px; background-image:url(images/s.JPG) ; background-repeat:no-repeat; background-position:center"  />
</form> 
</div>

 


<!--<div>
--begin--
    

        <style type="text/css">
           
            #content{width: 300px; height: 300px; border-radius: 150px; overflow:hidden; margin: 80px auto 0px;  position: relative;}
            #mask{width: 300px; height: 300px; position: absolute; top: 0px; left: 0px; *background: url(http://images.cnblogs.com/cnblogs_com/kuikui/354173/r_round.png) center no-repeat;background: url(http://images.cnblogs.com/cnblogs_com/kuikui/354173/r_round.png) center no-repeat\0; z-index:999}
            #box{position: absolute; left:0px; top: 0px;}
            #box img{width:800px; height: 300px;}
            #box .img1{position: absolute; top: 0px; left: 0px;}
            #box .img2{position: absolute;top:0px; left: 800px;}
        </style>
    
        <div id="content">
            <div id="mask"></div>
            <div id="box">
                <img class="img1" alt="" src="images/r_earth.jpg" />
                <img class="img2" alt="" src="images/r_earth.jpg" />
            </div>
        </div>
        <script type="text/javascript">
            function $(id){return document.getElementById(id);}
            var content = $("content");
            var oBox = $("box");
            var oBoxImg = oBox.getElementsByTagName("img")[0];
            var oBoxImgW = oBoxImg.clientWidth;
            var step = 0;
            var auto;
            function moving(){
                auto = setInterval(function(){
                    step--;
                    if(oBox.offsetLeft<=-oBoxImgW){
                        step=0;
                    }
                    oBox.style.left=step+"px";
                },60);
            }
            
            moving();
            
            content.onmousemove=function(event){
                if(!(navigator.appVersion.match(/9./i)=="9.")&&(navigator.appVersion.match(/MSIE/gi)=="MSIE")){
                    event = event || window.event;
                    var x = event.offsetX;
                    var y = event.offsetY;
                    var tmp =Math.abs(x-150)*Math.abs(x-150)+Math.abs(y-150)*Math.abs(y-150);
                    if(tmp<150*150){
                        clearInterval(auto);
                    }
                }
                else{
                    clearInterval(auto);
                }
            }
            
            content.onmouseout=function(){
                moving();
            }
        </script>
   

       
    --end--
</div><-->

<table style="margin-left:166px;margin-right:160px;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" frame="box">
	<tr><td></td></tr>
      <tr>
        <td align="left"><?php $imagepath="images//".$_GET["id"].".jpg" ?><a href="showmember.php"><img src=<?php echo $imagepath; ?> width="99" height="88" align="absmiddle" /></a></td>
      </tr>
	  <ul style="position:fixed;left:160px;display:block;list-style-image:url(images/rightarrow.png);">
	<?php
	 $owner=$_GET["id"];
	 
	$mysqli = new mysqli("localhost", "root", "apache", "db_library");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	$i=0;
	mysqli_query($mysqli,"SET NAMES 'UTF8'");
	$query = $mysqli->query("select * from xm_lib_type where id!='67' order by id");
	while($a = $query->fetch_array(MYSQLI_BOTH)){
		$i++;
		
			$pid = $a['id'];
		
	?>  
      <tr>
	  
        <td height="28" class="<?=$pid==$a['id']?"subc":"subnoc"?>" align="center">
		<div>
		<!--<li style="position:fixed;left:200px;color:#00ccff"><img src="<?=$a['imagepath']?>" width="32" height="32"/><a href="library.php?pid=<?=$a['id']?>"><?=$a['subject']?>(mysqli_num_rows())</a></li>-->
		
		<!--cursor:pointer将鼠标形状定义为手形-->
		<li style="float:left;color:#00ccff;cursor:pointer; background-image:url(<?=$a["imagepath"]?>);">
		<a  onclick="window.parent.frames['listframe'].location.href='list.php?id=<?=$owner?> & pid=<?=$a['id']?>'"><?=$a['subject']?>(<?=mysqli_num_rows($mysqli->query("select * from xm_lib where pid='$pid' and owner='$owner' and isvalid='1' order by addtime desc,id desc "))?>)</a></li>
		</div></td>
      </tr>
	  
	 <?php } ?> 
	<tr><td> <li style="float:none;color:#00ccff;cursor:pointer"><a onclick="window.parent.frames['listframe'].location.href='upload_file.php'">文档</a></li>
	</td></tr>
	  </ul>
    </table>
	
	
    </td>
    <td align="left" valign="top" style="padding-top:20px;">
	<iframe name="listframe" id="listframe" src="chart.php" width="880" height="660" frameborder="1" scrolling="auto">
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
        <tr>
          <td align="right"style="padding-right:2px;"> 
		  
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
		  //80 is error line
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
	
  </iframe>
    </td>
  </tr>
</table>
<div style="position:fixed; right:30px; bottom:30px;"> <a id="gotop" href="javascript:void(0)" title="返回顶部">返回顶部</a></div>

<p align="center"><?php echo "Copyright © 2014 HM.COM. All Rights Reserved."; ?><img src="images/logo.gif" width="32" height="32" align="absmiddle" /></p>

</div>

<div id="right"></div>

</body>
</html>
