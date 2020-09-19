<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>WEBDEV CREATIONS</title>
    <link rel="stylesheet" type="text/css" href="style11.css">

  </head>

  <body>
    <header>


      <div class="title">
        <h1>Kilometers in Patra</h1>
      </div>

    </header>

    <div class="container">
      <a href="#" class="button"id="button">Login</a>
      <a href="#" class="button"id="button1">Sign up</a>
    </div>

    <div class="popup">

    <form id="Login" action="checkLogIn.php" method="post" >

      <div class="popup-content">
        <img src="close.png" class="close">
        <div class="user">
          <img src="user.jpg" alt="User">
        </div>

        <p>
        <input type="text" id="username" name ="username" placeholder="username*"  required>
        <input type="password" id ="password1" name = "password1" placeholder="password*" required>
        <span id="divout1">* Τα πεδία είναι υποχρεωτικά</span>
        <p>
          <button type="submit" class="button" id = "login" name="login">Login</button>
        </p>

      </div>
      </form>
    </div>

    <div class="popup1">
      <form id="Signup" action="checkSignUp.php" method="post" >

      <div class="popup-content">

        <img src="close.png" class="close1">
        <div class="user">
          <img src="user.jpg" alt="User">
        </div>

        <label for="user">Registration</label>
        <input type="text" id="username1" name ="username1" placeholder="username*"   title="Give a username" required>
        <span id="out"></span>
        <input type="email" id= "email1" name = "email1" placeholder="email*" title="Give an e-mail address" required >
        <input type="password" id= "password" name = "password" placeholder="password*"
         pattern="(?=.*\d)(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}"
         title="Must contain at least one number, one special character, and one uppercase letter, and at least 8 or more characters" required>
         <span id="divout">* Τα πεδία είναι υποχρεωτικά</span>
        <p>
          <button type="submit" class="button" id = "submit" name="submit">Submit</button>
        </p>

      </div>
      </form>
    </div>
    <!-- <script src="jquery-3.2.1.min.js"></script> -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="login22.js" defer></script>
    <script src="signUp11.js"></script>
  </body>
</html>
