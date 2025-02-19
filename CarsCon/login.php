<?php
session_start();
require_once 'conexion.php';

// Manejo del registro
if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena_registro'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (:nombre, :correo, :contrasena)";
    $stmt = $cnnPDO->prepare($sql);

    try {
        $stmt->execute(['nombre' => $nombre, 'correo' => $correo, 'contrasena' => $contrasena]);
        $_SESSION['mensaje'] = "Registro exitoso. Por favor, inicia sesión.";
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error al registrar: " . $e->getMessage();
        header("Location: login.php");
        exit();
    }
}

// Manejo del inicio de sesión
if (isset($_POST['inicio_sesion'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE nombre = :usuario OR correo = :usuario";
    $stmt = $cnnPDO->prepare($sql);
    $stmt->execute(['usuario' => $usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($contrasena, $user['contrasena'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nombre'] = $user['nombre'];
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Correo/Nombre o contraseña incorrectos.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="login-styles.css">
    <style>
        .mensaje-error, .mensaje-exito {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
            border-radius: 5px;
        }
        .mensaje-error {
            background-color: #ffebee;
            color: #c62828;
        }
        .mensaje-exito {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
    </style>
</head>
<body>
<h2>¡Bienvenido a CarsCon!</h2>
<div class="container" id="container">
    <!-- Formulario de registro -->
    <div class="form-container sign-up-container">
        <form method="POST" action="">
            <h1>Crear cuenta</h1>
            <span>o usa tu email para registrarte</span><br>
            <input type="text" name="nombre" placeholder="Nombre" required />
            <input type="email" name="correo" placeholder="Email" required />
            <input type="password" name="contrasena_registro" placeholder="Contraseña" required />
            <button type="submit" name="registro">Registrar</button>
        </form>
    </div>

    <!-- Formulario de inicio de sesión -->
    <div class="form-container sign-in-container">
        <form method="POST" action="">
            <h1>Inicia sesión</h1>
            <span>o usa tu cuenta</span><br>
            <input type="text" name="usuario" placeholder="Email o Nombre" required />
            <input type="password" name="contrasena" placeholder="Contraseña" required />
            <button type="submit" name="inicio_sesion">Iniciar sesión</button>
        </form>
    </div>

    <!-- Paneles de overlay -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Bienvenido!</h1>
                <p>Para empezar a navegar con nosotros, por favor inicia sesión con tu información personal</p>
                <button class="ghost" id="signIn">Iniciar sesión</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hola, amigo!</h1>
                <p>Regístrate si aún no tienes cuenta y sé parte de nuestra familia</p>
                <button class="ghost" id="signUp">Registrarse</button>
            </div>
        </div>
    </div>
</div>

<!-- Mostrar mensajes de error o éxito -->
<?php if (isset($_SESSION['error'])): ?>
    <div class="mensaje-error">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="mensaje-exito">
        <?= $_SESSION['mensaje']; ?>
        <?php unset($_SESSION['mensaje']); ?>
    </div>
<?php endif; ?>

<script src="myjs.js"></script>

<footer>
    <p>
        © José Alfredo Cortés Villarreal. Todos los Derechos Reservados
    </p>
</footer>
</body>
</html>