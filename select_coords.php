<?php
session_start();

$conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');

$id = $_SESSION['id'];

if (isset( $_POST['start1'],$_POST['last1'] )){
  $result = pg_query($conn, "SELECT latitudee7,longitudee7 FROM usr_locations WHERE usr_id = '$id' AND timestamps>='".$_POST['start1']."' AND timestamps<='".$_POST['last1']."'");
  $data = array();

  while($row = pg_fetch_assoc($result)){
    $data[] = $row;
  }
  echo json_encode($data);
}

?>
