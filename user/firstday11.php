<?php
session_start();

$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');

 $id = $_SESSION['id'];
if (isset( $_POST['start1'],$_POST['last1'] )){
     $start = $_POST["start1"];
     $last = $_POST["last1"];

     //CAST(loc_activities.act_timestamps AS VARCHAR(6))

$result = pg_query($conn, " SELECT DISTINCT ON(loc_activities.act_type) loc_activities.act_type AS activity,
   to_char(TO_TIMESTAMP(loc_activities.act_timestamps), 'DAY') as topday,
  count(*) AS num_of_activity
  from usr_locations
  INNER JOIN loc_activities ON loc_activities.floc_id = usr_locations.loc_id
  WHERE loc_activities.act_timestamps BETWEEN '$start' AND '$last' AND usr_id = '$id'
  GROUP BY  loc_activities.act_type,topday
  ORDER BY loc_activities.act_type, num_of_activity DESC");



     $data = array();

     while($row = pg_fetch_assoc($result)){

        $data[] = $row;
      }
    echo json_encode($data);
  }

  ?>
