<?php
  $servername = 'localhost';
  $username = 'postgres';
  $password = '1234';

  // Create connection
  $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
  // Check connection

  $target_dir = "uploads/";
  $filename = $target_dir.basename($_FILES["fileToUpload"]["name"]);
  $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));


  if ($fileType != "json") {
    die("This is not a JSON file. Upload Failed. <br>");
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filename)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. <br>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    /////////////////////////////////INITIALIZATIONS/////////////////////////////////////////////////
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    //////////////////////////////////////////////////////////////////////////////////////////////////

    $array = json_decode(file_get_contents($filename), true);

    $array = $array['locations'];
    foreach($array as $row) {
      if(isset($row["activity"])) {
        if($row["accuracy"] < 5000 && dist10kmRadius($row["latitudeE7"], $row["longitudeE7"])) {
          $sql = "INSERT INTO usr_locations(timestamps, latitudeE7, longtitudeE7, accuracy)
          VALUES('".$row["timestampMs"]."','".$row["latitudeE7"]."','".$row["longitudeE7"]."','".$row["accuracy"]."')";
          if(!pg_query($conn, $sql)) {
            echo "Error inserting values: " . pg_error($conn);
          }
          $sql = "SELECT currval(pg_get_serial_sequence('usr_locations', 'loc_id'))";
          $x = pg_query($conn, $sql);
          $forkey = pg_fetch_row($x)[0]; //stores the last id of table usr_locations

          foreach($row['activity'] as $act) {

            $type = $act['activity'][0]['type'];
            $sql = "INSERT INTO loc_activities(act_timestamps, act_type, floc_id)
            VALUES('".$act["timestampMs"]."','".$type."','".$forkey."')";
            if(!pg_query($conn, $sql)) {
              echo "Error inserting values: " . pg_error($conn);
            }
          }
        }
      }
    }
  }

  function dist10kmRadius($latitude, $longitude) {
    $distance = 10;                 //The radius of our circle
    $radius = 6371;                 //Earth's radius
    $lat = 38.230462;
    $lng = 21.753150;

    $lat1 = $latitude * 1e-7;
    $lng1 = $longitude * 1e-7;
    $dLon = deg2rad($lng1 - $lng);
    $resDistance = acos(sin(deg2rad($lat)) * sin(deg2rad($lat1)) + cos(deg2rad($lat)) * cos(deg2rad($lat1)) * cos($dLon));

    $resDistance = $radius * $resDistance;
    if ( $resDistance > $distance ) {
      echo "eisai makria bro<br>";
      return 0;
    } else {
      echo "koble <br>";
      return 1;
    }
  }
?>
