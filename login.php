<?php
header("Refresh");
session_start();

$db = pg_connect("host=localhost dbname=mydb user=postgres password=12345");

//SIGN UP
if (isset($_POST['Signup']))
{
  $username = pg_escape_string($db,trim($_POST['username']));
  $password = pg_escape_string($db,sha1(trim($_POST['password'])));
  $email = pg_escape_string($db, $_POST['email']);
  //two_way_encryption
  $enc_key = pg_escape_string($db, $_POST['password']);
  $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-ctr'));
  $crypted_token = openssl_encrypt(pg_escape_string($db, $_POST['email']), 'aes-128-ctr', $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
  //checking db
  $user1 = pg_query($db, "SELECT * FROM users WHERE email='$email' OR username='$username'");
  $user2 = pg_query($db, "SELECT * FROM admins WHERE username='$username'");
  //checking if email is already used
   if (pg_num_rows($user1) > 0 || pg_num_rows($user2) > 0)
   {
     echo "<script>alert('username or mail already used');</script>";
     session_unset();
   }
  else
  {
      list($crypted_token, $enc_iv) = explode("::", $crypted_token);
      //decrytping, if needed, user's id

    //  $cipher_method = ;
    //  $enc_key = openssl_digest(pg_escape_string($db, $_POST['password']), 'SHA256', TRUE);
    //  $id = openssl_decrypt($crypted_token, 'aes-128-ctr', $enc_key, 0, hex2bin($enc_iv));
      //unset($crypted_token, $enc_key, $enc_iv);

      //logging user into database
    	$insert =pg_query($db, "INSERT INTO users (id,username,password,email) VALUES('$crypted_token','$username', '$password', '$email')");
    	$_SESSION['email'] = $email;
    	$_SESSION['success'] = "Είστε Συνδεδεμένος";
      $_SESSION['id'] = $crypted_token;
      header('location: mainuser.php');
    }
}
// LOGIN USER
if (isset($_POST['Login']))
 {
  $username = pg_escape_string($db, trim($_POST['username']));
  $password = pg_escape_string($db,sha1(trim($_POST['password'])));
  $adminpass=pg_escape_string($db,trim($_POST['password']));
//getting user's and admins ids
  	$admin = pg_query($db,"SELECT id FROM admins WHERE username='$username' AND password='$adminpass'");
    $user = pg_query($db,"SELECT id FROM users WHERE username='$username' AND password='$password'");
//redirecting admin to main page
  	if ((pg_num_rows($admin) > 0) && (pg_num_rows($user) === 0) )
    {
     $row = pg_fetch_result($admin,0,0);
  	  $_SESSION['username'] = $username;
  	  $_SESSION['id'] = "$row";
      header('location: main.php');
  	}
//redirecting user to main page
    elseif ((pg_num_rows($user) > 0) && (pg_num_rows($admin) === 0) )
    {
      $row = pg_fetch_result($user,0,0);
   	  $_SESSION['username'] = $username;
   	  $_SESSION['id'] = "$row";
       header('location: mainuser.php');
    }
    else {
  		echo "<script>alert('wrong mail or password');</script>";
      session_unset();
  	}
  }
?>

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
          <li><a href="#">About</a></li>
          <li><a href="#">Content</a></li>
        </ul>
      </div>
      <div class="title">
        <h1>Kilometers in Patra</h1>
      </div>
    </header>


    <div class="container">
      <a href="#" class="button"id="button">Login</a>
      <a href="#" class="button"id="button1">Sign up</a>
    </div>

    <div class="popup">

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

      <div class="popup-content">
        <img src="close.png" class="close">
        <div class="user">
          <img src="user.jpg" alt="User">
        </div>
        <p>
        <input type="text" id= "username" name = "username" placeholder="username"  required>
        <input type="password" id ="password" name = "password"placeholder="password" required>
        <p><button type="submit" class="button" id = "button" name="Login">Login</button>
        </p>
      </div>
      </form>
    </div>

    <div class="popup1">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
        <!-- instead of login.php -->
      <div class="popup-content">
        <img src="close.png" class="close1">
        <div class="user">
          <img src="user.jpg" alt="User">
        </div>
        <label for="user">Registration</label>
        <input type="text" id= "username" name = "username" placeholder="username*"   title="Give a username" required>
        <input type="email" id= "email" name = "email" placeholder="email*" title="Give an e-mail" required >
        <input type="password" id= "password" name = "password" placeholder="password*"
         pattern="(?=.*\d)(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}"
         title="Must contain at least one number, one special character, and one uppercase letter, and at least 8 or more characters" required>
           * Τα πεδία είναι υποχρεωτικά
        <p>
          <button type="submit" class="button" id = "button1" name="Signup">Signup</button>
        </p>
      </div>
      </form>
    </div>


    <script type="text/javascript">
//Ανοιγμα και κλεισιμο των popups για signup και login
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
