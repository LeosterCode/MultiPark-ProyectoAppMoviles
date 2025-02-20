<?php
session_start();
require 'conexion.php'; // Archivo de conexión a la base de datos

// Verifica si el carrito existe en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    // Consulta del producto en la base de datos
    $sql = "SELECT * FROM productos WHERE id = :id";
    $stmt = $cnnPDO->prepare($sql);
    $stmt->bindParam(':id', $producto_id, PDO::PARAM_INT);
    $stmt->execute();
    $producto = $stmt->fetch();

    if ($producto) {
        // Añadir el producto al carrito
        $_SESSION['carrito'][] = $producto;
    }
}

header('Location: carrito.php');
exit;
?>
