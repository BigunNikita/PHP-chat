<?php
$host="localhost";
$username="root";
$pass="";
$dbname="funnychat";
$db = mysqli_connect($host,$username,$pass);
mysqli_select_db($db,$dbname);
?>