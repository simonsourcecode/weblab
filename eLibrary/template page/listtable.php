

<?php  
      
     class Page {  
         private $each_disNums; //ÿҳ��ʾ����Ŀ��  
         private $nums; //����Ŀ��  
         private $current_page; //��ǰ��ѡ�е�ҳ  
         private $sub_pages; //ÿ����ʾ��ҳ��  
         private $pageNums; //��ҳ��  
         private $page_array = array (); //���������ҳ������  
         private $subPage_link; //ÿ����ҳ������  
         /** 
          * 
          * __construct��SubPages�Ĺ��캯���������ڴ������ʱ���Զ�����. 
          * @$each_disNums   ÿҳ��ʾ����Ŀ�� 
          * @nums     ����Ŀ�� 
          * @current_num     ��ǰ��ѡ�е�ҳ 
          * @sub_pages       ÿ����ʾ��ҳ�� 
          * @subPage_link    ÿ����ҳ������ 
          * @subPage_type    ��ʾ��ҳ������ 
          * 
          * ��@subPage_type=1��ʱ��Ϊ��ͨ��ҳģʽ 
          *    example��   ��4523����¼,ÿҳ��ʾ10��,��ǰ��1/453ҳ [��ҳ] [��ҳ] [��ҳ] [βҳ] 
          *    ��@subPage_type=2��ʱ��Ϊ�����ҳ��ʽ 
          *     example��   ��ǰ��1/453ҳ [��ҳ] [��ҳ] 1 2 3 4 5 6 7 8 9 10 [��ҳ] [βҳ] 
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
          * �չ˵Ͱ汾 
          */  
         /*function __construct($each_disNums, $nums, $current_page, $sub_pages, $subPage_linke) { 
             $this->Page($each_disNums, $nums, $current_page, $sub_pages, $subPage_link); 
         } 
     */  
        /* 
          __destruct�������������಻��ʹ�õ�ʱ����ã��ú��������ͷ���Դ�� 
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
          ������������ҳ�������ʼ���ĺ����� 
         */  
         function initArray() {  
             for ($i = 0; $i < $this->sub_pages; $i++) {  
                 $this->page_array[$i] = $i;  
             }  
             return $this->page_array;  
         }  
       
        /* 
          construct_num_Page�ú���ʹ����������ʾ����Ŀ 
          ��ʹ��[1][2][3][4][5][6][7][8][9][10] 
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
         ������ͨģʽ�ķ�ҳ 
         ��4523����¼,ÿҳ��ʾ10��,��ǰ��1/453ҳ [��ҳ] [��ҳ] [��ҳ] [βҳ] 
         */  
         function subPageCss1() {  
             $subPageCss1Str = "";  
             $subPageCss1Str .= "��" . $this->nums . "����¼��";  
             $subPageCss1Str .= "ÿҳ��ʾ" . $this->each_disNums . "����";  
             $subPageCss1Str .= "��ǰ��" . $this->current_page . "/" . $this->pageNums . "ҳ ";  
             if ($this->current_page > 1) {  
                 $firstPageUrl = $this->subPage_link . "1";  
                 $prewPageUrl = $this->subPage_link . ($this->current_page - 1);  
                 $subPageCss1Str .= "[<a href='$firstPageUrl'>��ҳ</a>] ";  
                 $subPageCss1Str .= "[<a href='$prewPageUrl'>��һҳ</a>] ";  
             } else {  
                 $subPageCss1Str .= "[��ҳ] ";  
                 $subPageCss1Str .= "[��һҳ] ";  
             }  
       
            if ($this->current_page < $this->pageNums) {  
                 $lastPageUrl = $this->subPage_link . $this->pageNums;  
                 $nextPageUrl = $this->subPage_link . ($this->current_page + 1);  
                 $subPageCss1Str .= " [<a href='$nextPageUrl'>��һҳ</a>] ";  
                 $subPageCss1Str .= "[<a href='$lastPageUrl'>βҳ</a>] ";  
             } else {  
                 $subPageCss1Str .= "[��һҳ] ";  
                 $subPageCss1Str .= "[βҳ] ";  
             }  
       
            return $subPageCss1Str;  
       
        }  
       
        /* 
         ���쾭��ģʽ�ķ�ҳ 
         ��ǰ��1/453ҳ [��ҳ] [��ҳ] 1 2 3 4 5 6 7 8 9 10 [��ҳ] [βҳ] 
         */  
         function subPageCss2() {  
             $subPageCss2Str = "";  
             $subPageCss2Str .= "��ǰ��" . $this->current_page . "/" . $this->pageNums . "ҳ ";  
       
            if ($this->current_page > 1) {  
                 $firstPageUrl = $this->subPage_link . "1";  
                 $prewPageUrl = $this->subPage_link . ($this->current_page - 1);  
                 $subPageCss2Str .= "[<a href='$firstPageUrl'>��ҳ</a>] ";  
                 $subPageCss2Str .= "[<a href='$prewPageUrl'>��һҳ</a>] ";  
             } else {  
                 $subPageCss2Str .= "[��ҳ] ";  
                 $subPageCss2Str .= "[��һҳ] ";  
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
                 $subPageCss2Str .= " [<a href='$nextPageUrl'>��һҳ</a>] ";  
                 $subPageCss2Str .= "[<a href='$lastPageUrl'>βҳ</a>] ";  
             } else {  
                 $subPageCss2Str .= "[��һҳ] ";  
                 $subPageCss2Str .= "[βҳ] ";  
             }  
             return $subPageCss2Str;  
         }  
     }  
       
      
    //����һ�£��������ֲ�ͬЧ��  
      
   // $current_page=isset($_GET['page'])?intval($_GET['page']):1;//��ȡ�û�GET�ύ��page�����û�о�Ĭ  
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



