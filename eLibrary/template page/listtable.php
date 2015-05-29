

<?php  
      
     class Page {  
         private $each_disNums; //每页显示的条目数  
         private $nums; //总条目数  
         private $current_page; //当前被选中的页  
         private $sub_pages; //每次显示的页数  
         private $pageNums; //总页数  
         private $page_array = array (); //用来构造分页的数组  
         private $subPage_link; //每个分页的链接  
         /** 
          * 
          * __construct是SubPages的构造函数，用来在创建类的时候自动运行. 
          * @$each_disNums   每页显示的条目数 
          * @nums     总条目数 
          * @current_num     当前被选中的页 
          * @sub_pages       每次显示的页数 
          * @subPage_link    每个分页的链接 
          * @subPage_type    显示分页的类型 
          * 
          * 当@subPage_type=1的时候为普通分页模式 
          *    example：   共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页] 
          *    当@subPage_type=2的时候为经典分页样式 
          *     example：   当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页] 
          */  
         function Page($each_disNums, $nums, $current_page, $sub_pages) {  
             $this->each_disNums = intval($each_disNums);  
             $this->nums = intval($nums);  
             if (!$current_page) {  
                 $this->current_page = 1;  
             } else {  
                 $this->current_page = intval($current_page);  
             }  
             $this->sub_pages = intval($sub_pages);  
             $this->pageNums = ceil($nums / $each_disNums);  
             $this->subPage_link =$_SERVER['PHP_SELF']."?page=";;  
         }  
         /** 
          * 照顾低版本 
          */  
         /*function __construct($each_disNums, $nums, $current_page, $sub_pages, $subPage_linke) { 
             $this->Page($each_disNums, $nums, $current_page, $sub_pages, $subPage_link); 
         } 
     */  
        /* 
          __destruct析构函数，当类不在使用的时候调用，该函数用来释放资源。 
         */  
         function __destruct() {  
             unset ($each_disNums);  
             unset ($nums);  
             unset ($current_page);  
             unset ($sub_pages);  
             unset ($pageNums);  
             unset ($page_array);  
             unset ($subPage_link);  
         }  
       
        /* 
          用来给建立分页的数组初始化的函数。 
         */  
         function initArray() {  
             for ($i = 0; $i < $this->sub_pages; $i++) {  
                 $this->page_array[$i] = $i;  
             }  
             return $this->page_array;  
         }  
       
        /* 
          construct_num_Page该函数使用来构造显示的条目 
          即使：[1][2][3][4][5][6][7][8][9][10] 
         */  
         function construct_num_Page() {  
             if ($this->pageNums < $this->sub_pages) {  
                 $current_array = array ();  
                 for ($i = 0; $i < $this->pageNums; $i++) {  
                     $current_array[$i] = $i +1;  
                 }  
             } else {  
                 $current_array = $this->initArray();  
                 if ($this->current_page <= 3) {  
                     for ($i = 0; $i < count($current_array); $i++) {  
                         $current_array[$i] = $i +1;  
                     }  
                 }  
                 elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1) {  
                     for ($i = 0; $i < count($current_array); $i++) {  
                         $current_array[$i] = ($this->pageNums) - ($this->sub_pages) + 1 + $i;  
                     }  
                 } else {  
                     for ($i = 0; $i < count($current_array); $i++) {  
                         $current_array[$i] = $this->current_page - 2 + $i;  
                     }  
                 }  
             }  
       
            return $current_array;  
         }  
       
        /* 
         构造普通模式的分页 
         共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页] 
         */  
         function subPageCss1() {  
             $subPageCss1Str = "";  
             $subPageCss1Str .= "共" . $this->nums . "条记录，";  
             $subPageCss1Str .= "每页显示" . $this->each_disNums . "条，";  
             $subPageCss1Str .= "当前第" . $this->current_page . "/" . $this->pageNums . "页 ";  
             if ($this->current_page > 1) {  
                 $firstPageUrl = $this->subPage_link . "1";  
                 $prewPageUrl = $this->subPage_link . ($this->current_page - 1);  
                 $subPageCss1Str .= "[<a href='$firstPageUrl'>首页</a>] ";  
                 $subPageCss1Str .= "[<a href='$prewPageUrl'>上一页</a>] ";  
             } else {  
                 $subPageCss1Str .= "[首页] ";  
                 $subPageCss1Str .= "[上一页] ";  
             }  
       
            if ($this->current_page < $this->pageNums) {  
                 $lastPageUrl = $this->subPage_link . $this->pageNums;  
                 $nextPageUrl = $this->subPage_link . ($this->current_page + 1);  
                 $subPageCss1Str .= " [<a href='$nextPageUrl'>下一页</a>] ";  
                 $subPageCss1Str .= "[<a href='$lastPageUrl'>尾页</a>] ";  
             } else {  
                 $subPageCss1Str .= "[下一页] ";  
                 $subPageCss1Str .= "[尾页] ";  
             }  
       
            return $subPageCss1Str;  
       
        }  
       
        /* 
         构造经典模式的分页 
         当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页] 
         */  
         function subPageCss2() {  
             $subPageCss2Str = "";  
             $subPageCss2Str .= "当前第" . $this->current_page . "/" . $this->pageNums . "页 ";  
       
            if ($this->current_page > 1) {  
                 $firstPageUrl = $this->subPage_link . "1";  
                 $prewPageUrl = $this->subPage_link . ($this->current_page - 1);  
                 $subPageCss2Str .= "[<a href='$firstPageUrl'>首页</a>] ";  
                 $subPageCss2Str .= "[<a href='$prewPageUrl'>上一页</a>] ";  
             } else {  
                 $subPageCss2Str .= "[首页] ";  
                 $subPageCss2Str .= "[上一页] ";  
             }  
       
            $a = $this->construct_num_Page();  
             for ($i = 0; $i < count($a); $i++) {  
                 $s = $a[$i];  
                 if ($s == $this->current_page) {  
                     $subPageCss2Str .= "[<span style='color:red;font-weight:bold;'>" . $s . "</span>]";  
                 } else {  
                     $url = $this->subPage_link . $s;  
                     $subPageCss2Str .= "[<a href='$url'>" . $s . "</a>]";  
                 }  
             }  
       
            if ($this->current_page < $this->pageNums) {  
                 $lastPageUrl = $this->subPage_link . $this->pageNums;  
                 $nextPageUrl = $this->subPage_link . ($this->current_page + 1);  
                 $subPageCss2Str .= " [<a href='$nextPageUrl'>下一页</a>] ";  
                 $subPageCss2Str .= "[<a href='$lastPageUrl'>尾页</a>] ";  
             } else {  
                 $subPageCss2Str .= "[下一页] ";  
                 $subPageCss2Str .= "[尾页] ";  
             }  
             return $subPageCss2Str;  
         }  
     }  
       
      
    //测试一下，看看两种不同效果  
      
   // $current_page=isset($_GET['page'])?intval($_GET['page']):1;//获取用户GET提交的page，如果没有就默  
    // $t = new Page(10, 100, $current_page, 5);  
    // echo $t->subPageCss2();  
     echo "<br>";  
   //  echo $t->subPageCss1();  
     ?>  
	 
	 
 <?php
  //database connection section
 $conn = mysqli_connect("localhost","root","apache","db_library");
