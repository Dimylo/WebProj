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
  pg_query('DROP DATABASE IF EXISTS test');
  $sql = "CREATE DATABASE test";
  if (pg_query($conn, $sql)) {
    echo "Database created successfully <br>";
  } else {
    echo "Error creating database: " . pg_error($conn);
  }
  echo $_POST["urname"] ."<br>";

  $conn = pg_connect('host='.$servername.' port=5432 dbname=test user='.$username.' password='.$password);
  $sql = "CREATE TABLE test1 (
          id serial PRIMARY KEY,
          username VARCHAR NOT NULL,
          password VARCHAR NOT NULL
        )";
    echo "Table created successfully <br>";
    if (pg_query($conn, $sql)) {
  } else {
    echo "Error creating table: " . pg_error($conn);
  }

  $urn = $_POST["urname"];
  $sql = "INSERT INTO test1 (id, username, password)
          VALUES (1, '$urn', 'miamalakia')";

  pg_query($conn, $sql)
?>
