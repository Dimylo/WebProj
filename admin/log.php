<?php
session_start();

$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=12345');



$result = pg_query($conn, "select users.username, count(*) AS num from users INNER JOIN usr_locations ON  usr_locations.usr_id = users.id GROUP BY users.id");

  $data = array();

   while($row = pg_fetch_assoc($result)){

     $data[] = $row;
   }
   echo json_encode($data);
  ?>
