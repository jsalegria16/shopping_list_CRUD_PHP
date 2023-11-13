<?php
require '../database/database.php';
session_start();

$id = '';
$title = '';
$description = '';

if (isset($_GET['id_lista_compras'])) {

  $id = $_GET['id_lista_compras'];
  $_SESSION['id_lista_compras'] = $id;
  $query = "SELECT * FROM lista_compras WHERE id_lista_compras=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $title = $row['nombre_lista'];
    $description = $row['descrip_lista_compras'];
  }
}

if (isset($_POST['update'])) {


  // Verificar campos vacíos
  if (empty($_POST['title']) || empty($_POST['description'])) {
    $message = 'Both username and password are required';
    $_SESSION['message'] = 'Both fields are required';
    $_SESSION['message_type'] = 'warning';
  } else {
    $nombreSL = $_POST['title'];
    $DescriSL = $_POST['description'];
    $id_lista_compras = $_SESSION['id_lista_compras'];
    // echo $nombreSL;
    // echo $DescriSL;
    echo $id_lista_compras . '<br>';
    $query = "UPDATE lista_compras SET nombre_lista = '$nombreSL', descrip_lista_compras = '$DescriSL' WHERE id_lista_compras ='$id_lista_compras'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die("Query Failed.");
    }

    $_SESSION['message'] = 'Shopping List updated Successfully';
    $_SESSION['message_type'] = 'success';
    header('Location: /crud_app/home.php');

  }

}
?>
<?php include('../partials/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <!-- Mensajes de alerta  -->
      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
          <?= $_SESSION['message'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
      } ?>

      <div class="card card-body">
        <!-- <form action="edit_shopping_list.php?id=<?php //echo $_GET['id_lista_compras']; ?>" method="POST" novalidate> -->
        <form action="edit_shopping_list.php" method="POST" novalidate>
          <div class="form-group">
            <input name="title" type="text" class="form-control" value="<?php echo $title; ?>"
              placeholder="Update Shopping List">
          </div>
          <div class="form-group">
            <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description; ?></textarea>
          </div>
          <button class="btn-success" name="update">
            Update
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('../partials/footer.php'); ?>