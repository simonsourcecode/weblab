<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elibrary 档案信息添加页面</title>
<script src="js/jquery-1.4.2.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jquery.form.js" language="JavaScript" type="text/javascript"></script>
<script src="../My97DatePicker/WdatePicker.js" language="JavaScript" type="text/javascript"></script>



<script type="text/javascript">

function checkForm(obj) //表单中通过submit按钮中 onclick事件中this.form.onsubmit()来触发onsubmit事件调用此方法，注意submit()无法触发onsubmit事件
{
    if(obj.sn.value == "" || pattern.test(obj.sn.value))
   {
      alert("编号不能为空");
      return false;
   }
   
   if(obj.dateofissue.value == "")
   {
      alert("生效日期不能为空");
      return false;
   }
   if(obj.expiredate.value == "")
   {
      alert("失效日期不能为空");
      return false;
   }
   if(obj.expiredate.value !="" && obj.expiredate.value<obj.dateofissue.value)
   {
       alert("生效时间不能大于失效时间");
      return false;
   }
   
    if(obj.owner.value == "")
   {
      alert("所有者不能为空");
      return false;
   }
   return true;
}


function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=")
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1 
    c_end=document.cookie.indexOf(";",c_start)
    if (c_end==-1) c_end=document.cookie.length
    return unescape(document.cookie.substring(c_start,c_end))
    } 
  }
return ""
}

function deleteCookie(name){ 
var date=new Date(); 
date.setTime(date.getTime()-10000); 
document.cookie=name+"=v; expire="+date.toGMTString(); 
} 

function sky_upfiles(){
	var messtxt;
 $("#sky_upform").ajaxSubmit({
                                //dataType:'script',
                                type:'post',
                                url: "doupfiles.php",    
                                beforeSubmit: function(){
                                    $("#sky_txt").html("图片上传中...");
                                 
                                  //  deleteCookie('picpath');
                                    
                                   $('#showimg').css({
                    overflow:'hidden',
                    width:'99px',
                    height:'99px'
             });   
             
               

                                },
                                success: function(data){        
									if(data=="1"){
									messtxt = "OK！";
									
									 alert(getCookie('picpath'));
                                    $("#showimg").attr("src",getCookie('picpath'));
									         


									
									}else if(data=="-1"){
									messtxt = "文件超过规定大小！";
									}else if(data=="-2"){
									messtxt = "文件类型不符!";
									}else if(data=="-3"){
									messtxt = "移动文件出错!";
									}else{
									messtxt = "unknown error!";
									}
                                    $("#sky_txt").html(messtxt);                
                                    //$("#sky_txt").append(data);
                                },
                                resetForm: false,
                                clearForm: false
                        });
                        //$("#upimgform").submit();
                        
                        
}   


        </script>
</head>
<body>
<br />






<?php $title="Elibrary -档案信息添加";?>





<h3 style="color:#0099CC"> === Elibrary 档案信息添加页面 === </h3>
 <br /><br /><br />        
   <details open="open">
<summary>additem</summary>

 <table>    
<fieldset style="width:97%">
  <legend>上传图片</legend>
    <form enctype="multipart/form-data" id="sky_upform" name="sky_upform" action="../insert.php" method="post" onsubmit="return checkForm(this);">
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td width="100" align="right" class="f-12"></td>
        <td class="f-12" align="left">
<input  type="hidden" id="picpath_hidden" name="picpath_hidden" value=<?php if(isset($_COOKIE['picpath'])) echo $_COOKIE['picpath']; ?> />
		<input name="upfile" id="upfile" maxlength="20" size="40" type="file" value="" />
		<input name="upmit" type="button" id="upmit" value="上传" onclick="sky_upfiles()"/>

		<font color="red" id="sky_txt"></font>
     
    <div >
    <h3>图片预览</h3>
    <div id="previewImage" class="img_v">
     <img id="showimg" src=""></img>
</div>                    
</div>
        </td></tr>	   
	
