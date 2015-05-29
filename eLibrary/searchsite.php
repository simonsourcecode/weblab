<?php 
/**************************************************** 
原作者: uchinaboy 
特点：无需mysql支持；速度快；无需设置路径，放在哪级目录下，就搜索该目录和子目录；可以 
搜索一切文本类型的文件；显示文件相关内容；关键词自动高亮显示。 
修改内容：增加了自动分页和风格设置文件。 
搜索框代码（请单独存为html文件，如果放在search.php相同目录下，无需修改）：<form  
method="post" action="search.php"><input type="text" name="key" size=40 value=""> 
<input type="submit" value="检索"></form> 
****************************************************/ 
require ("search.inc.php"); 
if (function_exists("set_time_limit") && !get_cfg_var('safe_mode')){ 
set_time_limit(600);} 

function get_msg($path) { 
global $key, $i; 
$key=$_POST["key"];
$handle = opendir($path); 
while ($filename = readdir($handle)) { 
//echo $path."/".$filename."<br>"; 
$newpath = $path."/".$filename; 
if (is_file($newpath)) { 
$fp = fopen($newpath,"r"); 
$msg = fread($fp,filesize($newpath)); 
fclose($fp); 
match_show($key,$msg,$newpath,$filename); 
} 
if (is_dir($path."/".$filename) && ($filename != ".") &&  ($filename != "..")) { 
//echo "<br><br>".$newpath."<br><br>"; 
get_msg($path."/".$filename); 
} 
} 
closedir($handle); 
return $i; 
} 



function match_show($key,$msg,$newpath,$filename) { 
 global $ar,$i; 
 $key = chop($key); 
 if($key) { $check_type = preg_match("/.html?$/",$filename); 
 if($check_type) {$title = getHtmlTitle($msg);} 
 
   $msg = preg_replace("/<style>.+<\/style>/is","",$msg);
   
  
   $msg = preg_replace("/<[^>]+>/","",$msg);
   $value = preg_match("/.*$key.*/i",$msg,$res);
       if($value) { 

$res[0] = preg_replace("/$key/i","<FONT COLOR='red'>$key</FONT>",$res[0]); 
$k = $res[0]; 
$k = strrchr($k,"<FONT"); 
     $k = substr($k,1,100); 
     $k = "<FONT COLOR='red'>$key<$k"; 
     if(isset($title)) {$m = $title;} else {$m = $filename;} 
     $i++; 
     $link = $newpath; 
     $ar[] = "$i.<a href='$link'>$m</a><BR><BR>" .$k."<BR><br>"; 
   } 
 }else { 
   echo "请输入关键词"; 
   exit; 
 } 
} 

function getHtmlTitle($msg) { 

       /* Locate where <TITLE> is located in html file. */ 
       $lBound = strpos($msg,'<title>') + 7; //7 is the lengh of <TITLE>. 

       if ($lBound < 1) 
               return; 

       /* Locate where </TITLE> is located in html file. */ 
       $uBound = strpos($msg,'</title>', $lBound); 

       if ($uBound < $lBound) 
               return; 

       /* Clean HTML and PHP tags out of $title with the madness below. */ 
       $title = ereg_replace("[tnr]",'',substr($msg,$lBound,$uBound -  
$lBound)); 
       $title = trim(strip_tags($title)); 

       if (strlen($title) < 1) //A blank title is worthless. 
               return; 

       return $title; 
} 

$i = get_msg("."); 
if (empty($page)) $page=1; 
$maxresult=($page*20); 
$resultcount = count($ar); 
if ($resultcount%20==0) $maxpageno=$resultcount/20; 
       else $maxpageno=floor($resultcount/20)+1; 
if ($page>$maxpageno) { 
$page=$maxpageno; $pagemax=$resultcount-1; $pagemin=max(0,$resultcount-20);} 
       elseif ($page==1) {$pagemin=0; $pagemax=min($resultcount-1,20-1); } 
       else { $pagemin=min($resultcount-1,20*($page-1)); $pagemax=min($resultcount- 
1,$pagemin+20-1); } 
$maxresult=min($maxresult,$resultcount); 
echo "<p align='center'>"; 
echo "检索结果"; 
echo "</p><hr>"; 
for ($i=max(0,$maxresult-20); $i<$maxresult; $i++) { 
print $ar[$i]; 
} 
echo "<hr><p align='center'>"; 
echo " 已经搜索到了 $resultcount 条信息"; 
     $nextpage=$page+1; 
     $previouspage=$page-1; 
echo " --- [ <a href='search.php?key=$key&page=$nextpage'  target='_self'>搜索下 20  
个结果</a> ]"; 
echo " [ <a href='search.php?key=$key&page=$previouspage'  target='_self'>返回上 20  
个结果</a> ]"; 
exit; 

?> 