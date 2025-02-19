<?php
session_start();

// Verificar si se ha recibido un ID de producto en la URL
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Verificar si el carrito no está vacío
    if (!empty($_SESSION['carrito'])) {
        // Buscar el índice del producto en el carrito
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if ($producto['id'] == $id_producto) {
                // Eliminar el producto del carrito
                unset($_SESSION['carrito'][$key]);
                // Reindexar el array para evitar huecos
                $_SESSION['carrito'] = array_values($_SESSION['carrito']);
                break;
            }
        }
    }
}

// Redirigir de vuelta al carrito después de eliminar el producto
header("Location: carrito.php");
exit;
?>
