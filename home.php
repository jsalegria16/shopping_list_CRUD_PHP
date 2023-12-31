<?php
session_start();

require './database/database.php';

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

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Listas de Compras</a>
    <a class="navbar-brand" href="./views/products_by_shoppinglist.php">Productos por lista de compras</a>

    <div class="d-flex align-items-start">
      <?php if (!empty($user)): ?>
        <p class="navbar-brand align-middle">
          Bienvenido
          <strong>
            <?= $user['username']; ?>
          </strong>
        </p>
      <?php endif; ?>

      <a href="./signup-login/logout.php" class="p-2 btn btn-light">
        Logout
      </a>
    </div>


  </div>
</nav>

<?php include('./views/shoppinglist.php') ?>


<?php include('./partials/footer.php') ?>