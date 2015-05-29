<?php 
include_once("header.php");
include_once("include/db_conn.php");
?>

<?php

//$con=mysql_connect("localhost","root","apache");
//if(!$con)
//{
//die('Could not connect '.mysql_error());
//}
//mysql_select_db("db_hms",$con);

//savememberinfo.php?id="";
$id=$_GET["id"]; 
switch ($id){
case "Simon":
  $id="01202336";
  break;
case "Dolly":
  $id="";
  break;

default:
  echo "No such person";
}
$username=$_POST["username"];
$alias=$_POST["alias"];

$birthday=$_POST["birthday"];
$birthplace=$_POST["birthplace"];
$height=$_POST["height"];
$weight=$_POST["weight"];
$picpath=$_POST["picpath"];
$city=$_POST["city"];
$visible_flag=$_POST["visible_flag"];

$remark=$_POST["remark"];
$description=$_POST["description"];
$resume=$_POST["resume"];
$passport=$_POST["passport"];

$cellphone=$_POST["cellphone"];
$tel=$_POST["tel"];
$email=$_POST["email"];
$wechat=$_POST["wechat"];
$qq=$_POST["qq"];


//$sql="update tb_ItemInfo set Name='$name', Code='$code', Alias='$alias', Size='$size', UnitPrice='$unitprice', Quanity='$quanity', Sum=UnitPrice*Quanity, PurchaseDate='$purchasedate', ExpireDate='$expiredate', Location='$location', Owner='$owner', Barcode='$barcode', Class='$class', SubClass='$subclass', Visible_flag='$visble_flag', Remark='$remark', PicPath='$picpath', Description='$description' where ItemID='$id'";
//$result=mysql_query($sql);
$sqlstr="update tb_user set UserName='$username',  Alias='$alias', BirthPlace='$birthplace',Birthday='$birthday',Height='$height', Weight='$weight',Visible_flag='$visible_flag', Remark='$remark', PicPath='$picpath',City='$city', Description='$description',UpdateDate=now() where ID like '%$id'";
$result=$mysqli->query($sqlstr);
if($result)
{echo "Updated successfully!";
header("refresh:3;url=showmember.php");
}
else {
echo "Updated failed!";	
	};
$mysqli->close();
?>
