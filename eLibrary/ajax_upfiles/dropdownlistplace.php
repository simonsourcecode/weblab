<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>位置选择三级联动下拉框</title>
</head>
<body>

<script language="javascript">
function createReq(){
 var xmlhttp;
  try {
     xmlhttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
  }catch (e){ // Internet Explorer
     try {
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
     }catch (e){
        try{
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }catch (e){
          alert("您的浏览器不支持AJAX！");
          return false;
        }
     }
  }
 return xmlhttp;
}
function getSubs(ParentArea,type){







  var DiquXMLHttp=createReq();
  t=Math.random(); //加T参数是为了防止缓存
  var ServerURL="getsubsplace.php?type="+type+"&area="+ParentArea+"&t="+t;
  DiquXMLHttp.open("GET",ServerURL,false);
  DiquXMLHttp.send();
  if(DiquXMLHttp.readyState==4 && DiquXMLHttp.status==200){
 updateSubs(DiquXMLHttp.responseText,type);
  }
}
function updateSubs(str,type){
    var AreaArr = new Array();
 var AreaValue;
 
    if(str!=""){
  AreaArr =str.split("|");
  if(type==1){
   document.getElementById("diqu").length=0;   
      document.getElementById("city").length=0;     
  
         for(var i=0;i<AreaArr.length/2-1;i++){
    AreaValue=parseInt(AreaArr[2*i+1]);
   // AreaText=AreaArr[2*i+2].replace(AreaValue,"");
  AreaText=AreaArr[2*i+2];
     document.getElementById("diqu").options[i]=new Option(AreaText,AreaValue);
   }
  }else if(type==2){
   document.getElementById("city").length=0;     
         for(var i=0;i<AreaArr.length-1;i++){
    AreaValue=parseInt(AreaArr[2*i+1]);
   //AreaText=AreaArr[2*i+2].replace(AreaValue,"");
 AreaText=AreaArr[2*i+2];
     document.getElementById("city").options[i]=new Option(AreaText,AreaValue);
   }
  }else{}
    }
}
</script>

<!--<form action="" method="post">-->
<select name="province" id="province" onchange="getSubs(this.value,1)" onfocus="">
<option value="0">请选择</option>
<?php
 
 //数据库连接及参数初始化********************************** 
$link = mysql_connect( 'localhost', 'root', 'apache') or die('Could not connect to mysql server.' );
        mysql_select_db('db_library', $link) or die('Could not select database.');
        echo "connected to mysql server ok.";
 mysql_query("set names utf8");
 $sql="select id,type from tb_location where uid=2 ";//uid的值为0/1/2表示分别起始于不同的层次
 $datas=mysql_query($sql);

 while($data=mysql_fetch_array($datas)){
  //$data[1]=iconv("GB2312","UTF-8",$data[1]);
  //echo $data[2];
  echo "<option value='$data[0]'>$data[1]</option><br/>";
 }
?>
</select>
<select name="diqu" id="diqu" onchange="getSubs(this.value,2)" onfocus="getSubs(this.value,2)">
<option value="0">请选择</option>
</select>

<select name="city" id="city">
<option value="0">请选择</option>
</select>
<!--</form>-->

</body>
</html>