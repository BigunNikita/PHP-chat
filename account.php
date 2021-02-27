<?php 
session_start();
$id=$_SESSION['id'];
if(isset($id)){
    include ("db.php");
    if (!empty($_POST['avatar'])) { 
        $avatar = $_POST['avatar'];
        $result = mysqli_query ($db,"UPDATE accounts SET avatar='$avatar' WHERE id='$id'");
    }
    if (!empty($_POST['name'])) { 
        $name = $_POST['name'];
        $result = mysqli_query ($db,"UPDATE accounts SET name='$name' WHERE id='$id'");
    }
    if (!empty($_POST['surname'])) { 
        $surname = $_POST['surname'];
        $result = mysqli_query ($db,"UPDATE accounts SET surname='$surname' WHERE id='$id'");
    }
    if (!empty($_POST['phone'])) { 
        $phone = $_POST['phone'];
        $result = mysqli_query ($db,"UPDATE accounts SET phone='$phone' WHERE id='$id'");
    }
    if (!empty($_POST['email'])) { 
        $email = $_POST['email'];
        $result = mysqli_query ($db,"UPDATE accounts SET email='$email' WHERE id='$id'");
    }
    if (!empty($_POST['password'])) { 
        $password = $_POST['password'];
        $password = md5($password);
        $result = mysqli_query ($db,"UPDATE accounts SET password='$password' WHERE id='$id'");
    }
    if (!empty($_POST['ban'])) { 
        $ban = $_POST['ban'];
        $banid=mb_substr($ban,4);
        $result = mysqli_query ($db,"UPDATE accounts SET ban='1' WHERE id='$banid'");
    }
    if (!empty($_POST['admin'])) { 
        $admin = $_POST['admin'];
        $adminid=mb_substr($admin,6);
        $result = mysqli_query ($db,"UPDATE accounts SET admin='1' WHERE id='$adminid'");
    }
    $result = mysqli_query($db,"SELECT * FROM accounts WHERE id='$id'");
    $myrow = mysqli_fetch_array($result);
    $name=$myrow['name']." ".$myrow["surname"];
    $header='<li class="item"><a href="account.php" class="sign-up" style="color:yellow">Account</a></li><li class="item"><a href="exit.php">Exit</a></li>';
}
else{
    $header='<li class="item"><a href="#login">Login</a></li>            
    <li class="item"><a href="#register" class="sign-up" style="color:yellow">Register</a></li> ';
    header ("Location: index.php#register");
    $name="You(Anonymous)";
}

?>
<html>
<head>
<title>FunnyChat</title>
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<header>
    <div class="header-logo">
        <a href="index.php">Funny Chat</a>
    </div>
    <div class="header-menu">
        <ul>
            <?php echo $header; ?>                 
        </ul>
    </div>
</header>
<section class="content">
    <div class="chat">
        <h1 class="name">Hello, <?php echo $name; ?></h1>
        <div style="display:flex">
        <div class="ava-block">
            <img class="ava-acc" src="<?php echo '/img/'.$myrow['avatar'].'.png'; ?>" > 
            <a class="ava-text" href="#avatar">Change</a>
        </div>
        <div class="info-block">
        <form action="account.php" method="post" class="info-block">
          <p>Name</p>
          <input type="text" name="name" placeholder="<?php echo $myrow['name']; ?>">
          <p>Surname</p>
          <input type="text" name="surname" placeholder="<?php echo $myrow['surname']; ?>">
          <p>Password</p>
          <input type="password" name="password" placeholder="••••••••">
          <p>Email</p>
          <input type="email" name="email" placeholder="<?php echo $myrow['email']; ?>">
          <p>Phone</p>
          <input type="phone" name="phone" placeholder="<?php echo $myrow['phone']; ?>">
          <input type="submit" class="btn" value="Change" style="padding:10px;">
        </form>
        </div>
    </div>
    
    
   
    <?php 
    if ($myrow['admin']==1){
    $content='<h1 class="name" style="padding-top:30px;">Members</h1>
    <form action="account.php" method="post">
    <table border="1">
   <tr>
    <th>Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Date</th>
    <th>Admin</th>
    <th>Ban</th>
    <th>Functions</th>
   </tr>';
   echo $content;
    $sql = mysqli_query($db, "SELECT id,name,surname,email,date,phone,admin,ban FROM accounts");
  while ($result = mysqli_fetch_array($sql)) {
      $id=$result['id'];
    echo "<tr><td>{$result['name']}</td><td>{$result['surname']}</td><td>{$result['email']}</td><td>{$result['phone']}</td><td>{$result['date']}</td><td>{$result['admin']}</td><td>{$result['ban']}</td><td><input type='submit' value='Ban $id' name='ban'><input type='submit' value='Admin $id' name='admin'></td></tr>";
  }
  echo "</table>";
}
  ?>
</form>
    </div>
</section>
<div id="avatar" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Change Avatar</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body" >  
        <form action="account.php" method="post">
        <div style="display:flex">
        <label><input type="radio" class="avatarka" name="avatar" value="unknown"><img class="ava-change" src="img/unknown.png"></label>
        <label><input type="radio" class="avatarka" name="avatar" value="avatar1"><img class="ava-change" src="img/avatar1.png"></label>
        </div>
        <div style="display:flex">
        <label><input type="radio" class="avatarka" name="avatar" value="avatar2"><img class="ava-change" src="img/avatar2.png"></label>
        <label><input type="radio" class="avatarka" name="avatar" value="avatar3"><img class="ava-change" src="img/avatar3.png"></label>
        </div>
        <input class="change-btn" type="submit" value="Change">
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>