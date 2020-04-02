<?php include('file.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>WEBDEV CREATIONS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <header>
      <div class="main">
        <div class="logo">
          <img src="logo.png">
        </div>
        <ul>
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Service</a></li>
          <li><a href="#">Gallery</a></li>
          <li><a href="#">abaout</a></li>
          <li><a href="#">kontekt</a></li>
        </ul>
      </div>
      <div class="title">
        <h1>Chiliometra in Patra</h1>
      </div>
    </header>



    <div class="container">
      <a href="#" class="button"id="button">Login</a>
      <a href="#" class="button"id="button1">Sign up</a>
    </div>

    <div class="popup">
      <form action="file.php" method="post">
      <div class="popup-content">
        <img src="close.png" class="close">
        <div class="user">
          <img src="user.jpg" alt="User">
        </div>
        <input type="text" id= "username" name = "username" placeholder="username">
        <input type="password" id ="password" name = "password"placeholder="password">
        <p>
          <button type="submit" class="button" id = "button" name="Login_admin">Admin</button>
          <button type="submit" class="button" id = "button" name="Login_user">User</button>
        </p>
      </div>
      </form>
    </div>
    <div class="popup1">
      <form action="file.php" method="post">
      <div class="popup-content">

        <img src="close.png" class="close1">
        <div class="user">
          <img src="user.jpg" alt="User">
        </div>
        <input type="text" id= "username" name = "username" placeholder="username">
        <input type="email" id= "email" name = "email" placeholder="email">
        <input type="password" id= "password" name = "password" placeholder="password">

        <p>
          <button type="submit" class="button" id = "button1" name="Signup">Signup</button>
        </p>
      </div>
      </form>
    </div>


    <script type="text/javascript">

    document.getElementById("button").addEventListener("click", function(){
       document.querySelector(".popup").style.display = "flex";
     })
    document.querySelector(".close").addEventListener("click", function(){
      document.querySelector(".popup").style.display = "none";
    })
    document.getElementById("button1").addEventListener("click", function(){
       document.querySelector(".popup1").style.display = "flex";
     })
    document.querySelector(".close1").addEventListener("click", function(){
      document.querySelector(".popup1").style.display = "none";
    })
    </script>
  </body>
</html>
