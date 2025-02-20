<?php
session_start();
require 'db_conexion.php';

// Actualizar contraseña
if (isset($_POST['actualizar'])) {
    $currentPassword = trim($_POST['password']);
    $newPassword = trim($_POST['newpassword']); // Se cambió el nombre de la variable para mayor claridad

    // Verificar la contraseña actual usando el email del usuario
    $sql = "SELECT password FROM usuarios WHERE email = :email";
    $stmt = $cnnPDO->prepare($sql);
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe
    if ($user) {
        if ($currentPassword === $user['password']) { // Comparación directa sin password_verify()
            // La contraseña actual es correcta, actualizar la contraseña
            $updateSql = "UPDATE usuarios SET password = :new_password WHERE email = :email";
            $updateStmt = $cnnPDO->prepare($updateSql);
            $updateStmt->bindParam(':new_password', $newPassword, PDO::PARAM_STR); // Sin password_hash()
            $updateStmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
            $updateStmt->execute();

            $_SESSION['mensaje'] = "success|Contraseña actualizada|La contraseña se ha actualizado correctamente.";
        } else {
            $_SESSION['mensaje'] = "error|Contraseña incorrecta|La contraseña actual no es correcta.";
        }
    } else {
        $_SESSION['mensaje'] = "error|Usuario no encontrado|No se pudo verificar la contraseña actual.";
    }
}


$usuario_id = $_SESSION['usuario_id'];

// Agregar tarjeta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numero_tarjeta'])) {
    $numero_tarjeta = trim($_POST['numero_tarjeta']);
    $expiracion = trim($_POST['expiracion']);
    $cvv = trim($_POST['cvv']);
    $banco = trim($_POST['banco']);

    // Validar que los campos no estén vacíos
    if (empty($numero_tarjeta) || empty($expiracion) || empty($cvv) || empty($banco)) {
        $_SESSION['mensaje'] = "error|Error|Todos los campos son obligatorios.";
        header("Location: carrito.php");
        exit();
    }

    // Insertar la tarjeta en la base de datos
    $sqlInsert = $cnnPDO->prepare("INSERT INTO tarjetabb (usuario_id, numero_tarjeta, expiracion, cvv, banco) VALUES (?, ?, ?, ?, ?)");
    $resultado = $sqlInsert->execute([$usuario_id, $numero_tarjeta, $expiracion, $cvv, $banco]);

    if ($resultado) {
        $_SESSION['mensaje'] = "success|Éxito|Tarjeta agregada correctamente.";
    } else {
        $_SESSION['mensaje'] = "error|Error|No se pudo agregar la tarjeta.";
    }

    header("Location: perfil4.php");
    exit();
}

