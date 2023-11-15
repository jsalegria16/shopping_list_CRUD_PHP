<?php
require '../../database/database.php';
session_start();

$id_shopping_list = '';
$nombre = '';
$precio = '';

if (isset($_GET['id_pruducto'])) {

  $id_product = $_GET['id_pruducto'];
  $_SESSION['id_product'] = $id_product;
  $query = "SELECT * FROM productos WHERE id_producto=$id_product";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre = $row['nombre_producto'];
    $precio = $row['precio'];
  }
}

if (isset($_POST['update'])) {


  // Verificar campos vacíos
  if (empty($_POST['name']) || empty($_POST['precio'])) {
    $_SESSION['message'] = 'Both fields are required';
    $_SESSION['message_type'] = 'warning';
  } else {

    $nombreSL = $_POST['name'];
    $precio = $_POST['precio'];
    $id_to_update = $_SESSION['id_product'];

    if (is_numeric($precio)) {

      $query = "UPDATE productos SET nombre_producto = '$nombreSL', precio = '$precio' WHERE id_producto ='$id_to_update'";
      $result = mysqli_query($conn, $query);

      if (!$result) {
        die("Query Failed.");
      }

      $_SESSION['message'] = 'Producto actualizado exitosamente en  <strong>' . $_SESSION['shopping_list_slected'].' </strong>';
      $_SESSION['message_type'] = 'success';
      header('Location: /crud_app/views/products_by_shoppinglist.php');

    } else {
      $_SESSION['message'] = 'Necesitas un valor numérico';
      $_SESSION['message_type'] = 'success';
      unset($_SESSION['shopping_list_slected']);
      unset($_SESSION['id_shopping_list_slected']);
      header('Location: /crud_app/views/products_by_shoppinglist.php');
    }


    // $query = "UPDATE productos SET nombre_producto = '$nombreSL', precio = '$precio' WHERE id_producto ='$id_to_update'";
    // $result = mysqli_query($conn, $query);

    // if (!$result) {
    //   die("Query Failed.");
    // }

    // $_SESSION['message'] = 'Product  updated Successfully';
    // $_SESSION['message_type'] = 'success';
    // header('Location: /crud_app/views/products_by_shoppinglist.php');

  }

}
?>
<?php include('../../partials/header.php'); ?>
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
        <!-- <form action="edit_product.php?id=<?php //echo $_GET['id_lista_compras']; ?>" method="POST" novalidate> -->
        <form action="edit_product.php" method="POST" novalidate>
          <div class="form-group">
            <input name="name" type="text" class="form-control" value="<?php echo $nombre; ?>"
              placeholder="Update product">
          </div>
          <div class="form-group">
            <textarea name="precio" class="form-control" cols="30" rows="10"><?php echo $precio; ?></textarea>
          </div>
          <button class="btn-success" name="update">
            Update
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('../../partials/footer.php'); ?>