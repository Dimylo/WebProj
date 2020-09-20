<?php
  // Create connection
  $conn = pg_connect('host=localhost dbname=mydb port=5432 user=postgres password=root');
  // Check connection
  if (!$conn) {
    die("Connection failed: " . pg_connect_error());
  }

  $sql = 'DELETE FROM restrictions';
  if (pg_query($conn, $sql)) {
    echo "Record deleted successfully";
  }
  $sql = 'DELETE FROM loc_activities';
  if (pg_query($conn, $sql)) {
    echo "Record deleted successfully";
  }
  $sql = 'DELETE FROM usr_locations';
  if (pg_query($conn, $sql)) {
    echo "Record deleted successfully";
  }
  $sql = 'DELETE FROM users';
  if (pg_query($conn, $sql)) {
    echo "Record deleted successfully";
  }
?>
