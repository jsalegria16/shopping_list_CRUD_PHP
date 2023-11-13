<?php

require './database/database.php';

session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: /crud_app/home.php');
}

if (isset($_SESSION['user_id'])) {

  $user = null;

  $my_id = $_SESSION['user_id'];
  $query = "SELECT id_usuario, username, clave FROM usuarios WHERE id_usuario = '$my_id'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user = $row;
  }

}
?>

<?php include('./partials/header.php') ?>
<?php
if (!empty($user)): ?>
  <br> Welcome.
  <?= $user['username']; ?>
  <br>You are Successfully Logged In
  <a href="./signup-login/logout.php">
    Logout
  </a>
<?php else: ?>
  <div></div>
  <h1>Please Login or SignUp</h1>
  <a href="./signup-login/login.php">Login</a> or
  <a href="./signup-login/signup.php">SignUp</a>
  </div>
<?php endif;
?>


<?php include('./partials/footer.php') ?>