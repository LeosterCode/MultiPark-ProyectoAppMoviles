<?php
session_start();
require 'db_conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $cnnPDO->prepare("SELECT id, password FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario["password"])) {
        $_SESSION['usuario_id'] = $usuario['id'];  // Guarda el ID del usuario en la sesión
        header("Location: misesion.php");
        exit();
    } else {
        echo "Credenciales incorrectas.";
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Iniciar Sesión</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/foto-gratis/persona-sosteniendo-deliciosa-hamburguesa-ternera-queso-amarillo-tocino_181624-43508.jpg?ga=GA1.1.1437430337.1710444251&semt=ais_hybrid');
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
        video {
            height: 50%;
        }
        .navbar-nav .nav-link {
            color: rgb(80, 80, 82);
        }
        .navbar-nav .nav-link:hover {
            color: rgb(255, 255, 255);
        }
        .tabla {
            border: 10px solid white;
            border-collapse: collapse;
            width: 30%;
        }
        .tablaform2 {
            margin-top: 10px;
            width: 90%;
        }
        .php-text {
            font-size: 35px;
        }
        .tablaform2 th, .tablaform2 td {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .btn1 {
            width: 250px;
            height: 65px;
            font-size: 20px;
            margin-top: 130px;
            background-color: rgb(75, 75, 153);
            border: 5px solid rgb(235, 221, 221);
        }
        .tabla-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }
        .tabla-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            z-index: -1;
        }
        button {
            color: #fff;
            padding: 0.7em 1.7em;
            font-size: 18px;
            border-radius: 0.5em;
            background: #212121;
            cursor: pointer;
            border: 1px solid #212121;
            transition: all 0.3s;
            box-shadow: 6px 6px 12px #0a0a0a, -6px -6px 12px #2f2f2f;
        }
        button:active {
            color: #666;
            box-shadow: 0px 0px 0px #000, 0px 0px 0px #2f2f2f, inset 4px 4px 12px #1a1a1a, inset -4px -4px 12px #1f1f1f;
        }
        .navbar-toggler {
            border-color: white;
        }
        .navbar-toggler-icon {
            background-color: white;
            -webkit-mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .container-carrossel {
    perspective: 1500px;
}

.carrossel {
    position: relative;
    width: 250px;
    height: 250px;
    transform-style: preserve-3d;
    transform: rotateY(0deg);
    transition: transform 0.5s ease-out;
}

.carrossel-item {
    position: absolute;
    width: 250px;
    height: 250px;
    background: #222;
    border-radius: 10px;
    overflow: hidden;
}

.carrossel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.carrossel, .carrossel-item, .carrossel-item img {
    user-select: none; /* Evita la selección de texto e imágenes */
    pointer-events: none; /* Evita clics no deseados en imágenes */
}


.carrossel-item:nth-child(1) { transform: rotateY(0deg) translateZ(300px); }
.carrossel-item:nth-child(2) { transform: rotateY(51.43deg) translateZ(300px); }
.carrossel-item:nth-child(3) { transform: rotateY(102.86deg) translateZ(300px); }
.carrossel-item:nth-child(4) { transform: rotateY(154.29deg) translateZ(300px); }
.carrossel-item:nth-child(5) { transform: rotateY(205.72deg) translateZ(300px); }
.carrossel-item:nth-child(6) { transform: rotateY(257.15deg) translateZ(300px); }
.carrossel-item:nth-child(7) { transform: rotateY(308.58deg) translateZ(300px); }

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
                <li class="nav-item"><a class="nav-link" href="perfil4.php">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="menu2.php">Menú</a></li>
                <li class="nav-item"><a class="nav-link" href="carrito.php">🛒Carrito</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="tabla-background"></div>
<br>
<img src="images/logo.png" class="img-fluid" width="1070px" height="270px">
<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
<p>Hola, Bienvenido este parte es donde inicias sesión. <br> En la parte de arriba encontrarás cómo navegar por el sitio. <br> En el logo "BB" podrás regresar a esta página. 😁</p>

<video loop autoplay muted>
    <source src="images/video.mp4" type="video/mp4">
    Tu navegador no soporta la etiqueta de video.
</video>
<br><br><br><br><br>
<h2>Disfruta de nuestro Menú</h2>
<br><br>
<section style="display: flex; justify-content: center; align-items: center;">
    <div class="conteudo__geral">
        <div class="container">
            <div class="container-carrossel">
                <div class="carrossel">
                    <div class="carrossel-item"><img src="images/ML1.PNG" alt="Imagen 1"></div>
                    <div class="carrossel-item"><img src="images/doble.webp" alt="Imagen 2"></div>
                    <div class="carrossel-item"><img src="images/hotdog.avif" alt="Imagen 3"></div>
                    <div class="carrossel-item"><img src="images/postre.avif" alt="Imagen 4"></div>
                    <div class="carrossel-item"><img src="images/hawaiana.avif" alt="Imagen 5"></div>
                    <div class="carrossel-item"><img src="images/triplee.jpg" alt="Imagen 5"></div>
                    <div class="carrossel-item"><img src="images/nachos.avif" alt="Imagen 7"></div>
                </div>
            </div>
        </div>
    </div>
</section>

    
    <script>
        const carrossel = document.querySelector(".carrossel");
let isDragging = false;
let startX;
let currentRotation = 0;

document.addEventListener("mousedown", (e) => {
    isDragging = true;
    startX = e.clientX;
});

document.addEventListener("mouseup", () => {
    isDragging = false;
});

document.addEventListener("mousemove", (e) => {
    if (isDragging) {
        let deltaX = e.clientX - startX;
        currentRotation += deltaX * 0.1; // Ajusta la sensibilidad
        carrossel.style.transform = `rotateY(${currentRotation}deg)`;
        startX = e.clientX;
    }
});

const items = document.querySelectorAll(".carrossel-item");
const totalItems = items.length;
const angle = 360 / totalItems; // Calcula el ángulo automáticamente

items.forEach((item, index) => {
    const rotation = angle * index;
    item.style.transform = `rotateY(${rotation}deg) translateZ(300px)`;
});

document.addEventListener("dragstart", (e) => e.preventDefault()); // Evita arrastrar imágenes
document.addEventListener("mousedown", (e) => e.preventDefault()); // Evita selección accidental


    </script>
<br><br><br><br><br>
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

</body>
</html>
