


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
  <!-- <h1>Please Login or SignUp</h1> -->
  <!-- <a href="./signup-login/login.php">Login</a> or
  <a href="./signup-login/signup.php">SignUp</a> -->
  </div>
<?php endif;
?>

<div class="container-fluid">
  
  <!-- Pills navs -->
  <h1>Please Login or SignUp</h1>
  <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link border border-primary" id="tab-login" data-mdb-toggle="pill" href="./signup-login/login.php" role="tab"
        aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link border border-secundary ml-5" id="tab-register" data-mdb-toggle="pill" href="./signup-login/signup.php" role="tab"
        aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
  </ul>
  <!-- Pills navs -->

  
</div>

<?php include('./partials/footer.php') ?>