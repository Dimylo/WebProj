<?php
  //session_start();
  // Create connection
  $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
  // Check connection
  if (!$conn) {
    die("Connection failed: " . pg_connect_error());
  }

//  $id = $_SESSION['id'];
  $out = array();
  $result = pg_query($conn, "SELECT id FROM users");
  $usr = pg_fetch_assoc($result);
  foreach($usr as $id) {
    $loc = pg_query($conn, "SELECT * FROM usr_locations WHERE usr_id = '$id'");
    $attrs = pg_fetch_assoc($loc);
    foreach($attrs as $attr) {
      echo $attr."<br>";
    }
    $out[] = array('id' => $id);
  }
?>
