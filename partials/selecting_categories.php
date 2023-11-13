<?php
session_start();
require '../database/database.php';
$shopping_list_slected = '';

if (isset($_GET['nombre_lista'])) {

    $shopping_list_slected = $_GET['nombre_lista'];
}

?>

<ul class="nav nav-pills">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">Seleccionar lista de compras</a>
        <div class="dropdown-menu">
            <?php
            $actual_id = $_SESSION['user_id'];
            // username , nombre_lista, descrip_lista_compras, nombre_producto, precio
            $query = "SELECT nombre_lista 
            FROM lista_compras
            WHERE idusuario = '$actual_id'";
            $result_tasks = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                <a class="dropdown-item"
                    href="/crud_app/views/products_by_shoppinglist.php?nombre_lista=<?php echo $row['nombre_lista']; ?>">
                    <?php echo $row['nombre_lista']; ?>
                </a>

            <?php } ?>

        </div>
    </li>
</ul>
