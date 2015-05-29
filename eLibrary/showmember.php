<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="jquery-easyui-1.3.6/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="jquery-easyui-1.3.6/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="jquery-easyui-1.3.6/demo.css">
	<script type="text/javascript" src="jquery-easyui-1.3.6/jquery.min.js"></script>
	<script type="text/javascript" src="jquery-easyui-1.3.6/jquery.easyui.min.js"></script>
	<title>	Basic member properties</title>

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

<div id="main" style="margin-left:200px;padding:30px 30px">

	<style>
	dd { display:none; }  
   dl:hover dd { display:block; } 
	#box{position:absolute;
	top:0;
	left:300px;}
	</style>
	<div>
	
<dl style="width:166px;">  
        <dt id="opt">选项</dt>  
        <dd><a href="#">编辑个人信息</a></dd>  
        <dd><a href="showmember.php" target="_blank"> 查看成员档案</a></dd> 
        <dd><a href="javascript:history.go(-1);">返回上页</a></dd>  
</dl>  
</div>
	<div style="margin:20px 0 10px 0;"></div>
	<div class="easyui-tabs" style="width:800px;height:690px;overflow-y:auto;">
		<div title="About" data-options="iconCls:'icon-help',closable:true" style="padding:10px">
			<p style="font-size:14px">成员基本属性.</p>
			<ul>
				<li>本页面提供关于家庭成员档案基本信息.包括姓名、生日、身高、体重、个人简历等内容信息</li>
				<li>.</li>
				<li>.</li>
				<li>.</li>
				<li>.</li>
				<li>.</li>
			</ul>
		</div>
		<?php
		 //数据库连接及参数初始化********************************** 
$link = mysql_connect( 'localhost', 'root', 'apache') or die('Could not connect to mysql server.' );
        mysql_select_db('db_library', $link) or die('Could not select database.');
       // echo "connected to mysql server ok.";
		
mysql_query("set names utf8");
 $sql="select * from tb_user  ";
 $datas=mysql_query($sql);

 while($a=mysql_fetch_array($datas))
		
		{ ?>
		<div title="<?php echo $a['UserName']; ?> info" data-options="iconCls:'icon-help',closable:true" style="padding:10px">
			
			   	  
    	  <table id="t1" width="100%"  border="1">
           <form action="" method="post">
            <tr>
              <td>Avatar</td>
              <td><img src="<?php echo $a['Avatar'];?>" width="80px" height="80px" />&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Fullname:</td>
              <td><input type="text" name="<?php echo $a['UserName']; ?>fullname" value="<?php echo $a['UserName']; ?>" /></td>
            </tr>
            <tr>
              <td>Gender:</td>
              <td>
                <input type="radio" name="<?php echo $a['UserName']; ?>radiogender" value="1" <?php echo (($a['Gender']==1)? 'checked':'unchecked'); ?>/>
                male   
                <input type="radio" name="<?php echo $a['UserName']; ?>radiogender" value="0" <?php echo (($a['Gender']==0)? 'checked':'unchecked'); ?>/>
                female
              </td>
            </tr>
            <tr>
              <td>Birthday:</td>
              <td><label>
                <input type="text" name="<?php echo $a['UserName']; ?>textbirthday" value="<?php echo $a['Birthday']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td>Height:</td>
              <td><label>
                <input type="text" name="<?php echo $a['UserName']; ?>textheight" value="<?php echo $a['Height']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td>Weight:</td>
              <td><label>
                <input type="text" name="<?php echo $a['UserName']; ?>textweight" value="<?php echo $a['Weight']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Passport:</td>
              <td><input type="hidden" name="<?php echo $a['UserName']; ?><?php echo $a['UserName']; ?>hiddenpassport" /></td>
            </tr>
            <tr>
              <td>ID:</td>
              <td><input type="hidden" name="<?php echo $a['UserName']; ?>hiddenid" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Tel:</td>
              <td><label>
                <input type="text" name="<?php echo $a['UserName']; ?>texttel" value="<?php echo $a['Tel']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td>Cellphone:</td>
              <td><label>
                <input type="text" name="<?php echo $a['UserName']; ?>textcellphone" value="<?php echo $a['Cellphone']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td>Email:</td>
              <td><a href="mailto:<?php echo $a['Email']; ?>"><?php echo $a['Email']; ?></a></td>
            </tr>
            <tr>
              <td>WeChat:</td>
              <td>
                <input type="text" name="<?php echo $a['UserName']; ?>textwechat" />
              </td>
            </tr>
            <tr>
              <td>QQ:</td>
              <td>
                <input type="text" name="<?php echo $a['UserName']; ?>textqq" value="<?php echo $a['QQ']; ?>" />
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Description:</td>
              <td>
                <textarea name="<?php echo $a['UserName']; ?>textdescription" rows="3" ></textarea>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            
            </form>
          </table>
   	  					
		</div>
		<?php } ?>
		
	</div>
	
	</div>

<div id="right"></div>
</body>
</html>