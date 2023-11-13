<?php
session_start();
require '../database/database.php';
?>


<?php
// unset($_SESSION['shopping_list_slected']);
// unset($_SESSION['id_shopping_list_slected']);

$shopping_list_slected = '';
if (isset($_GET['nombre_lista'])) {
    $shopping_list_slected = $_GET['nombre_lista'];
    $_SESSION['shopping_list_slected'] = $shopping_list_slected;
    $id_shopping_list_slected = $_GET['id_lista'];
    $_SESSION['id_shopping_list_slected'] = $id_shopping_list_slected;
}

?>

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


<main class="container-fluid  p-4 border border-secondary">

    <div class="row">
        <div class="col-md-3">
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
                <form action="../crud_operations/product/save_product.php " method="POST">
                    <div class="form-group">
                        <input type="text" name="nameSL" class="form-control" placeholder="Nombre Producto" autofocus>
                    </div>
                    <div class="form-group">
                        <input name="precio" rows="2" class="form-control" placeholder="Precio Producto"></input>
                    </div>
                    <input type="submit" name="save_SL" class="btn btn-success btn-block" value="Add product">
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <h2> Lista de compras
                <?php echo $shopping_list_slected ?>
            </h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id producto</th>
                        <th>Usuario</th>
                        <th>Nombre Lista </th>
                        <th>Description Lista</th>
                        <th>nombre_producto</th>
                        <th>precio Producto</th>
                        <th>Actions</th>
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
                                <?php echo $row['id_producto']; ?>
                            </td>
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
                            <td class='d-flex '>
                                <a href="../crud_operations/product/edit_product.php?id_pruducto=<?php echo $row['id_producto'] ?>"
                                    class="btn btn-secondary btn-sm">
                                    <i class="fa-solid fa-pen-to-square "></i>
                                </a>
                                <a href="../crud_operations/product/delete_product.php ?id_pruducto=<?php echo $row['id_producto'] ?>"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa-sharp fa-solid fa-trash "></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</main>

<?php include('../partials/footer.php') ?>