<?php
session_start();
$email=$_SESSION['email'];
if(isset($email)){
    if (isset($_POST['avatar'])) { $avatar = $_POST['avatar'];}
    include ("db.php");
    $result = mysqli_query ($db,"UPDATE accounts SET avatar='$avatar' WHERE email='$email'");
    require("account.php");
}
?>