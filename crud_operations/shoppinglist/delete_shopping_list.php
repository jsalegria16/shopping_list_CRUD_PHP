<?php

include('../../database/database.php');
session_start();

if(isset($_GET['id_lista_compras'])) {

  $id_lista_compras = $_GET['id_lista_compras'];
  $query = "DELETE FROM lista_compras WHERE id_lista_compras = $id_lista_compras";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Shopping list Removed Successfully';
  $_SESSION['message_type'] = 'warning';
  header("Location: /crud_app/home.php");

}

?>
