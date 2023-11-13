<?php

session_start();
require '../../database/database.php';
$message = '';


if (isset($_SESSION['shopping_list_slected'])) {
  echo $_SESSION['shopping_list_slected'];
  if (isset($_POST['save_SL'])) {

    // Verificar campos vacíos
    if (empty($_POST['nameSL']) || empty($_POST['precio'])) {
      $message = 'Both username and password are required';
      $_SESSION['message'] = 'Both fields are required';
      $_SESSION['message_type'] = 'warning';
      header('Location: /crud_app/views/products_by_shoppinglist.php');
    } else {

      $nombreSL = $_POST['nameSL'];
      $precio = $_POST['precio'];
      $shoppingListId = $_SESSION['id_shopping_list_slected'];
      $query = "INSERT INTO productos(nombre_producto,precio,id_listacompras) VALUES('$nombreSL',' $precio ','$shoppingListId')";
      $result = mysqli_query($conn, $query);

      if (!$result) {
        die("Query Failed.");
      }

      $_SESSION['message'] = 'Product List Saved Successfully in ' . $_SESSION['shopping_list_slected'];
      $_SESSION['message_type'] = 'success';
      unset($_SESSION['shopping_list_slected']);
      unset($_SESSION['id_shopping_list_slected']);
      header('Location: /crud_app/views/products_by_shoppinglist.php');

    }
  }
} else {
  $_SESSION['message'] = 'Please select a shopping list';
  $_SESSION['message_type'] = 'success';
  unset($_SESSION['shopping_list_slected']);
  unset($_SESSION['id_shopping_list_slected']);
  header('Location: /crud_app/views/products_by_shoppinglist.php');

}




// echo $_SESSION['shopping_list_slected'].'jejej';
?>