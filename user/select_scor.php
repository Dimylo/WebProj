<?php
session_start();

$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');

$id = $_SESSION['id'];
$result = pg_query($conn, "SELECT loc_activities.act_type from usr_locations INNER JOIN loc_activities
ON loc_activities.floc_id = usr_locations.loc_id where usr_id = '$id'");


$data = array();

while($row = pg_fetch_assoc($result)){

  $data[] = $row;
}
echo json_encode($data);
 ?>
