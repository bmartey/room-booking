<?php
  session_start();

  if(isset($_REQUEST['Login'])){

    include_once('users.php');

    $user_default= new users();

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $result = $user_default->login($username,$password);
      
    if($result==false){
      echo "<center><h3><b>".$username."</b><font color='red'> or the password is invalid</font></h3><center>";
    }
    else{

      $_SESSION['FNAME']=$result['FIRSTNAME'];
      $_SESSION['LNAME']=$result['LASTNAME'];
      $_SESSION['USERNAME']=$result['USERNAME'];
      $_SESSION['EMAIL']=$result['EMAIL'];

      header('Location:bookinglist.php');
    }
    
  }
?>
<!--html doctype-->
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="shortcut icon" type="image/png" href="NCA.png"/>

    <link rel="stylesheet" href="css/foundation.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="foundation/fonts/foundation-icons.css"> 

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/foundation.js"></script>

    <script src='lib/moment.min.js'></script>
    <script src='lib/jquery.min.js'></script>

    <style type="text/css">
      .circular {
      width: 250px;
      height: 250px;
      border-radius: 300px;
      -webkit-border-radius: 300px;
      -moz-border-radius: 150px;
      box-shadow: 0 0 20px rgba(30,144,255, .9);
      -webkit-box-shadow: 0 0 20px rgba(30,144,255, .9);
      -moz-box-shadow: 0 0 20px rgba(30,144,255, .9);
    }
    </style>

    <style type="text/css">
    .service {
      width: 100%;
      height: 50%;
      margin: 80px 0;
      text-align: center;
      -webkit-transition: all 0.3s ease;
      transition: all 0.3s ease; }
    .service .service-icon-box {
      position: relative;
      top: 100px;
      display: inline-block;
      margin-bottom: 40px;
      padding: 10px;
      background: white;
      -webkit-transition: all 0.3s ease;
      transition: all 0.3s ease; }
    .service .service-heading {
      position: relative;
      top: 80px;
      -webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
      transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55); }
    .service .service-description {
      width: 80%;
      margin: 0 auto;
      opacity: 0;
      -webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
      transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
      -webkit-transform: scale(0);
      -ms-transform: scale(0);
      transform: scale(0); }
    .service .service-icon-box > img.service-icon {
      width: 40px; }
    .service:hover {
      border-color: #00a8ff; }
    .service:hover .service-icon-box {
      top: -30px; }
    .service:hover .service-heading {
      top: -30px; }
    .service:hover .service-description {
      opacity: 1;
      -webkit-transform: scale(1);
      -ms-transform: scale(1);
      transform: scale(1); }
    </style>

  </head>
  <body>
  <div class="panel callout large" style="height:100%;color:#000000">   
    <div class="service">
      <div class="service-icon-box">
        <img class="circular" src="NCA logo.jpg">
      </div>
      <h2 class="service-heading" style="color:#1E90FF"><b>Login Here:</b></h2>
      <form class="service-description" action="" method="POST">
        <div class=" panel callout secondary medium">
          <input type="text" placeholder="Username" name='username'>
          <input type="password" placeholder="Password" name='password'>
        </div>   
        <button class="button" type="submit" align=center name="Login">Log In</button>

      </form>
    </div>
    
  </div>

  </body>
</html>


    