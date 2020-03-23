<?php
  $servername = 'localhost';
  $username = 'postgres';
  $password = '1234';

  // Create connection
  $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
  // Check connection

  $target_dir = "uploads/";
  $filename = $target_dir.basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

  if ($fileType != "json") {
    echo "RE FYGE RE MLKA APO DW RE BRO";
    $uploadOk = 0;
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filename)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $data = file_get_contents($filename);
    $array = json_decode($data, true);

    $array = $array['locations'];

    $id = 1;      //represemts the ID of location values(loc_id)

    foreach($array as $row) {
      $sql = "INSERT INTO usr_locations(loc_id, timestamps, latitudeE7, longtitudeE7, accuracy)
      VALUES('".$id."','".$row["timestampMs"]."','".$row["latitudeE7"]."','".$row["longitudeE7"]."','".$row["accuracy"]."')";
      if(!pg_query($conn, $sql)) {
        echo "Error inserting values: " . pg_error($conn);
      }

      $activity = $row['activity'];
      foreach($activity as $act) {
        $attrs = $act['activity'];

        $type = $act['activity'][0]['type'];
        $sql = "INSERT INTO loc_activities(act_timestamps, act_type, act_id)
        VALUES('".$act["timestampMs"]."','".$type."','".$id."')";
        if(!pg_query($conn, $sql)) {
          echo "Error inserting values: " . pg_error($conn);
        }
      }

      $id++;
    }
  }

?>
