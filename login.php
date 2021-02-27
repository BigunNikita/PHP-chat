<?php
session_start();
if (isset($_POST['email'])) { $email = $_POST['email'];}
if (isset($_POST['password'])) { $password=$_POST['password'];}
$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$email = trim($email);
$password = trim($password);
$password = md5($password);
include ("db.php");
$result = mysqli_query($db,"SELECT * FROM accounts WHERE email='$email'");
$myrow = mysqli_fetch_array($result);
if (empty($myrow['password']))
    {
    header ("Location: index.php");
    }
    else {
    if ($myrow['password']==$password) {
        if($myrow['ban']==0){
        $_SESSION['id']=$myrow['id'];
    header ("Location: account.php");
    }
    else{
        echo "<script>alert('Account was banned!')</script>";
    }
    }
 else { 
    exit ("Извините, введённый вами login или пароль неверный.");
    }
    }
    ?>