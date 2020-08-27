<?php
 session_start();

 	$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');


 	$id = $_SESSION['id'];

 	$sql = "select MAX(usr_locations.date_upload), MIN(usr_locations.date_upload) from usr_locations where usr_id= '$id'";

 	$result = pg_query($conn, $sql);
 	$data = array();

  $data[] = pg_fetch_assoc($result);
 	// while($row = pg_fetch_assoc($result)){
  //
 	//   $data[] = $row;
 	// }
 	echo json_encode($data);
  ?>
