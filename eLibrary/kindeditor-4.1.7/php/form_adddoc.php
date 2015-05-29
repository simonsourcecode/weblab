<?php
	$htmlData = ''; 
	if (!empty($_POST['content1'])) {
		if (get_magic_quotes_gpc()) {
			$htmlData = stripslashes($_POST['content1']);
		} else {
			$htmlData = $_POST['content1'];
		}
	}
	
	

?>	

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>KindEditor PHP</title>
	<link rel="stylesheet" href="../themes/default/default.css" />
	<link rel="stylesheet" href="../plugins/code/prettify.css" />
	<script charset="utf-8" src="../kindeditor.js"></script>
	<script charset="utf-8" src="../lang/zh_CN.js"></script>
	<script charset="utf-8" src="../plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : '../plugins/code/prettify.css',
				uploadJson : '../php/upload_json.php',
				fileManagerJson : '../php/file_manager_json.php',
				allowFileManager : true,
				
				//width: "98%",
                height: "300px",
                dialogAlignType:"", //设置弹出框(dialog)的对齐类型，可设置page和空。指定page时按当前页面居中，指定空时按编辑器居中。数据类型：String 默认值：page


				
				afterBlur: function(){this.sync();//很重要，折腾了我好久，没有此行，将无法提交content1到mysql数据库的
				
				},
				
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
</head>
<body>
<h1>媒体库</h1>
<br><br><br>
<style>
html,body{margin:0;
height:auto;}
#left,#right{position:absolute;
top:0;
width:2%;
height:auto;}
#left{left:0;
background:#a0b3d6;}
#right{right:0;
background:#a0b3d6;}
#main{}
</style>
<div id="left"></div>

<div id="main" style="margin-left:2%; ">
 <?php  echo $htmlData;  ?>
	
	<table cellpadding="10">
	<form name="example" method="post" action="form_adddoc.php">
	
	<tr><td>  <label for='title'>
	  标题:</label> </td>
	<td>
 <input type="text" name="title" id="title"  x-webkit-speech="" lang="zh-CN" required="required"/></td></tr>
 <tr><td>  <label for='class'>档案分类:</label> </td><td>
 <select name="class">
  <option value="0">请选择...</option>
  <option value="3">图片</option>
  <option value="4">音频</option>
  <option value="5">视频</option>
</select></td></tr>
		<tr><td>  <label for='content1'>内容:</label> </td><td>
		<textarea name="content1" id="content1" style="width:600px;height:200px;visibility:hidden;">
		<?php echo htmlspecialchars($htmlData); ?></textarea></td></tr>
		<tr><td>  <label for='status'>状态:</label> </td><td>
 <input type="radio" name="status" id="status"  value="0" checked="checked" />
 <input type="radio" name="status" id="status" value="1" /></td></tr>
		
		<input type="submit" name="submit" value="Save" /> (提交快捷键: Ctrl + Enter)
	</form>
	</table>

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
?>

<script>document.getElementById("content1").value=editor1.html();</script><!--取得textarea编辑内容的html代码-->

<?php
if(isset($_POST["submit"]))   {

$sqlstr="INSERT INTO xm_lib (subject,parentclass,content,updatedate)
VALUES('$_POST[title]','$_POST[class]','$_POST[content1]',NOW())";
//echo $sqlstr;

$mysqli->set_charset("uft8");
if (!mysqli_query($mysqli,$sqlstr))
  {
  die('Error description: ' . mysqli_error($mysqli));
  }
echo "1 record added. <br /><br /><br />";

mysqli_close($mysqli);

//include_once("log.php"); // write to log file elibrary.log.

echo "<a href=form_adddoc.php>继续添加</a>&nbsp;&nbsp;&nbsp;";
echo "<a href=index.html>返回首页</a>";

}
?>

<p>list of documents</p>	
</div>

<div id="right"></div>

</body>
</html>

