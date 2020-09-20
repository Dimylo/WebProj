<?php
  //session_start();
  // Create connection
  $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
  // Check connection
  if (!$conn) {
    die("Connection failed: " . pg_connect_error());
  }

//  $id = $_SESSION['id'];
  $out = array();
  $result = pg_query($conn, "SELECT id FROM users");
  $usr = pg_fetch_assoc($result);
  foreach($usr as $id) {
    $loc = pg_query($conn, "SELECT * FROM usr_locations WHERE usr_id = '$id'");
    $res = pg_fetch_all($loc);
    foreach($res as $attr) {
      echo $attr['loc_id']."<br>";
      $loc_id = $attr['loc_id'];
      $activity = pg_query($conn, "SELECT * FROM loc_activities WHERE floc_id = '$loc_id'");
      $act = pg_fetch_all($activity);
      $loc_act = array();
      foreach($act as $par) {
        $loc_act[] = array('timestampMs'=>$par['act_timestamps'],
                           'type'=>$par['act_type']);
      }
      // echo $act."<br>";
      $out[] = array('usr_id'=>$id,
                     'timestampMs'=>$attr['timestamps'],
                     'latitudee7'=>$attr['latitudee7'],
                     'longitudee7'=>$attr['longitudee7'],
                     'accuracy'=>$attr['accuracy'],
                     'activity'=>$loc_act,
                     'date_upload'=>$attr['date_upload']);
    }
  }
  $fp = fopen('exports.json', 'w');
  fwrite($fp, json_encode($out, JSON_PRETTY_PRINT));
  fclose($fp);
?>
