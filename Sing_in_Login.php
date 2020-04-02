<?php
session_start();
$email = "";
$errors = array();
$db = pg_connect("host=localhost dbname=mydb user=postgres password=1234");


if (isset($_POST['Signup'])) {
  $username = pg_escape_string($db, $_POST['username']);
  $password = pg_escape_string($db, $_POST['password']);
  $email = pg_escape_string($db, $_POST['email']);

  if (empty($email)) { array_push($errors, "Απαιτείται email"); }
  if (empty($password)) { array_push($errors, "Απαιτείται κωδικός"); }
  if (empty($username)) { array_push($errors, "Απαιτείται τηλέφωνο"); }
  $user_check_query = "SELECT * FROM users WHERE email='$email'";
  $result = pg_query($db, $user_check_query);
  $user = pg_fetch_assoc($result);

  if ($user) {
        if ($user['email'] === $email) {
      array_push($errors, "Το email υπάρχει ήδη");
    }
  }
  if (count($errors) == 0) {

  	$query = "INSERT INTO users (username, password, email) VALUES('$username', '$password', '$email')";
  	pg_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Είστε Συνδεδεμένος";
    header('location: main_user.php');
  }
}

// LOGIN USER/////////////////edwwwwwwwwwwwwwwwwwwwwwwwww
if (isset($_POST['Login_admin'])) {
  $username = pg_escape_string($db, $_POST['username']);
  $password = pg_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Απαιτείται username");
  }
  if (empty($password)) {
  	array_push($errors, "Απαιτείται κωδικός");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
  	$results = pg_query($db, $query);
  	if (pg_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "";
  	  header('location: main_admin.html');
  	}else {
      echo"dddd";
  		array_push($errors, "Λανθασμένος συνδιασμός email/password");
  	}
  }else {
    echo "empty";
  }
}

//eswwwwwwwwwwwwwwwwwwwwwwwwwwww

if (isset($_POST['Login_user'])) {
  $username = pg_escape_string($db, $_POST['username']);
  $password = pg_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Απαιτείται username");
  }
  if (empty($password)) {
  	array_push($errors, "Απαιτείται κωδικός");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = pg_query($db, $query);
  	if (pg_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "";
  	  header('location: main_user.php');
  	}else {
      echo"dddd";

  		array_push($errors, "Λανθασμένος συνδιασμός email/password");
  	}
  }else {
    echo "empty";
  }
}


?>
