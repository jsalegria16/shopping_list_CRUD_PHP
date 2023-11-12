<?php

$server = 'localhost:3306';
$username = 'root';
$password = 'root';
$database = 'compras_db';

$conn = mysqli_connect(
  'localhost',
  'root',
  'root',
  'tareas_db'
  );

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
