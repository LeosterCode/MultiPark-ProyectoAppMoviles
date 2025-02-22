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

// Obtener datos del usuario
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email,foto FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();

// Si el usuario no tiene una foto, usar una imagen por defecto
$foto_perfil = !empty($user['foto']) ? $user['foto'] : "default.png";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - ChickLook</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <header>
        <div class="logo">CHICKLOOK</div>
        <nav>
            <ul>
                <li><a href="pagina1.html">Inicio</a></li>
                <li class="dropdown">
                        <a href="#" id="productos-btn">Productos</a>
                        <ul class="dropdown-menu">
                            <li><a href="niños.html">Niños</a></li>
                            <li><a href="mujeres.html">Mujeres</a></li>
                            <li><a href="bebes.html">Bebés</a></li>
                            <li><a href="hombres.html">Hombres</a></li>
                        </ul>
                    </li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main class="profile-container">
        <h2>Perfil de Usuario</h2>
        <div class="profile-card">
            <img src="uploads/<?php echo $foto_perfil; ?>" alt="Foto de perfil" class="profile-img">
            <div class="profile-info">
                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>

            <!-- Formulario para subir imagen -->
            <form action="subir_foto.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="foto" accept="image/*" required>
                <button type="submit">Actualizar Foto</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 ChickLook - Todos los derechos reservados.</p>
    </footer>
</body>
</html>
