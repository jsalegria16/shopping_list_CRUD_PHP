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
    <a class="navbar-brand" href="index.php">PHP MySQL CRUD</a>

    <?php
    if (!empty($user)): ?>
      <p class="navbar-brand align-middle">
        Welcome
        <?= $user['username']; ?>
      </p>

      <a href="./signup-login/logout.php" class="navbar-brand border border-light p-2">
        Logout
      </a>
    <?php endif;
    ?>

  </div>
</nav>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- Mensajes de alerta  -->
      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
          <?= $_SESSION['message'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
      } ?>


      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="./crud_operations/save_shopping_list.php" method="POST">
          <div class="form-group">
            <input type="text" name="nameSL" class="form-control" placeholder="Nombre Lista de compras" autofocus>
          </div>
          <div class="form-group">
            <textarea name="descriptionSL" rows="2" class="form-control"
              placeholder="Description Lista de compras"></textarea>
          </div>
          <input type="submit" name="save_SL" class="btn btn-success btn-block" value="Add Shopping List">
        </form>
      </div>


    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id Lista de compras</th>
            <th>Name </th>
            <th>Description</th>
            <th>ID Usuario</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM lista_compras";
          $result_tasks = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <tr>
              <td>
                <?php echo $row['id_lista_compras']; ?>
              </td>
              <td>
                <?php echo $row['nombre_lista']; ?>
              </td>
              <td>
                <?php echo $row['descrip_lista_compras']; ?>
              </td>
              <td>
                <?php echo $row['idusuario']; ?>
              </td>
              <td class='d-flex '>
                <a href="./crud_operations/edit_shopping_list.php?id_lista_compras=<?php echo $row['id_lista_compras'] ?>" class="btn btn-secondary btn-sm">
                  <i class="fa-solid fa-pen-to-square fa-2xs"></i>
                </a>
                <a href="./crud_operations/delete_shopping_list.php?id_lista_compras=<?php echo $row['id_lista_compras'] ?>" class="btn btn-danger btn-sm">
                  <i class="fa-sharp fa-solid fa-trash fa-2xs"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>




<?php include('./partials/footer.php') ?>