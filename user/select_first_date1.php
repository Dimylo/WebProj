<?php
 session_start();

 	$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');


 	$id = $_SESSION['id'];

 	$sql = "SELECT MAX(usr_locations.timestamps), MIN(usr_locations.timestamps) from usr_locations where usr_id= '$id'";

 	$result = pg_query($conn, $sql);
 	$data = array();

  $data[] = pg_fetch_assoc($result);

 	echo json_encode($data);
  ?>
