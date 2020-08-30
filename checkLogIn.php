<?php

header("Refresh:0");

$db = pg_connect("host=localhost dbname=mydb user=postgres password=root");

session_start();

 if (isset( $_POST['uname'],$_POST['pass'] )) {

   // session_unset();

  $username = pg_escape_string($db,trim($_POST['uname']));
  $password = pg_escape_string($db,sha1(trim($_POST["pass"])));
  $adminpass=pg_escape_string($db,trim($_POST['pass']));

  $admin = pg_query($db,"SELECT id FROM admins WHERE username='$username' AND password='$adminpass'");
  $user = pg_query($db,"SELECT id FROM users WHERE username='$username' AND password='$password'");


  if ((pg_num_rows($user) == 0) && (pg_num_rows($admin) == 0)) {

    echo 'ola';
    exit();
  }
  elseif((pg_num_rows($user)>0) && (pg_num_rows($admin) == 0)) {
    echo 'kola';
    $row = pg_fetch_result($user,0,0);
    $_SESSION['username'] = $username;
    $_SESSION['id'] = "$row";
  }
  elseif((pg_num_rows($user)==0) && (pg_num_rows($admin) > 0)) {
    echo 'koka';
    $row = pg_fetch_result($admin,0,0);
    $_SESSION['username'] = $username;
    $_SESSION['id'] = "$row";
  }
 } else {
  header('location:mainuser.php');
 }
?>
