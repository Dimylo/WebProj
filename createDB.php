<?php
  $servername = 'localhost';
  $username = 'postgres';
  $password = 'root';

  // Create connection
  $conn = pg_connect('host='.$servername.' port=5432 user='.$username.' password='.$password);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . pg_connect_error());
  }

  // Create database
  pg_query('DROP DATABASE IF EXISTS myDB');
  $sql = "CREATE DATABASE mydb";
  if (pg_query($conn, $sql)) {
    echo "Database created successfully <br>";
  } else {
    echo "Error creating database: " . pg_error($conn);
  }

  $conn = pg_connect('host='.$servername.' port=5432 dbname=mydb user='.$username.' password='.$password);
  $sql = "CREATE TABLE admins (
          id serial PRIMARY KEY,
          username VARCHAR NOT NULL,
          password VARCHAR NOT NULL
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  $sql = "CREATE TABLE users (
          id serial PRIMARY KEY,
          username VARCHAR NOT NULL,
          password VARCHAR NOT NULL,
          email VARCHAR NOT NULL
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  $sql = "CREATE TABLE usr_locations (
          -- usr_id integer REFERENCES users(id),
          loc_id integer UNIQUE NOT NULL,
          timestamps bigint NOT NULL,
          latitudeE7 integer,
          longtitudeE7 integer,
          accuracy integer,
          PRIMARY KEY(loc_id)
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  $sql = "CREATE TABLE loc_activities (
          act_id integer REFERENCES usr_locations(loc_id),
          act_timestamps bigint NOT NULL,
          act_type VARCHAR,
          PRIMARY KEY(act_id, act_timestamps)
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  pg_close($conn);
?>
