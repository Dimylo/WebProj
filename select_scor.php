<?php
$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=1234');
$result = pg_query($conn, "select *from loc_activities");

$data = array();

while($row = pg_fetch_assoc($result)){

  $data[] = $row;
}
echo json_encode($data);
 ?>
