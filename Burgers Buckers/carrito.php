<?php
session_start();
require 'db_conexion.php'; // Asegura conexión a la base de datos

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    die("Debes iniciar sesión.");
}

$usuario_id = $_SESSION['usuario_id'];

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Inicializar el total
$total = 0;
if (isset($_POST['total'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $subtotal = $item['precio'] * $item['cantidad'];
        $total += $subtotal;
    }
}

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
}

// Consultar tarjetas del usuario
$sqlTarjetas = $cnnPDO->prepare("SELECT * FROM tarjetabb WHERE usuario_id = ?");
$sqlTarjetas->execute([$usuario_id]);
$tarjetas = $sqlTarjetas->fetchAll(PDO::FETCH_ASSOC);

// Procesar pago
if (isset($_POST['pagado'])) {
    if (!empty($_POST['tarjeta_seleccionada'])) {
        unset($_SESSION['carrito']); // Vaciar carrito tras el pago
        $_SESSION['mensaje'] = "success|Éxito|Tu pago ha sido procesado correctamente.";
        header("Location: carrito.php"); // Redirigir para que se muestre el mensaje
        exit();
    } else {
        $_SESSION['mensaje'] = "error|Error|Por favor selecciona una tarjeta para pagar.";
        header("Location: carrito.php"); // Redirigir para que se muestre el mensaje de error
        exit();
    }
}

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

    header("Location: carrito.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        

        

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .container {
                flex: 1; /* Esto asegura que el contenido ocupe todo el espacio disponible */
            }

            footer {
                background-color: rgb(33, 33, 34);
                padding: 20px;
            }

            footer .text-white {
                color: white;
            }

            footer a {
                color: white;
            }

            footer a:hover {
                text-decoration: underline;
            }


        .navbar-toggler {
            border-color: white; /* Cambia el color del borde del botón */
        }

        .navbar-toggler-icon {
            background-color: white; /* Color de las barras */
            -webkit-mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        body {
            background-image: url('https://img.freepik.com/foto-gratis/closeup-foto-hamburguesa-tocino-queso-taza-cafe-roja_181624-4345.jpg?ga=GA1.1.1240151379.1737325733&semt=ais_hybrid');
            background-repeat: no-repeat;
            background-position: center, center;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            color: white;
            text-align: center;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Aseguramos que el body ocupe toda la altura de la ventana */
        }

        .navbar-nav .nav-link {
            color: rgb(80, 80, 82); /* Color del texto de los enlaces */
        }

        .navbar-nav .nav-link:hover {
            color: rgb(255, 255, 255); /* Color del texto cuando pasas el mouse por encima */
        }
        /* Estilos básicos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color:rgb(6, 6, 6);
            color:white;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .tabla-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa toda la altura de la ventana */
            position: relative;
        }

        /* Fondo difuminado */
        .tabla-background {
            position: fixed;  /* Se mantiene fija en toda la página */
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;  /* Se ajusta al 100% de la altura de la ventana */
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            z-index: -1;
        }

        
    </style>
</head>
<body >
<nav class="navbar navbar-expand-lg" style="background-color:rgb(33, 33, 34);">
    <div class="container-fluid">
        <a class="navbar-brand" href="perfil4.php">
            <img src="images/ML1.png" width="150px" height="65px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="perfil4.php">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="misesion.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="menu2.php">Menu</a></li>
            </ul>
        </div>
    </div>
</nav>



<div class="container mt-5">
    <h1>Carrito de Compras</h1>
    <?php if (!empty($_SESSION['carrito'])): ?>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrito'] as $producto_id => $item): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($item['img']) ?>" width="80"></td>
                        <td><?= htmlspecialchars($item['nombre']) ?></td>
                        <td><?= htmlspecialchars($item['precio']) ?> MXN</td>
                        <td><?= htmlspecialchars($item['cantidad']) ?></td>
                        <td><?= number_format($item['precio'] * $item['cantidad'], 2) ?> MXN</td>
                        <td><a href="eliminar_carrito.php?producto_id=<?= $producto_id ?>" class="btn btn-danger">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form method="post">
            <button type="submit" name="total" class="btn btn-primary">Mostrar Total</button>
        </form>

        <?php if (isset($_POST['total'])): ?>
            <div class="modal" id="modalPago" style="display:block;">
                <div class="modal-content p-4">
                    <span class="close" onclick="document.getElementById('modalPago').style.display='none'">&times;</span>
                    <h3>Total a Pagar: <?= number_format($total, 2) ?> MXN</h3>

                    <?php if (!empty($tarjetas)): ?>
                        <form method="POST">
                            <label>Selecciona una tarjeta:</label>
                            <select name="tarjeta_seleccionada" class="form-control">
                                <?php foreach ($tarjetas as $tarjeta): ?>
                                    <option value="<?= $tarjeta['id'] ?>">**** **** **** <?= substr($tarjeta['numero_tarjeta'], -4) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    <?php else: ?>
                        <p>No tienes tarjetas registradas.</p>
                        <button class="btn btn-primary">Agregar Tarjeta</button>
                    <?php endif; ?>

                    <br>
                    <button class="btn btn-info"><a href="perfil4.php">Agregar Otra Tarjeta </a></button>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>Tu carrito está vacío.</p>
    <?php endif; ?>

    
</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if (isset($_SESSION['mensaje'])): ?>
            let mensaje = "<?= $_SESSION['mensaje'] ?>".split("|");
            let tipo = mensaje[0]; // "success" o "error"
            let titulo = mensaje[1];
            let texto = mensaje[2];

            Swal.fire({
                icon: tipo,
                title: titulo,
                text: texto,
                confirmButtonText: "Aceptar"
            });

            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>
    });
    </script>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<section style="min-height: 100vh; display: flex; flex-direction: column; justify-content: flex-end;">
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
</section> 




</body>
</html>
