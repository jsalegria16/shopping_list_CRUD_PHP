<?php

$server = 'localhost:3306';
$username = 'root';
$password = 'root';
$database = 'compras_db';

try {
  // $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  $conn = mysqli_connect(
    $server,
    $username,
    $password ,
    $database
  );  
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