if(mysqli_connect_errno($conn)) {
    echo "Failed to connect to MySQL: (" . mysqli_connect_errno($conn) . ") " . mysqli_connect_error();
	}
 
?>



<?php //执行代码体


$pagetitle = "招聘管理";

$ename = "招聘";//

$table = "xm_lib";//定义连接数据库的表名

$show = "显示";

$hidden = "隐藏";

$hasisvalid = "1";
$hasorder = "1";
empty($_GET["act"])?$act="":$act=$_GET["act"];



if($act == 'add'){
	$burl = " - 添加".$ename;
}elseif($act == 'edit'){
	$burl = " - 编辑".$ename;
}

if(isset($keyword)){
	$burl = " - 搜索结果";
}

$isfile="on"; //是否有上传文件

$do_search="1";

if($act == 'edit_save'){

	$sql = "";

	$db->query("update $table set 
	subject='$subject' , 
 	nums='$nums', 
 	areas='$areas', 
 	 
 	adddate='$adddate', 
 	ends='$ends', 
 	order='$order', 
 	isvalid='$isvalid', 
 	content='$content'
	where id='$id'");
	
	
	$links[0]['text']="返回列表";
	$links[0]['href']="?page=$page&keyword=$keyword";
	$links[1]['text']="查看编辑结果";
	$links[1]['href']="?act=edit&id=$id&page=$page&keyword=$keyword";
	
	echo("编辑成功");

}elseif($act == 'add_save'){
	
	
	$sql = "";
	
	$db->query($sql);
	
	
	$links[0]['text']="返回列表";
	$links[0]['href']="?";
	$links[1]['text']="继续添加";
	$links[1]['href']="?act=add";
	
	echo("添加成功");

	
}elseif($act == 'del'){
	if(!empty($moderate)){ //moderate在后面表单中定义 type="checkbox" name="moderate[]"
		if(is_array($moderate)) $moderate =implode('\',\'', $moderate);
		
		$ids=str_replace("'","",$moderate);
		
		$db->query("delete from $table where  id in($ids)");
		$links[0]['text']="返回列表";
		$links[0]['href']="?";
		
		echo("删除成功");
		
	}else{
		$links[0]['text']="返回列表";
		$links[0]['href']="?";
		
		echo("请选择要删除的记录");
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - <?=$pagename?> </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<script src="js/utils.js"></script>
</head>
<body>
<h1>
<span class="action-span" onclick="window.location='?<?=empty($act)?"act=add":""?>'" style="cursor:hand;float:right;">
<?php

 //remove this part later
$ename = "东东";
$pagetitle = "pagetitle";
$burl = "操作".$ename;//显示在文件导航栏右边
$do_search = "1";//搜索栏显示开关，0不显示 1显示搜索区域
$keyword="";
$isfile = "on";//
?>
<?php
if(empty($act) && empty($keyword)){
?>
<a href="?act=add">添加<?=$ename?></a>
<?php
}else{
?>
<a href="?">返回列表</a>
<?php
}
?>
</span>
<span class="action-span1"><a href="admin_index.php">管理中心</a>  - <?=$pagetitle?><?=$burl?> </span>
<div style="clear:both"></div>
</h1>
<?php
if($do_search){
?>
<div class="form-div">
  <form action="?acts=search" name="searchForm" method="get">
  <input type="hidden" name="acts" value="search" />
  <input type="hidden" name="pagerows" value="<?=$pagerows?>" />
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    标题 
    <input type="text" name="keyword" value="<?=trim($keyword)?>" size="15" />
    <input type="submit" value=" 搜索 " class="button" />
  </form>
</div>
<?php
}
if(empty($act) || ($keyword && $act!='edit')){
?>
<form method="post" action="?act=del" name="listForm">
<div class="list-div" id="listDiv">
<table width="500" cellspacing="1" cellpadding="2" id="list-table">
<tr>
<th width="10" align="center"><nobr>选择</nobr></th>
<th width="60">column01</th>
<th width="60">column02</th>
<th width="63">column03</th>
<th width="63">column04</th>
<th width="75">column05</th>
<th width="73">column06</th>
<th width="11">column07</th>
<th width="60">status</th>
</tr>

<?php
$conn = mysqli_connect("localhost","root","apache","db_library");
if(mysqli_connect_errno($conn)) {
    echo "Failed to connect to MySQL: (" . mysqli_connect_errno($conn) . ") " . mysqli_connect_error();
}
	
//	mysqli_query($mysqli,"SET NAMES 'UTF8'");


$limit=" where 1=1 ";

if($keyword){
	$limit.=" and subject like '%".trim($keyword)."%' ";
}

$sql = "select count(*) as c from $table  $limit";

if($hasorder){
	$order_str = " adddate desc, ";
}

$pages=0;
$counts=0;
$totalrows=0;
$pagerows=10;
$displaypages=0;


$rs=mysqli_query($conn,"SELECT * FROM $table");

$totalrows=mysqli_num_rows($rs);
$counts=$totalrows;

$pages=ceil($totalrows/$pagerows);

$current_page=isset($_GET['page'])?intval($_GET['page']):1;//是否page有值，没有就默认为1
$offset=$pagerows*($current_page-1);
$query=mysqli_query($conn,"SELECT * FROM $table limit $offset,$pagerows");
while($a=mysqli_fetch_array($query,MYSQLI_BOTH)){
?>
<tr>
<td align="center"><input type="checkbox" name="moderate[]" value="<?=$a['id']?>"></td>
<td height="22" align="left">&nbsp;<span> 
<a href="?act=edit&id=<?=$a['id']?>&current_page=<?=$current_page?>&acts=<?=$acts?>&keyword=$keyword"><?=$a['subject']?></a></span> </td>
<td align="center"><?//=$a['nums']?></td>
<td align="center"><?//=$a['areas']?></td>
<td align="center"><?//=$a['adddate']?></td>
<td align="center"><?//=$a['order']?></td>
 <td align="center"><?//=$a['isvalid']==1?"$show":"<font color=red>$hidden</font>"?></td>
</tr>
 

<?php
}
if($counts){
?>	
<tr><td colspan="9"><table  border="0" cellspacing="0" cellpadding="0"> 
     <tr> 
       <td width="" bgcolor="#FFFFFF" style="padding-left:17px;"><input type="checkbox" name="chkall" onClick="javascript:CheckAll(this.form)"> <input name="Submit4" type="submit" class="button"  value="执行删除"   onclick="if(!confirm('确定要删除吗?')){return false;}" /></td> 
       <td width="" align="right" style="padding-right:10px;"><?php   
     $pagezone = new Page(10, 100, $current_page, 5);  
     echo $pagezone->subPageCss2();  
      ?></td> 
     </tr> 
   </table></td></tr>

<?php
}else{
?>
<tr><td colspan="9" height="30" style=" padding:10px 0px 10px 30px; color:#660000"><?=$keyword?"搜索不到相关记录":"暂时没有记录"?></td></tr>
<?php
}
?>
  </table>

</div>
</form>
<?php
}
if($act == 'edit'){


$id=$_GET['id'];
	$one=mysqli_query($conn,"select * from $table where id='$id'");//从数据库中按id来提取指定记录
	$a=mysqli_fetch_array($one);
?>
<form action="?act=edit_save" method="post" name="listForm" <?=$isfile?'enctype="multipart/form-data"':''?> id="listForm">
<input type="hidden" id="id" name="id" value="<?=$id?>" />
<input type="hidden" id="page" name="page" value="<?=$page?>" />
<input type="hidden" id="keyword" name="keyword" value="<?=$keyword?>" />
<input type="hidden" id="acts" name="acts" value="<?=$acts?>" />
  <div class="list-div" id="div">
     <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
      <tr>
        <th colspan="2" align="left">编辑<?=$ename?></th>
      </tr>
      <tr>
<td align=right>招聘对象：</td><td><input name="subject" type="text"  class='must_input'  id="subject" value="<?=$a['subject']?>" /></td>
</tr>
<tr>
<td align=right>招聘人数：</td><td><input name="nums" type="text"  class='input'  id="nums" value="<?=$a['nums']?>" /></td>
</tr>
<tr>
<td align=right>工作地点：</td><td><input name="areas" type="text"  class='input'  id="areas" value="<?=$a['areas']?>" /></td>
</tr>
<tr>
<td align=right>招聘部门：</td><td><input name="daiyu" type="text"  class='input'  id="daiyu" value="<?=$a['daiyu']?>" /></td>
</tr>
<tr>
<td align=right>发布日期：</td><td><input name="adddate" type="text"  class='input'  id="adddate" value="<?=$a['adddate']?>" /></td>
</tr>
<tr>
<td align=right>有效期限：</td><td><input name="ends" type="text"  class='input'  id="ends" value="<?=$a['ends']?>" /></td>
</tr>
<tr>
<td align=right>排序号：</td><td><input name="orders" type="text"  class='input'  id="orders" value="<?=$a['orders']?>" /></td>
</tr>
<tr>
<td align=right>显示状态：</td><td>
<select name="isvalid" id="isvalid">
 
           <option value="1" <?=$a['isvalid']==1?"selected":""?>><?=$show?></option>
 
<option value="0" <?=$a['isvalid']==0?"selected":""?>><?=$hidden?></option>
 
         </select>
</td>
</tr>
<tr>
<td align=right valign=top>招聘要求：</td><td><? fck( $a['content']);?></td>
</tr>

      <tr>
        <td>&nbsp;</td>
        <td><input name="Submit3" type="submit" class="button" value="提交" onclick="return checkfill()" />
 　          
 <input name="Submit22" type="reset" class="button" value="重置" /></td>
      </tr>
    </table>
  </div>
</form>
<?php
}elseif($act == 'add'){
?>

<form method="post" action="?act=adds" <?=$isfile?'enctype="multipart/form-data"':''?>  name="listForm">
<div class="list-div" id="listDiv">
<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
  <tr>
    <th colspan="2" align="left">添加<?=$ename?></th>
  </tr>
  <tr>
<td align=right>招聘对象：</td><td><input name="subject" type="text"  class='must_input'  id="subject" value="<?=$a['subject']?>" /></td>
</tr>
<tr>
<td align=right>招聘部门：</td><td><input name="daiyu" type="text"  class='input'  id="daiyu" value="<?=$a['daiyu']?>" /></td>
</tr>
<tr>
<td align=right>招聘人数：</td><td><input name="nums" type="text"  class='input'  id="nums" value="<?=$a['nums']?>" /></td>
</tr>
<tr>
<td align=right>工作地点：</td><td><input name="areas" type="text"  class='input'  id="areas" value="<?=$a['areas']?>" /></td>
</tr>
<tr>
<td align=right>发布日期：</td><td><input name="adddate" type="text"  class='input'  id="adddate" value="<?=date("Y-m-d H:i:s")?>" /></td>
</tr>
<tr>
<td align=right>有效期限：</td><td><input name="ends" type="text"  class='input'  id="ends" value="<?=$a['ends']?>" /></td>
</tr>
<tr>
<td align=right>排序号：</td><td><input name="orders" type="text"  class='input'  id="orders" value="0" /></td>
</tr>
<tr>
<td align=right>显示状态：</td><td>
<select name="isvalid" id="isvalid">
 
           <option value="1"><?=$show?></option>
 
<option value="0"><?=$hidden?></option>
 
         </select>
</td>
</tr>
<tr>
<td align=right valign=top>招聘要求：</td><td><? fck( $a['content']);?></td>
</tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="提交" class="button" onclick="return checkfill()"  />
       　 
       <input type="reset" name="Submit2" value="重置" class="button"/></td>
  </tr>
</table>
</div>
</form>
<?php 
}
?>
</body>
</html>