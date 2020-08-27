<?php
	$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');

	session_start();
	$id = $_SESSION['id'];

	$sql = "SELECT MAX(upload_date), MIN(upload_date) from usr_locations WHERE usr_id  = '$id'";

	$result = pg_query($conn, $sql);
	$data = array();

	while($row = pg_fetch_assoc($result)){

	  $data[] = $row;
	}
	echo json_encode($data);
 ?>