<?php //ִ�д�����


$pagetitle = "��Ƹ����";

$ename = "��Ƹ";//

$table = "xm_lib";//�����������ݿ�ı���

$show = "��ʾ";

$hidden = "����";

$hasisvalid = "1";
$hasorder = "1";
empty($_GET["act"])?$act="":$act=$_GET["act"];



if($act == 'add'){
	$burl = " - ���".$ename;
}elseif($act == 'edit'){
	$burl = " - �༭".$ename;
}

if(isset($keyword)){
	$burl = " - �������";
}

$isfile="on"; //�Ƿ����ϴ��ļ�

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
	
	
	$links[0]['text']="�����б�";
	$links[0]['href']="?page=$page&keyword=$keyword";
	$links[1]['text']="�鿴�༭���";
	$links[1]['href']="?act=edit&id=$id&page=$page&keyword=$keyword";
	
	echo("�༭�ɹ�");

}elseif($act == 'add_save'){
	
	
	$sql = "";
	
	$db->query($sql);
	
	
	$links[0]['text']="�����б�";
	$links[0]['href']="?";
	$links[1]['text']="�������";
	$links[1]['href']="?act=add";
	
	echo("��ӳɹ�");

	
}elseif($act == 'del'){
	if(!empty($moderate)){ //moderate�ں�����ж��� type="checkbox" name="moderate[]"
		if(is_array($moderate)) $moderate =implode('\',\'', $moderate);
		
		$ids=str_replace("'","",$moderate);
		
		$db->query("delete from $table where  id in($ids)");
		$links[0]['text']="�����б�";
		$links[0]['href']="?";
		
		echo("ɾ���ɹ�");
		
	}else{
		$links[0]['text']="�����б�";
		$links[0]['href']="?";
		
		echo("��ѡ��Ҫɾ���ļ�¼");
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>�������� - <?=$pagename?> </title>
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
$ename = "����";
$pagetitle = "pagetitle";
$burl = "����".$ename;//��ʾ���ļ��������ұ�
$do_search = "1";//��������ʾ���أ�0����ʾ 1��ʾ��������
$keyword="";
$isfile = "on";//
?>
<?php
if(empty($act) && empty($keyword)){
?>
<a href="?act=add">���<?=$ename?></a>
<?php
}else{
?>
<a href="?">�����б�</a>
<?php
}
?>
</span>
<span class="action-span1"><a href="admin_index.php">��������</a>  - <?=$pagetitle?><?=$burl?> </span>
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
    ���� 
    <input type="text" name="keyword" value="<?=trim($keyword)?>" size="15" />
    <input type="submit" value=" ���� " class="button" />
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
<th width="10" align="center"><nobr>ѡ��</nobr></th>
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

$current_page=isset($_GET['page'])?intval($_GET['page']):1;//�Ƿ�page��ֵ��û�о�Ĭ��Ϊ1
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
       <td width="" bgcolor="#FFFFFF" style="padding-left:17px;"><input type="checkbox" name="chkall" onClick="javascript:CheckAll(this.form)"> <input name="Submit4" type="submit" class="button"  value="ִ��ɾ��"   onclick="if(!confirm('ȷ��Ҫɾ����?')){return false;}" /></td> 
       <td width="" align="right" style="padding-right:10px;"><?php   
     $pagezone = new Page(10, 100, $current_page, 5);  
     echo $pagezone->subPageCss2();  
      ?></td> 
     </tr> 
   </table></td></tr>

<?php
}else{
?>
<tr><td colspan="9" height="30" style=" padding:10px 0px 10px 30px; color:#660000"><?=$keyword?"����������ؼ�¼":"��ʱû�м�¼"?></td></tr>
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
	$one=mysqli_query($conn,"select * from $table where id='$id'");//�����ݿ��а�id����ȡָ����¼
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
        <th colspan="2" align="left">�༭<?=$ename?></th>
      </tr>
      <tr>
<td align=right>��Ƹ����</td><td><input name="subject" type="text"  class='must_input'  id="subject" value="<?=$a['subject']?>" /></td>
</tr>
<tr>
<td align=right>��Ƹ������</td><td><input name="nums" type="text"  class='input'  id="nums" value="<?=$a['nums']?>" /></td>
</tr>
<tr>
<td align=right>�����ص㣺</td><td><input name="areas" type="text"  class='input'  id="areas" value="<?=$a['areas']?>" /></td>
</tr>
<tr>
<td align=right>��Ƹ���ţ�</td><td><input name="daiyu" type="text"  class='input'  id="daiyu" value="<?=$a['daiyu']?>" /></td>
</tr>
<tr>
<td align=right>�������ڣ�</td><td><input name="adddate" type="text"  class='input'  id="adddate" value="<?=$a['adddate']?>" /></td>
</tr>
<tr>
<td align=right>��Ч���ޣ�</td><td><input name="ends" type="text"  class='input'  id="ends" value="<?=$a['ends']?>" /></td>
</tr>
<tr>
<td align=right>����ţ�</td><td><input name="orders" type="text"  class='input'  id="orders" value="<?=$a['orders']?>" /></td>
</tr>
<tr>
<td align=right>��ʾ״̬��</td><td>
<select name="isvalid" id="isvalid">
 
           <option value="1" <?=$a['isvalid']==1?"selected":""?>><?=$show?></option>
 
<option value="0" <?=$a['isvalid']==0?"selected":""?>><?=$hidden?></option>
 
         </select>
</td>
</tr>
<tr>
<td align=right valign=top>��ƸҪ��</td><td><? fck( $a['content']);?></td>
</tr>

      <tr>
        <td>&nbsp;</td>
        <td><input name="Submit3" type="submit" class="button" value="�ύ" onclick="return checkfill()" />
 ��          
 <input name="Submit22" type="reset" class="button" value="����" /></td>
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
    <th colspan="2" align="left">���<?=$ename?></th>
  </tr>
  <tr>
<td align=right>��Ƹ����</td><td><input name="subject" type="text"  class='must_input'  id="subject" value="<?=$a['subject']?>" /></td>
</tr>
<tr>
<td align=right>��Ƹ���ţ�</td><td><input name="daiyu" type="text"  class='input'  id="daiyu" value="<?=$a['daiyu']?>" /></td>
</tr>
<tr>
<td align=right>��Ƹ������</td><td><input name="nums" type="text"  class='input'  id="nums" value="<?=$a['nums']?>" /></td>
</tr>
<tr>
<td align=right>�����ص㣺</td><td><input name="areas" type="text"  class='input'  id="areas" value="<?=$a['areas']?>" /></td>
</tr>
<tr>
<td align=right>�������ڣ�</td><td><input name="adddate" type="text"  class='input'  id="adddate" value="<?=date("Y-m-d H:i:s")?>" /></td>
</tr>
<tr>
<td align=right>��Ч���ޣ�</td><td><input name="ends" type="text"  class='input'  id="ends" value="<?=$a['ends']?>" /></td>
</tr>
<tr>
<td align=right>����ţ�</td><td><input name="orders" type="text"  class='input'  id="orders" value="0" /></td>
</tr>
<tr>
<td align=right>��ʾ״̬��</td><td>
<select name="isvalid" id="isvalid">
 
           <option value="1"><?=$show?></option>
 
<option value="0"><?=$hidden?></option>
 
         </select>
</td>
</tr>
<tr>
<td align=right valign=top>��ƸҪ��</td><td><? fck( $a['content']);?></td>
</tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="�ύ" class="button" onclick="return checkfill()"  />
       �� 
       <input type="reset" name="Submit2" value="����" class="button"/></td>
  </tr>
</table>
</div>
</form>
<?php 
}
?>
</body>
</html>