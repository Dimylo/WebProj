<?php


session_start();
session_unset();
// unset($_SESSION['id'],$_SESSION['username']);
header('location:LogInSignUp.php');



?>
