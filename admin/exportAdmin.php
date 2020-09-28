<?php
  // session_start();
  // Create connection
  $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=12345');
  // Check connection
  if (!$conn) {
    die("Connection failed: " . pg_connect_error());
  }

   $data = array();
  if (isset( $_POST['start1'],$_POST['last1'],$_POST['data'] )){
 $arr=$_POST['data'];
 // $values = array_map('escape',$_POST['data']);
 // $ids = array_filter(array_unique($aaa)));
 $start = $_POST["start1"];
 $last = $_POST["last1"];
 $result = pg_query($conn, " SELECT *
    FROM usr_locations
    INNER JOIN loc_activities
    ON loc_activities.floc_id=usr_locations.loc_id
    WHERE loc_activities.act_type IN  ('". implode("','", $arr). "')
    AND timestamps>=$start AND timestamps<=$last ");

 while($row = pg_fetch_assoc($result)){

   $data[] = $row;
 }
 echo json_encode($data);
 }
 $fp = fopen('exports.json', 'w');
 fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
 fclose($fp);
?>
