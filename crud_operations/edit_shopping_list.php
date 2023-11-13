<?php


// if (isset($_POST['edit_SL'])) {

//     // Verificar campos vacíos
//     if (empty($_POST['nameSL']) || empty($_POST['descriptionSL'])) {
//         $message = 'Both username and password are required';
//         $_SESSION['message1'] = 'Both fields are required';
//         $_SESSION['message_type1'] = 'warning';
//     } else {
//         $nombreSL = $_POST['nameSL'];
//         $DescriSL = $_POST['descriptionSL'];
//         $id_lista_compras = $_GET['id_lista_compras'];
//         $query = "UPDATE lista_compras set nombre_lista = '$nombreSL', descrip_lista_compras='$DescriSL'  WHERE id_lista_compras = '$id_lista_compras'";
//         $result = mysqli_query($conn, $query);

//         if (!$result) {
//             die("Query Failed.");
//         }

//         $_SESSION['message1'] = 'Shopping List updated Successfully';
//         $_SESSION['message_type1'] = 'success';
//         header('Location: /crud_app/home.php');

//     }

// }



// if (isset($_GET['id_lista_compras'])) {

//     // $id_lista_compras = $_GET['id_lista_compras'];
//     // $query = "SELECT * FROM lista_compras  WHERE id=$id_lista_compras ";
//     // $result_tasks = mysqli_query($conn, $query);
//     // if (mysqli_num_rows($result) == 1) {
//     //     $row = mysqli_fetch_array($result);
//     //     $nombre_lista = $row['nombre_lista'];
//     //     $descrip_lista_compras = $row['descrip_lista_compras'];
//     //     $idusuario = $row['idusuario'];
//     // }




// }

?>

<<?php
include("../database/database.php");
$title = '';
$description = '';

if (isset($_GET['id_lista_compras'])) {
  $id = $_GET['id_lista_compras'];
  $query = "SELECT * FROM lista_compras WHERE id_lista_compras=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $title = $row['nombre_lista'];
    $description = $row['descrip_lista_compras'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id_lista_compras'];
  $title = $_POST['title'];
  $description = $_POST['description'];

  $query = "UPDATE task set nombre_lista = '$title', descrip_lista_compras = '$description' WHERE id_lista_compras=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('../partials/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit_shopping_list.php?id=<?php echo $_GET['id_lista_compras']; ?>" method="POST">
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