<?php

include('../database/database.php');
session_start();

if(isset($_GET['id_lista_compras'])) {

  $id = $_GET['id_lista_compras'];
  $query = "DELETE FROM lista_compras WHERE id_lista_compras = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header("Location: /crud_app/home.php");

}

?>
