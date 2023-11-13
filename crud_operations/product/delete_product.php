<?php

include('../../database/database.php');
session_start();

if(isset($_GET['id_pruducto'])) {

  $id_pruducto = $_GET['id_pruducto'];
  $query = "DELETE FROM productos WHERE id_producto = $id_pruducto";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Product Removed Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: /crud_app/views/products_by_shoppinglist.php');


}

?>
