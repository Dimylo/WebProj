<?php
session_start();
$email = "";
$errors = array();
$db = pg_connect("host=localhost dbname=mydb user=postgres password=root");


if (isset($_POST['Signup'])) {
  $username = pg_escape_string($db, $_POST['username']);
  $password = pg_escape_string($db, $_POST['password']);
  $email = pg_escape_string($db, $_POST['email']);

  if (empty($email)) { array_push($errors, "Απαιτείται email"); }
  if (empty($password)) { array_push($errors, "Απαιτείται κωδικός"); }
  if (empty($username)) { array_push($errors, "Απαιτείται τηλέφωνο"); }
  $user_check_query = "SELECT * FROM admin WHERE email='$email'";
  $result = pg_query($db, $user_check_query);
  $user = pg_fetch_assoc($result);

  if ($user) {
        if ($user['email'] === $email) {
      array_push($errors, "Το email υπάρχει ήδη");
    }
  }
  if (count($errors) == 0) {

  	$query = "INSERT INTO admin (username, password, email) VALUES('$username', '$password', '$email')";
  	pg_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Είστε Συνδεδεμένος";

  }
}

// LOGIN USER
if (isset($_POST['Login'])) {
  $username = pg_escape_string($db, $_POST['username']);
  $password = pg_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Απαιτείται email");
  }
  if (empty($password)) {
  	array_push($errors, "Απαιτείται κωδικός");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  	$results = pg_query($db, $query);
  	if (pg_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "";
      echo "welcome";
  	 // header('location: index.php');
  	}else {
  		array_push($errors, "Λανθασμένος συνδιασμός email/password");
  	}
  }
}

?>
