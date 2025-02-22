<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: index1.html");
    exit();
}

// Conectar a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se subió una imagen
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $user_id = $_SESSION['user_id'];
    $nombreArchivo = basename($_FILES['foto']['name']);
    $rutaDestino = "uploads/" . $nombreArchivo;
    
    // Validar formato de imagen
    $extensionesValidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    
    if (in_array($extension, $extensionesValidas)) {
        // Mover la imagen a la carpeta uploads/
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            // Guardar en la base de datos
            $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $nombreArchivo, $user_id);
            $stmt->execute();
            $stmt->close();

            header("Location: perfil.php"); // Redirigir a perfil
            exit();
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Formato de archivo no permitido.";
    }
} else {
    echo "No se seleccionó ninguna imagen.";
}

$conn->close();
?>
