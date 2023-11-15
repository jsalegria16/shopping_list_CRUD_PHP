<?php

require './database/database.php';

session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: /crud_app/home.php');
}

?>

<?php include('./partials/header.php') ?>


<div class="container-fluid text-center"> <!-- Añadí la clase "text-center" para centrar el contenido -->
  <h1>Welcome </h1>
  <h3>Please Login or SignUp</h3>
  <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link border border-primary" id="tab-login" data-mdb-toggle="pill" href="./signup-login/login.php"
        role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link border border-secondary ml-5" id="tab-register" data-mdb-toggle="pill"
        href="./signup-login/signup.php" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
  </ul>
<img src="https://www.eatwell101.com/wp-content/uploads/2012/02/A-Beginner%E2%80%99s-Shopping-List.jpg" class="img-fluid h-60" alt="Responsive image">

</div>


<?php include('./partials/footer.php') ?>