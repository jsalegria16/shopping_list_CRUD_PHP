<?php
  session_start();

  require './database/database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id_usuario, username, clave FROM usuarios WHERE id_usuario = :Myid');
    $records->bindParam(':Myid', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome to your crud app</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['username']; ?>
      <br>You are Successfully Logged In
      <a href="./signup-login/logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>
      <a href="./signup-login/login.php">Login</a> or
      <a href="./signup-login/signup.php">SignUp</a>
    <?php endif; ?>



</body>

</html>