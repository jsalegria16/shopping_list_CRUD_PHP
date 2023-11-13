

<?php include('../partials/header.php') ?>

<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="../index.php">Listas De compras</a>
    <a class="navbar-brand" href="products_by_shoppinglist.php">Products by shopping list</a>

    <?php
    if (!empty($user)): ?>
      <p class="navbar-brand align-middle">
        Welcome
        <?= $user['username']; ?>
      </p>
    <?php endif;
    ?>

    <a href="../signup-login/logout.php" class="navbar-brand border border-light p-2">
      Logout
    </a>

  </div>
</nav>

<?php include('../partials/selecting_categories.php') ?>

<div class="col-md-8">
    <h2>Listas de compras</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre Lista </th>
                <th>Description Lista</th>
                <th>nombre_producto</th>
                <th>precio Producto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $actual_id = $_SESSION['user_id'];
            // username , nombre_lista, descrip_lista_compras, nombre_producto, precio
            $query = "SELECT * 
            FROM usuarios
            INNER JOIN lista_compras ON lista_compras.idusuario = usuarios.id_usuario 
            JOIN productos on productos.id_listacompras = lista_compras.id_lista_compras
            WHERE idusuario = '$actual_id' and nombre_lista = '$shopping_list_slected' ";

            $result_tasks = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                <tr>
                    <td>
                        <?php echo $row['username']; ?>
                    </td>
                    <td>
                        <?php echo $row['nombre_lista']; ?>
                    </td>
                    <td>
                        <?php echo $row['descrip_lista_compras']; ?>
                    </td>
                    <td>
                        <?php echo $row['nombre_producto']; ?>
                    </td>
                    <td>
                        <?php echo $row['precio']; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include('../partials/footer.php') ?>