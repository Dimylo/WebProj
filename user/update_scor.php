<?php
session_start();

$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
$id=$_SESSION['username'];
$result = pg_query($conn, " SELECT  username, SUM(counter) as rank
 FROM (SELECT loc_activities.act_type,count(loc_activities.act_type) as counter,usr_id  from usr_locations
 INNER JOIN loc_activities ON loc_activities.floc_id = usr_locations.loc_id
 WHERE loc_activities.act_type='ON_FOOT' OR loc_activities.act_type='ON_BICYCLE' OR loc_activities.act_type='IN_VEHICLE' OR loc_activities.act_type='EXITING_VEHICLE'
 GROUP BY usr_id,loc_activities.act_type ORDER BY usr_id,loc_activities.act_type) as FIRST
 INNER JOIN users ON usr_id=users.id
 GROUP BY username
 union
 SELECT username, SUM(counter) as rank
 FROM (SELECT loc_activities.act_type,count(loc_activities.act_type) as counter,usr_id  from usr_locations
  INNER JOIN loc_activities ON loc_activities.floc_id = usr_locations.loc_id
  WHERE loc_activities.act_type='ON_FOOT' OR loc_activities.act_type='ON_BICYCLE'
  GROUP BY usr_id,loc_activities.act_type ORDER BY usr_id,loc_activities.act_type) as FIRST
  INNER JOIN users ON usr_id=users.id
  GROUP BY username
  ORDER BY username,rank");


  $data = array();


while($row = pg_fetch_assoc($result)){

  $data[] = $row;
}
array_push($data,$id);
echo json_encode($data);

?>
