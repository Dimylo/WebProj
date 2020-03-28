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
        if($row["accuracy"] < 5000 && ) {
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

?>
