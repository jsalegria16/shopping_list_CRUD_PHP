<?php

  require '../database/database.php';

  session_start();
  $message = '';

  if (!empty($_POST['username']) && !empty($_POST['password'])) {

    // $records = $conn->prepare('SELECT id_usuario, username, clave FROM usuarios WHERE username = :MyUser');
    // $records->bindParam(':MyUser', $_POST['username']);
    // $records->execute(); # Ejecuto consulta
    // $results = $records->fetch(PDO::FETCH_ASSOC);

    $Mpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $Myusuario = $_POST['username'];
    $query = "SELECT id_usuario, username, clave FROM usuarios WHERE username = '$Myusuario'";
    $result = mysqli_query($conn, $query);

    // if (count($results) > 0 && password_verify($_POST['password'], $results['clave'])) {
    //   $_SESSION['user_id'] = $results['id_usuario'];
    //   header("Location: /crud_app");
    // } else {
    //   $message = 'Sorry, those credentials do not match';
    // }
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $usuario_valido = $row['username'] == $Myusuario;
      if ($usuario_valido && password_verify($_POST['password'], $row['clave'])) {
          $_SESSION['user_id'] = $row['id_usuario'];
          header("Location: /crud_app");
      } else {
          $message = 'Sorry, those credentials do not match';
      }
    } else {
        $message = 'Invalid username';
    }
  }else{
    $message = 'Campos vacios!';
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>

   <?php require '../partials/header.php' ?>

   <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>
    <form action="login.php" method="POST">
      <input name="username" type="text" placeholder="Enter your username">
      <input name="password" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
