<?php
  session_start();
  /////////////////////////NEED TO ADD $_SECTION PARAMETERS///////////////////////////

  // Create connection
  $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
  // Check connection
  if (!$conn) {
    die("Connection failed: " . pg_connect_error());
  }
$id = $_SESSION['id'];

if(isset($_GET['dimensions'])) {
  $dimensions = $_GET['dimensions'];
  $n = "";
  $s = "";
  $e = "";
  $w = "";

  $flag = 0;
  for($i = 5; $flag<2; $i++) {
    if($dimensions[$i] == "(" && $flag == 0) {
      $i++;
      $f = 0;
      for(; $dimensions[$i]!=")"; $i++) {
        if($dimensions[$i]==",") {
          $f++;
          $i++;
        }
        if($f == 0)
          $n = $n. $dimensions[$i];
        else
          $e = $e. $dimensions[$i];
        //$ne = $ne. $dimensions[$i];
      }
      $flag++;
      $i+=6;
    } elseif($dimensions[$i] == "(" && $flag == 1) {
      $i++;
      $f = 0;
      for(; $dimensions[$i]!=")"; $i++) {
        if($dimensions[$i]==",") {
          $f++;
          $i++;
        }
        if($f == 0)
          $s = $s. $dimensions[$i];
        else
          $w = $w. $dimensions[$i];
      }
      $flag++;
    }
  }

  $sql = "INSERT INTO restrictions(usr_id, north, south, east, west)
          VALUES ('".$id."','".$n."','".$s."','".$e."','".$w."')";
  if(!pg_query($conn, $sql)) {
    echo "Error inserting values: " . pg_error($conn);
  }
  echo "Insertion completed";
} else {
    $sql = "SELECT north, south, east, west FROM restrictions WHERE usr_id = '$id'";
    $result = pg_query($conn, $sql);

    $data = array();
    while($row = pg_fetch_assoc($result)) {
      $data[] = $row;
    }
    echo json_encode($data);
}
?>
