<?php


session_start();
session_unset();
// unset($_SESSION['id'],$_SESSION['username']);
header('location:/WEB_APPS/login_page/LogInSignUp.php');



?>
