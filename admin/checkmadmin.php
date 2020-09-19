<?php
session_start();
if(!isset($_SESSION['id'])){ //if login in session is not set
  
    header("Location: http://www.example.com/login.php");
} ?>
