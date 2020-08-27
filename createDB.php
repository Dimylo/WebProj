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
          id VARCHAR NOT NULL,
          username VARCHAR NOT NULL,
          password VARCHAR NOT NULL,
          email VARCHAR NOT NULL,
          PRIMARY KEY(id)
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  $sql = "CREATE TABLE restrictions (
          usr_id VARCHAR REFERENCES users(id),
          dim_id serial UNIQUE NOT NULL,
          north DOUBLE PRECISION NOT NULL,
          south DOUBLE PRECISION NOT NULL,
          east DOUBLE PRECISION NOT NULL,
          west DOUBLE PRECISION NOT NULL,
          PRIMARY KEY(usr_id, dim_id)
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  $sql = "CREATE TABLE usr_locations (
          usr_id VARCHAR REFERENCES users(id),
          loc_id bigserial UNIQUE NOT NULL,
          timestamps timestamp NOT NULL,
          latitudeE7 float,
          longtitudeE7 float,
          accuracy integer,
          date_upload DATE,
          PRIMARY KEY(loc_id, usr_id)
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  $sql = "CREATE TABLE loc_activities (
          act_id bigserial UNIQUE NOT NULL,
          floc_id bigint REFERENCES usr_locations(loc_id),
          act_timestamps timestamp NOT NULL,
          act_type VARCHAR,
          PRIMARY KEY(act_id, floc_id)
        )";
  if (pg_query($conn, $sql)) {
    echo "Table created successfully <br>";
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  pg_close($conn);
?>
