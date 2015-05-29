<?php

 
/*
 * 1:成功上传
 *-1:文件超过规定大小
 *-2:文件类型不符
 *-3:移动文件出错
 */
if(is_uploaded_file($_FILES['upfile']['tmp_name'])){

 $photo_types=array('image/jpg', 'image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png','application/pdf','video/avi','application/octet-stream');//定义上传格式,
 /*php文件类型对照表!很方便看出文件是什么类型。如gif是image/gif类型

　　ie

　　id 后缀名 php识别出的文件类型

　　0 gif image/gif

　　1 jpg image/jpeg

　　2 png image/png

　　3 bmp image/bmp

　　4 psd application/octet-stream

　　5 ico image/x-icon

　　6 rar application/octet-stream

　　7 zip application/zip

　　8 7z application/octet-stream

　　9 exe application/octet-stream

　　10 avi video/avi

　　11 rmvb application/vnd.rn-realmedia-vbr

　　12 3gp application/octet-stream

　　13 flv application/octet-stream

　　14 mp3 audio/mpeg

　　15 wav audio/wav

　　16 krc application/octet-stream

　　17 lrc application/octet-stream

　　18 txt text/plain

　　19 doc application/msword

　　20 xls application/vnd.ms-excel

　　21 ppt application/vnd.ms-powerpoint

　　22 pdf application/pdf

　　23 chm application/octet-stream

　　24 mdb application/msaccess

　　25 sql application/octet-stream

　　26 con application/octet-stream

　　27 log text/plain

　　28 dat application/octet-stream

　　29 ini application/octet-stream

　　30 php application/octet-stream

　　31 html text/html

　　32 htm text/html

　　33 ttf application/octet-stream

　　34 fon application/octet-stream

　　35 js application/x-javascript

　　36 xml text/xml

　　37 dll application/octet-stream

　　38 dll application/octet-stream
*/

        $max_size=10000000;    //上传照片大小限制,默认700k
        $photo_folder="upload/".date("Y")."/".date("m")."/".date("d")."/"; //上传照片路径
        ///////////////////////////////////////////////////开始处理上传
        if(!file_exists($photo_folder))//检查照片目录是否存在
        {
            mkdir($photo_folder, 0777, true);  //mkdir("temp/sub, 0777, true);
        }

$upfile=$_FILES['upfile'];
$name=$upfile['name'];
$type=$upfile['type'];
$size=$upfile['size'];
$tmp_name=$upfile['tmp_name'];

$file = $_FILES["upfile"];
$photo_name=$file["tmp_name"];
//echo $photo_name;
$photo_size = getimagesize($photo_name);

if($max_size < $file["size"])//检查文件大小
           echo "-1";       
if(!in_array($file["type"], $photo_types)) //检查文件类型
           echo "-2";      
		   
if(!file_exists($photo_folder))//照片目录
                  mkdir($photo_folder);
$pinfo=pathinfo($file["name"]);
$photo_type=$pinfo['extension'];//上传文件扩展名

$photo_server_folder = $photo_folder.time().".".$photo_type;//以当前时间和7位随机数作为文件名，这里是上传的完整路径


if(!move_uploaded_file ($photo_name, $photo_server_folder))
            {
             echo "-3"; //echo "移动文件出错";
                exit;
            }
$pinfo=pathinfo($photo_server_folder);
$fname=$pinfo['basename'];
echo "1";   //echo " 已经成功上传：".$photo_server_folder."<br />";

setcookie('picpath',$photo_server_folder);//cookie "picpath" birth here, end in line 35 of file insert.php.
}
?>
