<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'quinto'; // Cambia por tu BD
$username = 'root';
$password = '';

try {
    $cnnPDO = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $cnnPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Procesar acciones CRUD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action === "registrar" || $action === "actualizar") {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $img = $_POST['imagen_actual'] ?? '';

        // Manejo de imagen
        if (!empty($_FILES['img']['name'])) {
            $directorio = 'uploads/';
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }

            $img = $directorio . time() . '_' . basename($_FILES['img']['name']);
            move_uploaded_file($_FILES['img']['tmp_name'], $img);
        }

        if ($action === "registrar") {
            $sql = "INSERT INTO menu (nombre, precio, descripcion, img) VALUES (?, ?, ?, ?)";
            $stmt = $cnnPDO->prepare($sql);
            $stmt->execute([$nombre, $precio, $descripcion, $img]);
            echo json_encode(['success' => 'Producto agregado']);
        } else {
            $sql = "UPDATE menu SET nombre=?, precio=?, descripcion=?, img=? WHERE id=?";
            $stmt = $cnnPDO->prepare($sql);
            $stmt->execute([$nombre, $precio, $descripcion, $img, $id]);
            echo json_encode(['success' => 'Producto actualizado']);
        }
        exit;
    }

    if ($action === "eliminar") {
        $id = $_POST['id'];
        $stmt = $cnnPDO->prepare("DELETE FROM menu WHERE id=?");
        $stmt->execute([$id]);
        echo json_encode(['success' => 'Producto eliminado']);
        exit;
    }
}

// Obtener productos desde la base de datos
$stmt = $cnnPDO->prepare("SELECT * FROM menu");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>CRUD en un solo archivo</title>
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
            position: fixed;  /* Se mantiene fija en toda la página */
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;  /* Se ajusta al 100% de la altura de la ventana */
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
        /* General */
        


        .navbar-nav .nav-link {
            color: rgb(80, 80, 82);
        }

        .navbar-nav .nav-link:hover {
            color: rgb(255, 255, 255);
        }

        .navbar-toggler {
            border-color: white; /* Cambia el color del borde del botón */
        }

        .navbar-toggler-icon {
            background-color: white; /* Color de las barras */
            -webkit-mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .card {
            margin-bottom: 20px;
            background-color: black;
            color: white;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }

        
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color:rgb(33, 33, 34);">
    <div class="container-fluid">
        <a class="navbar-brand" href="misesion.php">
            <img src="images/ML1.png" width="150px" height="65px">
        </a>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto">
            </ul>
        </div>
    </div>
</nav>

<div class="tabla-container">
    <div class="tabla-background"></div>
    <div class="tabla">
        <br><br><br>
        <h1>Configuración de productos</h1>
        <form id="productoForm">
            <input type="hidden" name="id" id="producto_id">
            <input type="hidden" name="imagen_actual" id="imagen_actual">
            <div class="mb-3">
                <br>
                <label>Nombre:</label><br>
                <input type="text" name="nombre" id="nombre"   style="widht: 90px;" required>
            </div>
            <div class="mb-3">
                <label>Precio:</label><br>
                <input type="text" name="precio" id="precio"  required>
            </div>
            <div class="mb-3">
                <label>Descripción:</label><br>
                <textarea name="descripcion" id="descripcion"  required></textarea>
            </div>
            <div class="mb-3">
                <label>Imagen:</label><br>
                <input type="file" name="img" id="img"  >
            </div>
            <br>
            <button type="submit" class="btn btn-success">Guardar Producto</button>
        </form><br>
        <button class="btn btn-danger">
            <a href="cerrar_sesion.php" style="color: white; text-decoration: none;">Cerrar sesión</a>
        </button>
    </div>
    </div>
        <hr>
        <h3>Lista de Productos</h3>
        <div class="row" id="productosLista">
            <?php foreach ($productos as $producto) : ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="<?= !empty($producto['img']) ? htmlspecialchars($producto['img']) : 'https://via.placeholder.com/150' ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars_decode($producto['nombre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars_decode($producto['descripcion']) ?></p>
                            <p class="card-text"><strong>Precio:</strong> $<?= number_format($producto['precio'], 2) ?></p>
                            <button class="btn btn-warning btn-sm editarProducto" 
                                    data-id="<?= $producto['id'] ?>" 
                                    data-nombre="<?= $producto['nombre'] ?>" 
                                    data-precio="<?= $producto['precio'] ?>" 
                                    data-descripcion="<?= $producto['descripcion'] ?>" 
                                    data-img="<?= $producto['img'] ?>">Editar</button>
                            <button class="btn btn-danger btn-sm eliminarProducto" data-id="<?= $producto['id'] ?>">Eliminar</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
            </div>
    <script>
        $(document).ready(function () {
            $('#productoForm').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                formData.append('action', $('#producto_id').val() ? 'actualizar' : 'registrar');

                $.ajax({
                    url: '',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire(response.success ? 'Éxito' : 'Error', response.success || response.error, response.success ? 'success' : 'error')
                        .then(() => location.reload());
                    }
                });
            });

            $('.eliminarProducto').click(function () {
                let id = $(this).data('id');
                Swal.fire({
                    title: '¿Eliminar producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('', { action: 'eliminar', id: id }, function (response) {
                            Swal.fire(response.success ? 'Eliminado' : 'Error', response.success || response.error, response.success ? 'success' : 'error')
                            .then(() => location.reload());
                        }, 'json');
                    }
                });
            });

            $('.editarProducto').click(function () {
                $('#producto_id').val($(this).data('id'));
                $('#nombre').val($(this).data('nombre'));
                $('#precio').val($(this).data('precio'));
                $('#descripcion').val($(this).data('descripcion'));
                $('#imagen_actual').val($(this).data('img'));
            });
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<section style="min-height: 100vh; display: flex; flex-direction: column; justify-content: flex-end;">
    <footer class="text-center text-white" style="background-color: rgb(33, 33, 34); padding: 20px;">
        <p>&copy; 2025 Burgers Buckers. Todos los derechos reservados.</p>
        <br>
        <a href="#">POLITICA DE PRIVACIDAD</a>
        <br>
        <br><br>
        <div>
            <a href="https://facebook.com" target="_blank" class="text-white me-3">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://instagram.com" target="_blank" class="text-white me-3">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://twitter.com" target="_blank" class="text-white">
                <i class="fab fa-twitter"></i>
            </a>
        </div>
    </footer>
</section> 
</body>
</html>
