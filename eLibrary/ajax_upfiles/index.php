<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax异步上传图片</title>
<script src="js/jquery-1.4.2.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jquery.form.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">

function sky_upfiles(){
	var messtxt;
 $("#sky_upform").ajaxSubmit({
                                //dataType:'script',
                                type:'post',
                                url: "doupfiles.php",    
                                beforeSubmit: function(){
                                    $("#sky_txt").html("图片上传中...");
                                },
                                success: function(data){        
									if(data=="1"){
									messtxt = "上传成功！";
									}else if(data=="-1"){
									messtxt = "文件超过规定大小！";
									}else if(data=="-2"){
									messtxt = "文件类型不符!";
									}else if(data=="-3"){
									messtxt = "移动文件出错!";
									}else{
									messtxt = "未知错误!";
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
<fieldset style="width:97%">
  <legend>上传文件</legend>
    <form enctype="multipart/form-data" id="sky_upform" name="sky_upform" action="" method="post">
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td width="100" align="right" class="f-12"></td>
        <td class="f-12" align="left">
		<input name="upfile" id="upfile" maxlength="20" size="40" type="file" value="" /><input name="upmit" type="button" id="upmit" value="上传" onclick="sky_upfiles()"/>
		<font color="red" id="sky_txt"></font></td>
      </tr>	   
	</form> 
</fieldset>		
</body>
</html>