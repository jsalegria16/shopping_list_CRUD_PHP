
<main class="container p-4 border border-secondary mt-2">

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
        <form action="./crud_operations/shoppinglist/save_shopping_list.php" method="POST">
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
      <h2>Listas de compras</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id Lista de compras</th>
            <th>Name </th>
            <th>Description</th>
            <th>Usuario</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $actual_id = $_SESSION['user_id'];
          // $query = "SELECT * FROM lista_compras WHERE idusuario = '$actual_id'";
          // $query = "SELECT id_lista_compras, nombre_lista, descrip_lista_compras, username FROM usuarios inner join lista_compras on lista_compras.idusuario = usuarios.id_usuario WHERE idusuario = '$actual_id'";
          $query = "SELECT id_lista_compras, nombre_lista, descrip_lista_compras, username FROM usuarios INNER JOIN lista_compras ON lista_compras.idusuario = usuarios.id_usuario WHERE idusuario = '$actual_id'";

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
                <?php echo $row['username']; ?>
              </td>
              <td class='d-flex '>
                <a href="./crud_operations/shoppinglist/edit_shopping_list.php?id_lista_compras=<?php echo $row['id_lista_compras'] ?>"
                  class="btn btn-secondary btn-sm">
                  <i class="fa-solid fa-pen-to-square fa-2xs"></i>
                </a>
                <a href="./crud_operations/shoppinglist/delete_shopping_list.php?id_lista_compras=<?php echo $row['id_lista_compras'] ?>"
                  class="btn btn-danger btn-sm">
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