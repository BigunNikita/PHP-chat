<?php
$errors = array(); 
if (isset($_POST['name'])) { $name = $_POST['name']; }
if (isset($_POST['surname'])) { $surname = $_POST['surname']; }
if (isset($_POST['email'])) { $email = $_POST['email'];}
if (isset($_POST['phone'])) { $phone = $_POST['phone']; }
if (isset($_POST['password'])) { $password=$_POST['password'];}
$name = stripslashes($name);
$name = htmlspecialchars($name);
$surname = stripslashes($surname);
$surname = htmlspecialchars($surname);
$email = stripslashes($email);
$email = htmlspecialchars($email);
$phone = stripslashes($phone);
$phone = htmlspecialchars($phone);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$name = trim($name);
$surname = trim($surname);
$email = trim($email);
$phone = trim($phone);
$password = trim($password);
$password = md5($password);
include ("db.php");
$result = mysqli_query($db,"SELECT * FROM accounts WHERE phone='$phone' OR email='$email'");
$myrow = mysqli_fetch_array($result);
if ($myrow['id']) { 
    if ( $myrow['email']==$email ) {
        array_push($errors, "Email already exists");
    }
    else if ( ($myrow['name']==$name) and ($myrow['surname']==$surname) ) {
        array_push($errors, "This name and surname already exists");
    }
    else if($myrow['phone']==$phone){
        array_push($errors, "Phone already exists");
    }
}
if (count($errors) == 0) {
        $ip=$_SERVER['REMOTE_ADDR'];
        $datareg= date("d.m.Y"); 
        $result2 = mysqli_query ($db,"INSERT INTO accounts (name,surname,password,email,phone,ip,date,avatar,admin,ban) VALUES('$name','$surname','$password','$email','$phone','$ip','$datareg','unknown','0','0')");
        $result3 = mysqli_query($db,"SELECT id FROM accounts WHERE email='$email'");
        $myrow3 = mysqli_fetch_array($result3);
        session_start();
        $_SESSION['id'] = $myrow3['id'];
        header("Location: index.php");
    }
else{
    header("Location: index.php#register");
}
    ?>