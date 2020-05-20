<?php
header("Refresh:0");
// session_unset();
// session_start();

$db = pg_connect("host=localhost dbname=mydb user=postgres password=12345");


if ((isset($_POST['password'])) && (isset($_POST['username']))){
   session_start();
   session_unset();
  $username = pg_escape_string($db, trim($_POST['username']));
  $password = pg_escape_string($db,sha1(trim($_POST['password'])));
  $adminpass=pg_escape_string($db,trim($_POST['password']));
//getting user's and admins ids
  	$admin = pg_query($db,"SELECT id FROM admins WHERE username='$username' AND password='$adminpass'");
    $user = pg_query($db,"SELECT id FROM users WHERE username='$username' AND password='$password'");
//redirecting admin to main page
  	if ((pg_num_rows($admin) > 0) && (pg_num_rows($user) === 0) ){
     $row = pg_fetch_result($admin,0,0);
  	  $_SESSION['username'] = $username;
  	  $_SESSION['id'] = "$row";
      header('location: main.php');
      exit();
  	}
//redirecting user to main page
    elseif ((pg_num_rows($user) > 0) && (pg_num_rows($admin) === 0) ){
      $row = pg_fetch_result($user,0,0);
   	  $_SESSION['username'] = $username;
   	  $_SESSION['id'] = "$row";
       header('location: mainuser.php');
       exit();
    }

  elseif ((pg_num_rows($user) == 0) && (pg_num_rows($admin) === 0) ){
      echo '<script language="javascript">';
      echo 'alert("CHECK EMAIL OR PASSWORD");';
      echo 'window.location = "login.php"';
      echo '</script>';
  	}
  }

?>