// Eliminar tarjeta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tarjeta_eliminar'])) {
    $tarjeta_id = $_POST['tarjeta_eliminar'];

    // Verificar si la tarjeta pertenece al usuario
    $sqlCheck = $cnnPDO->prepare("SELECT id FROM tarjetabb WHERE id = ? AND usuario_id = ?");
    $sqlCheck->execute([$tarjeta_id, $usuario_id]);

    if ($sqlCheck->rowCount() > 0) {
        // Si la tarjeta pertenece al usuario, proceder con la eliminación
        $sqlDelete = $cnnPDO->prepare("DELETE FROM tarjetabb WHERE id = ?");
        if ($sqlDelete->execute([$tarjeta_id])) {
            $_SESSION['mensaje'] = "success|Éxito|Tarjeta eliminada correctamente.";
        } else {
            $_SESSION['mensaje'] = "error|Error|No se pudo eliminar la tarjeta.";
        }
    } else {
        $_SESSION['mensaje'] = "error|Error|Tarjeta no encontrada o no pertenece al usuario.";
    }

    header("Location: perfil4.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Perfil del Usuario</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/foto-gratis/hamburguesa-queso-bollo-pan-aceitunas-parte-superior_114579-2955.jpg?ga=GA1.1.1240151379.1737325733&semt=ais_hybrid');
            background-repeat: no-repeat;
            background-position: center, center;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            color: white;
            text-align: center;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .tabla-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            padding: 20px;
        }
        .tabla-background {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            z-index: -1;
        }
        .tabla {
            background-color: black;
            color: white;
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            text-align: center;
            align-items: left;
        }
        .btn1 {
            width: 100%;
            font-size: 20px;
            background-color: rgb(75, 75, 153);
            border: 5px solid rgb(235, 221, 221);
        }
        .navbar-nav .nav-link {
            color: rgb(200, 200, 200);
        }
        .navbar-nav .nav-link:hover {
            color: white;
        }
        @media (max-width: 768px) {
            .tabla-container {
                height: auto;
            }
            .tabla {
                padding: 20px;
            }
        }

        .loader-container {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .burger-loader {
            width: 80px;
            height: 80px;
            animation: spin 2s infinite linear;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color:rgb(33, 33, 34);">
    <div class="container-fluid">
        <a class="navbar-brand" href="misesion.php">
            <img src="images/ML1.png" width="150px" height="65px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="carrito.php">🛒Carrito</a></li>
                <li class="nav-item"><a class="nav-link" href="menu2.php">Menú</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="loader-container" id="loader">
    <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" class="burger-loader" alt="Cargando...">
</div>

<div class="tabla-container">
    <div class="tabla-background"></div>
    <div class="container mt-5">
    <div class="row">
        <!-- Columna de Configuración de Perfil -->
        <div class="col-md-6">
            <div class="tabla">
                <h1>Configuración de Perfil</h1>
                <p style="font-size:20px;">Nombre registrado: <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong></p>
                <p style="font-size:20px;">Email: <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong></p>

                <h2>Cambiar Contraseña</h2>
                <form id="formActualizar" method="post" action="">
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña Actual:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="newpassword" class="form-label">Nueva Contraseña:</label>
                        <input type="password" name="newpassword" class="form-control" required>
                    </div>
                    <button id="btnActualizar" class="btn btn-success w-100" type="submit" name="actualizar">Actualizar Contraseña</button>
                </form>

                <br>
                <a href="cerrar_sesion.php" class="btn btn-danger w-100">Cerrar sesión</a>
            </div>
        </div>

        <!-- Columna de Tarjetas (Agrupa Agregar y Eliminar) -->
        <div class="col-md-6">
            <div class="row">
                <!-- Agregar Tarjeta -->
                <div class="col-md-12">
                    <div class="tabla">
                        <h2>Agregar Tarjeta</h2>
                        <form id="formAgregarTarjeta" method="POST">
                            <label>Número de Tarjeta:</label>
                            <input type="text" name="numero_tarjeta" class="form-control" required pattern="\d{16}" maxlength="16" placeholder="1234567812345678">
                            <label>Fecha de Expiración:</label>
                            <input type="date" name="expiracion" class="form-control" required>
                            <label>CVV:</label>
                            <input type="text" name="cvv" class="form-control" required pattern="\d{3}" maxlength="3" placeholder="123">
                            <label>Banco:</label>
                            <select name="banco" class="form-control" required>
                                <option value="Banco Azteca">Banco Azteca</option>
                                <option value="Banorte">Banorte</option>
                                <option value="Bancomer">Bancomer</option>
                                <option value="CityBanamex">CityBanamex</option>
                                <option value="HSBC">HSBC</option>
                            </select>
                            <br>
                            <button id="btnAgregarTarjeta" type="submit" class="btn btn-success">Agregar Tarjeta</button>
                        </form>

                    </div>
                </div>

                <!-- Eliminar Tarjeta -->
                <div class="col-md-12 mt-4">
                    <div class="tabla">
                        <h2>Eliminar Tarjeta</h2>
                        <form id="formEliminarTarjeta" method="POST">
                            <label>Selecciona una tarjeta:</label>
                            <select name="tarjeta_eliminar" class="form-control" required>
                                <?php
                                $sqlTarjetas = $cnnPDO->prepare("SELECT id, numero_tarjeta FROM tarjetabb WHERE usuario_id = ?");
                                $sqlTarjetas->execute([$usuario_id]);
                                $tarjetas = $sqlTarjetas->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($tarjetas as $tarjeta) {
                                    echo '<option value="' . $tarjeta['id'] . '">**** **** **** ' . substr($tarjeta['numero_tarjeta'], -4) . '</option>';
                                }
                                ?>
                            </select>
                            <br>
                            <button id="btnEliminarTarjeta" type="submit" class="btn btn-danger">Eliminar Tarjeta</button>
                        </form>

                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
</div>
</div>


<?php
// Mostrar mensajes de sesión con SweetAlert
if (isset($_SESSION['mensaje'])) {
    $mensaje = explode("|", $_SESSION['mensaje']);
    echo "<script>
        Swal.fire({
            icon: '$mensaje[0]',
            title: '$mensaje[1]',
            text: '$mensaje[2]'
        });
    </script>";
    unset($_SESSION['mensaje']);
}
?>
<br><br>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<footer class="text-center text-white" style="background-color: rgb(33, 33, 34); padding: 20px;">
    <p>&copy; 2025 Burgers Buckers. Todos los derechos reservados.</p>
    <br>
    <a class="navbar-brand" href="polpriv.html">POLITICA DE PRIVACIDAD</a>
    <br>
    <br><br>
    <!-- From Uiverse.io by david-mohseni --> 
    <ul class="wrapper">
  <label class="icon facebook">
    <a class="navbar-brand" href="https://www.facebook.com/profile.php?id=100022291620191" target="_blank">
      <span class="tooltip">Facebook</span>
      <svg
        viewBox="0 0 320 512"
        height="1.2em"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
        ></path>
      </svg>
    </a>
  </label>
  <label class="icon instagram">
    <a class="navbar-brand" href="https://www.instagram.com/animecrex/" target="_blank">
      <span class="tooltip">Instagram</span>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        height="1.2em"
        fill="currentColor"
        class="bi bi-instagram"
        viewBox="0 0 16 16"
      >
        <path
          d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"
        ></path>
      </svg>
    </a>
  </label>
</ul>


</footer>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function activarLoader(formulario, boton) {
            formulario.addEventListener("submit", function (event) {
                event.preventDefault(); // Evita el envío inmediato
                document.getElementById("loader").style.display = "flex"; // Muestra el loader
                boton.disabled = true; // Deshabilita el botón para evitar doble envío
                
                // Simulación de tiempo de procesamiento antes de enviar el formulario
                setTimeout(() => {
                    this.submit(); // Envía el formulario después del efecto de carga
                }, 2000);
            });
        }

        // Obtener los formularios y los botones
        const formActualizar = document.getElementById("formActualizar");
        const btnActualizar = document.getElementById("btnActualizar");

        const formAgregarTarjeta = document.getElementById("formAgregarTarjeta");
        const btnAgregarTarjeta = document.getElementById("btnAgregarTarjeta");

        const formEliminarTarjeta = document.getElementById("formEliminarTarjeta");
        const btnEliminarTarjeta = document.getElementById("btnEliminarTarjeta");

        // Activar el loader en cada formulario
        if (formActualizar && btnActualizar) {
            activarLoader(formActualizar, btnActualizar);
        }
        if (formAgregarTarjeta && btnAgregarTarjeta) {
            activarLoader(formAgregarTarjeta, btnAgregarTarjeta);
        }
        if (formEliminarTarjeta && btnEliminarTarjeta) {
            activarLoader(formEliminarTarjeta, btnEliminarTarjeta);
        }
    });
</script>

</body>
</html>
