<?php

session_start();
require '../database/database.php';
$message = '';

if (isset($_POST['save_SL'])) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar campos vacíos
    if (empty($_POST['nameSL']) || empty($_POST['descriptionSL'])) {
      $message = 'Both username and password are required';
      $_SESSION['message'] = 'Both fields are required';
      $_SESSION['message_type'] = 'warning';
      header('Location: /crud_app/home.php');
    } else {
      echo $_POST['nameSL'];
      echo $_POST['descriptionSL'];
      echo $_SESSION['user_id'];
      $nombreSL = $_POST['nameSL'];
      $DescriSL = $_POST['descriptionSL'];
      $userId = $_SESSION['user_id'];
      $query = "INSERT INTO lista_compras(nombre_lista,idusuario,descrip_lista_compras) VALUES('$nombreSL',' $userId ','$DescriSL')";
      $result = mysqli_query($conn, $query);
      
      if(!$result) {
        die("Query Failed.");
      }
    
      $_SESSION['message'] = 'Shopping List Saved Successfully';
      $_SESSION['message_type'] = 'success';
      header('Location: /crud_app/index.php');

    }
  }
}

?>