<?php
session_start();
$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
$id = $_SESSION['id'];
$result = pg_query($conn, "select usr_locations.date_upload  from usr_locations WHERE usr_id= '$id'  ORDER BY date_upload DESC LIMIT 1");

$data = array();

while($row = pg_fetch_assoc($result)){

  $data[] = $row;
}
echo json_encode($data);
 ?>
