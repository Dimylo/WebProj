<?php
session_start();

$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');



$result = pg_query($conn, " SELECT  to_char(TO_TIMESTAMP(timestamps), 'MONTH') AS topday, COUNT(*) AS num from usr_locations GROUP BY topday ORDER BY topday DESC");

  $data = array();

   while($row = pg_fetch_assoc($result)){

     $data[] = $row;
   }
   echo json_encode($data);
  ?>
