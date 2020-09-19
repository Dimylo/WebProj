<?php
 session_start();
//strtotime("3 October 2005")
$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=12345');

$result = pg_query($conn, "SELECT loc_activities.act_type,  COUNT(*) AS num
      from usr_locations INNER JOIN loc_activities ON loc_activities.floc_id = usr_locations.loc_id
      GROUP BY loc_activities.act_type
      ORDER BY loc_activities.act_type");

$data = array();

while($row = pg_fetch_assoc($result)){

   $data[] = $row;
}
echo json_encode($data);
?>
