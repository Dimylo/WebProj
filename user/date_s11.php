<?php
 session_start();

 $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
 $id = $_SESSION['id'];

 if (isset( $_POST['start1'],$_POST['last1'] )){

      $result = pg_query($conn, "SELECT  loc_activities.act_type,
      COUNT(*) AS num from usr_locations
      INNER JOIN loc_activities
      ON loc_activities.floc_id = usr_locations.loc_id
      WHERE loc_activities.act_timestamps
      BETWEEN '".$_POST['start1']."' AND '".$_POST['last1']."'
      AND usr_id = '$id'
      GROUP BY loc_activities.act_type
      ORDER BY loc_activities.act_type");

      $data = array();
      while($row = pg_fetch_assoc($result)){

        $data[] = $row;
      }
      echo json_encode($data);
}
?>