</fieldset>		


        
            
 <tr><td>  <label for='name'>档案名:</label> </td><td>
 <input type="text" name="name" id="name" placeholder="input name" x-webkit-speech="" lang="zh-CN" required="required"/></td></tr>
 <tr><td> <label for='sn'>编号:</label> </td><td>
 <input type="text" name="sn" id="sn" placeholder="input sn" />   (示例: X1407001)</td></tr>
<tr><td> <label for='alias'>助记码:</label> </td><td>
 <input type="text" name="alias" id="alias" placeholder="input alias" /></td></tr>
<tr><td> <label for='subject'>主题:</label> </td><td>
 <input type="text" name="subject" id="subject" placeholder="input subject" /></td></tr>
  
<tr><td> <label for='dateofissue'>发证日期:</label> </td><td>
<input type="text" name="dateofissue" value="<?=date('Y-m-d',time())?>" onclick="WdatePicker()" /><!--type="text" WdatePicker() is a js function of WdatePicker.js-->

 <input type="hidden" name="dateofissue0" id="dateofissue0" placeholder="input name" /></td></tr> 
 <tr><td><label for='expiredate'>有效期:</label> </td><td>
 <input type="text" name="expiredate" value="<?=date('Y-m-d',time())?>" onclick="WdatePicker()" />

 <input type="hidden" name="expiredate0" id="expiredate0" placeholder="input name" /></td></tr>
<tr><td><label for='place'>存放位置:</label> </td><td>
<?php include_once("dropdownlistplace.php");?> <input type="text" name="place" onclick="getvalue()" id="place" placeholder="click to get place" required="required"/>   (示例: B01CL1F)</td></tr>
 <tr><td><label for='owner'>所有者:</label> </td><td>
<?php include_once("dropdownlistname.php");?> </td></tr>
 <tr><td><label for='barcode'>二维码:</label> </td><td>
 <input type="text" name="barcode" id="barcode" placeholder="input 2d code" /></td></tr>

 <tr><td> <label for='parentclass'>档案类别:</label> </td><td>
 <select name="selectparentclass">
  <option value="0">请选择...</option>
  <option value="1">证件</option>
  <option value="2">文档</option>
  <option value="3">图片</option>
  <option value="4">音频</option>
  <option value="5">视频</option>
</select>
 </td></tr>
 <tr><td><label for='isvalid'>是否有效:</label> </td><td>
 <input type="radio" name="isvalid" value="1" id="isvalid" >y</input>&nbsp;
          <input type="radio" name="isvalid" value="0" id="isvalid">n</input></td></tr>
 <tr><td><label for='remark'>备注:</label> </td><td>
 <input type="text" name="remark" id="remark" placeholder="input text" x-webkit-speech="" lang="zh-CN"/></td></tr>
  <tr><td><label for='imagepath'>图片位置:</label> </td><td>
 <input type="text" name="imagepath" id="imagepath" placeholder="input imagepath here" /></td></tr>
 <tr><td> <label for='description'>描述:</label> </td><td>
          <textarea id="description" name="description" rows="9" cols="22" placeholder="description here"></textarea></td></tr>
		  
		  
 <tr><td>	   
 <input type="submit" value="Add" class="submit" onclick="if((confirm('Are you sure to submit?'))) this.form.onsubmit();" /> </td><td>
<input type="reset" value="reset" onclick="this.form.reset()" ></input></td></tr>
        </form> 
 
  </table>
  
  </details>
  
<script language="javascript" type="text/javascript">
//calc sumvalue ? for IE dosen't support html5 output element,and we can't send a js variant to php directly. sumvalue here is a hidden field which is used to store a js variant temporarily, and then we can get its value by use $_POST[] in PHP.
function setsumvalue(){
document.getElementById("sumvalue").value=parseFloat(document.getElementById("unitprice").value)*parseFloat(document.getElementById("quanity").value);

}
function getvalue(){
document.getElementById("place").value=document.getElementById("province").value+document.getElementById("diqu").value+document.getElementById("city").value;//赋值给隐藏域place
}
</script>





</body>
</html>