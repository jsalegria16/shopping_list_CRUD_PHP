<?php

require '../database/database.php';
$message = '';

session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: /crud_app');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Verificar campos vacíos
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $message = 'Both username and password are required';
  } else {
    $Mpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $Myusuario = $_POST['username'];
    $query = "SELECT id_usuario, username, clave FROM usuarios WHERE username = '$Myusuario'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $usuario_valido = $row['username'] == $Myusuario;
      if ($usuario_valido && password_verify($_POST['password'], $row['clave'])) {
        $_SESSION['user_id'] = $row['id_usuario'];
        header("Location: /crud_app/home.php");
      } else {
        $message = 'Sorry, those credentials do not match';
      }
    } else {
      $message = 'Invalid username';
    }
  }
}

?>


<?php include('../partials/header.php') ?>

<div class="container-fluid">
  
  <!-- Pills navs -->
  <ul class="nav nav-pills nav-justified mb-3 mt-5" id="ex1" role="tablist">
    <li class="nav-item " role="presentation">
      <a class="nav-link active border border-primary" id="tab-login" data-mdb-toggle="pill" href="./login.php" role="tab"
        aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link  border border-secundary ml-5" id="tab-register" data-mdb-toggle="pill" href="./signup.php" role="tab"
        aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
  </ul>
  <!-- Pills navs -->

  
</div>


<div class="container mt-5">
  <div class="row mb-4">
    <div class="col-md-6 mx-auto text-center">
        <?php if (!empty($message)): ?>
          <p>
            <?= $message ?>
          </p>
        <?php endif; ?>
        <h1>Login</h1>
        <span>or <a href="signup.php">SignUp</a></span>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mx-auto text-center">
      <form class="w-100" action="login.php" method="POST" novalidate>
        <!-- Username input -->
        <div class="mb-4">
          <input name="username" class="form-control" type="text" placeholder="Enter your username" required>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <input name="password" class="form-control" type="password" placeholder="Enter your Password" required>
        </div>

        <!-- Submit button -->
        <input class="btn btn-primary btn-block mb-4" type="submit" value="login">
      </form>
    </div>
  </div>
</div>





<?php include('../partials/footer.php') ?>