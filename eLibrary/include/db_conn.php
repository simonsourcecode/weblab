<?php 
include_once("include/config.php");
$mysqli = new mysqli("$dbhost", "$dbuser", "$dbpw", "$dbname");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$sqlstr="SELECT * FROM xm_lib  ORDER BY sf ASC";
$result = $mysqli->query($sqlstr);


?>
