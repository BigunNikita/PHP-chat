<?php 
session_start();
$id=$_SESSION['id'];
if(isset($id)){
    include ("db.php");
    $result = mysqli_query($db,"SELECT * FROM accounts WHERE id='$id'");
    $myrow = mysqli_fetch_array($result);
    $name=$myrow['name']." ".$myrow["surname"];
    $avatar=$myrow['avatar'];
    $header='<li class="item"><a href="account.php" class="sign-up" style="color:yellow">Account</a></li><li class="item"><a href="exit.php">Exit</a></li>';
}
else{
    $avatar="unknown";
    $header='<li class="item"><a href="#login">Login</a></li>            
    <li class="item"><a href="#register" class="sign-up" style="color:yellow">Register</a></li> ';
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
        <ul><?php echo $header; ?></ul>
    </div>
</header>
<section class="content">
    <div class="chat">
        <h1 class="name">Chat Online</h1>
        <div class="chat-block">
        <div class="chat-content">
        <div class="messages-block">
        <div class="container">
            <img class="ava" src="/img/avatar1.png" alt="Avatar">
            <a href="account.php" class="username">Peter</a>
            <p>Hello. How are you today?</p>
            <span class="time">10:48</span>
            
        </div>

        <div class="container">
            <img class="ava" src="/img/avatar2.png" alt="Avatar">
            <a href="account.php" class="username">Viktor</a>
            <p>Hey! I'm fine. Thanks for asking!</p>
            <span class="time">11:02</span>
        </div>

<div class="container">
  <img class="ava" src="/img/avatar1.png" alt="Avatar">
  <a href="account.php" class="username">Andrea</a>
  <p>Sweet! So, what do you wanna do today?</p>
  <span class="time">12:21</span>
</div>

<div class="container">
  <img class="ava" src="/img/avatar2.png" alt="Avatar">
  <a href="account.php" class="username">Viktor</a>
  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
  <span class="time">12:33</span>
</div>
<div class="container">
            <img class="ava" src="/img/avatar3.png" alt="Avatar">
            <a href="account.php" class="username">Yulia</a>
            <p>Hello. How are you today?</p>
            <span class="time">10:48</span>
            
        </div>
        <div class="container">
            <img class="ava" src="/img/avatar3.png" alt="Avatar">
            <a href="account.php" class="username">Yulia</a>
            <p>Like me!</p>
            <span class="time">10:48</span>
            
        </div>
        
        </div>
        <div class="message-area">
            <input type="text" name="message" class="message-input">
            <input type="submit" class="send-btn">
        </div>
    </div>
        <div class="members-block">
            <div class="container you">
                <img class="ava" src="<?php echo '/img/'.$avatar.'.png'; ?>" alt="Avatar">
                <a href="account.php" class="username"><?php echo $name; ?></a>
                <p class="online">Online</p>
                
            </div>
        </div>
        </div>
    </div>
</section>
<div id="login" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Login</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">  
        <form class="form" action="login.php" method="post">
          <p>Email</p>
          <input type="email" name="email" required>
          <p>Password</p>
          <input type="password" name="password" required>
          <input type="submit" class="btn">
        </form>
        </div>
      </div>
    </div>
  </div>
  <div id="register" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Register</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">  
        <form class="form" action="register.php" method="post">
          <p>Name</p>
          <input type="text" name="name" required>
          <p>Surname</p>
          <input type="text" name="surname" required>
          <p>Password</p>
          <input type="password" name="password" required>
          <p>Email</p>
          <input type="email" name="email" required>
          <p>Phone</p>
          <input type="phone" name="phone" required>
          <input type="submit" class="btn">
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>