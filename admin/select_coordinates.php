<?php
session_start();

$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');

$id = $_SESSION['id'];
 if (isset( $_POST['start1'],$_POST['last1'],$_POST['data'] )){
$arr=$_POST['data'];
// $values = array_map('escape',$_POST['data']);
// $ids = array_filter(array_unique($aaa)));
$start = $_POST["start1"];
$last = $_POST["last1"];
$result = pg_query($conn, " SELECT loc_activities.act_type as activity,latitudee7,longtitudee7
   FROM usr_locations
   INNER JOIN loc_activities
   ON loc_activities.floc_id=usr_locations.loc_id
   WHERE loc_activities.act_type IN  ('". implode("','", $arr). "')
   AND timestamps>=$start AND timestamps<=$last ");
$data = array();

while($row = pg_fetch_assoc($result)){

  $data[] = $row;
}
echo json_encode($data);
}

 ?>
