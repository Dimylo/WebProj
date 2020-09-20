<?php
header("Refresh:0");
session_start();
session_unset();

$db = pg_connect("host=localhost dbname=mydb user=postgres password=root");

 if(isset($_POST["email"])){
    $mail = pg_query($db, "SELECT * FROM users WHERE email='" .$_POST["email"]."'");
       if (pg_num_rows($mail) > 0){
           echo 'KO';
           exit();
       }
       else{
        echo 'EMAIL';
        exit();
       }
  }
 if(isset($_POST["uname"])){
  $uname1 = pg_query($db, "SELECT * FROM users WHERE username='" .$_POST["uname"]."'");
  $uname2 = pg_query($db, "SELECT * FROM admins WHERE username='" .$_POST["uname"]."'");
      if ((pg_num_rows($uname1) > 0) || (pg_num_rows($uname2) > 0)){
          echo 'KOname';
          exit();
      }
      else{
         echo 'UNAME';
         exit();
      }
  }
//SIGN UP
if(isset($_POST['submit'])) {
    $username = pg_escape_string($db,trim($_POST['username1']));
    $password = pg_escape_string($db,sha1(trim($_POST["password"])));
    $email = pg_escape_string($db, $_POST["email1"]);
    //two_way_encryption
    $enc_key = pg_escape_string($db, $_POST['password']);
    $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-ctr'));
    $crypted_token = openssl_encrypt(pg_escape_string($db, $_POST['email1']), 'aes-128-ctr', $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
      list($crypted_token, $enc_iv) = explode("::", $crypted_token);


      //Insert user into database
    	$insert =pg_query($db, "INSERT INTO users (id,username,password,email) VALUES('$crypted_token','$username', '$password', '$email')");
      $_SESSION['username'] = $username;
    	$_SESSION['email'] = $email;
    	$_SESSION['success'] = "Είστε Συνδεδεμένος";
      $_SESSION['id'] = $crypted_token;
      echo'$username , welcome';
      header('location:/WEB_APPS/user/main_user.php');
      exit();
    }
?>
