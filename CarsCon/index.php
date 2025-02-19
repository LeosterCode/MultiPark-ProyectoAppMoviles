<?php
require_once "conexion.php";
require_once "enviar_correo.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="index-styles.css">
    <link rel="stylesheet" href="product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
    <div class="divlogo">
        <img src="images/logocar.png" alt="logocar" width="60px">
    </div>
        <a class="navbar-brand" href="#nosotros">Nosotros</a>
        <a class="navbar-brand" href="#usados">Usados</a>
        <a class="navbar-brand" href="#nuevos">Nuevos</a>
        <a class="navbar-brand" href="#taller">Taller</a>
        <a class="navbar-brand" href="#contacto">Contáctanos</a>
        
        <form class="d-flex" role="search" action="buscar.php" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-danger" type="submit">Search</button>
        </form>

        <div>
            <button class="btn btn-success">
                <a href="carrito.php" style="color: white;">Carrito</a>
            </button>
            <button class="btn btn-danger">
                <a href="logout.php" style="color: white;">Cerrar Sesión</a>
            </button>
        </div>
        </div>
    </div>
    </nav>
</header>

<body>
<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="https://guiaauto.com.br/wp-content/uploads/2022/09/byd-song-plus-hibrido-3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <!-- <h5>First slide label</h5> -->
        </div>
        </div>
        <div class="carousel-item">
        <img src="https://cdn.motor1.com/images/mgl/XBBZZl/s1/chevrolet-blazer-ev-2024.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <!-- <h5>Second slide label</h5> -->
        </div>
        </div>
        <div class="carousel-item">
        <img src="https://cdn.motor1.com/images/mgl/g44YO7/s1/byd-song-plus.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <!-- <h5>Third slide label</h5> -->
        </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>
    <div class="body2">
        <div class="lateral left"></div>
            <div class="contenido">
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                    <h1 id="nosotros">NOSOTROS</h1>
                </div>
                <section class="">
                    <h4>¡Bienvenido a CarsCon, tu mejor experiencia de compra de vehículos! <br><br>

                        Aquí encontrarás el auto que se adapta a tu estilo de vida y necesidades. 
                        Desde compactos eficientes hasta potentes SUV, ofrecemos una amplia variedad de modelos de las mejores marcas del mercado. 
                        Nuestro compromiso es brindarte un proceso de compra sencillo, transparente y seguro. <br><br>

                        Explora nuestro catálogo, personaliza tu elección y aprovecha nuestras ofertas exclusivas. 
                        Ya sea que busques tu primer auto o quieras renovar tu experiencia al volante, estamos aquí para acompañarte en cada paso del camino.
                        <br><br>
                        ¡Tu próximo viaje comienza aquí!</h4>
                        <br>
                        <center>
                            <video width="600" autoplay loop muted controls>
                                <source src="images/video.mp4" type="video/mp4"></source>
                                Tu navegador no puede repoducir el video
                            </video>
                        </center>
                </section>
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                    <h1 id="usados">VEHÍCULOS USADOS</h1>
                </div>
                <section class="productos">
                <?php
                // Consulta para obtener productos
                $sql = "SELECT * FROM productos";
                $stmt = $cnnPDO->prepare($sql);
                $stmt->execute();
                $productos = $stmt->fetchAll();

                foreach ($productos as $producto) {
                    echo '
                    <div class="card">
                        <img src="' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '">
                        <div class="card-content">
                            <h3>' . $producto['nombre'] . '</h3>
                            <p>' . $producto['descripcion'] . '</p>
                            <p><strong>Precio: $' . $producto['precio'] . '</strong></p>
                            <form action="agregar_carrito.php" method="POST">
                                <input type="hidden" name="producto_id" value="' . $producto['id'] . '">
                                <button type="submit">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>';
                }
                ?>
                </section>
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                    <h1 id="nuevos">VEHÍCULOS NUEVOS</h1>
                </div>
                <section class="productos">
                <?php
                // Consulta para obtener productos
                $sql = "SELECT * FROM productos";
                $stmt = $cnnPDO->prepare($sql);
                $stmt->execute();
                $productos = $stmt->fetchAll();

                foreach ($productos as $producto) {
                    echo '
                    <div class="card">
                        <img src="' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '">
                        <div class="card-content">
                            <h3>' . $producto['nombre'] . '</h3>
                            <p>' . $producto['descripcion'] . '</p>
                            <p><strong>Precio: $' . $producto['precio'] . '</strong></p>
                            <form action="agregar_carrito.php" method="POST">
                                <input type="hidden" name="producto_id" value="' . $producto['id'] . '">
                                <button type="submit">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>';
                }
                ?>
                </section>
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                    <h1 id="taller">TALLER</h1>
                </div>
                <section class="">
                <div class="container my-5">
                    <div class="row align-items-center">
                        <!-- Lado Izquierdo: Imagen -->
                        <div class="col-md-6">
                        <img src="https://th.bing.com/th/id/OIP.-XwZaHXONVfgSTJLohtIfAHaEK?rs=1&pid=ImgDetMain" alt="Imagen" class="img-fluid rounded">
                        </div>

                        <!-- Lado Derecho: Texto y Botón -->
                        <div class="col-md-6 d-flex flex-column align-items-center">
                            <h2 class="mb-3 text-center">¡Tu auto merece el mejor cuidado!</h2>
                            <p class="text-center fs-6">Visita nuestro taller mecánico y disfruta de un servicio confiable, profesional y personalizado. <br><br>
                                Contamos con técnicos especializados que se asegurarán de mantener tu vehículo en óptimas condiciones. <br><br>
                                Desde mantenimiento preventivo hasta reparaciones complejas, estamos listos para atenderte.</p>
                            <button class="btn btn-warning">
                                <a href="taller.php">¡Haz clic aquí!</a>
                            </button>
                        </div>
                    </div>
                </div>
                </section>
                <section>
                    <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                        <h1 id="contacto">CONTÁCTANOS</h1>
                    </div>
                    <div>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="nombre@ejemplo.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Comentarios</label>
                                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button class="btn btn-danger" name="contacto" type="sumbit">Enviar</button>
                            </div>
                        </form>
                </section>

            </div>
        <div class="lateral right"></div>
    </div>

    <br><br><br>
    <footer class="footer bg-danger">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 mt-4 col-lg-3 text-center text-sm-start">
                <div class="information">
                    <h6 class="footer-heading text-uppercase text-white fw-bold">Clientes CarsCon</h6>
                    <ul class="list-unstyled footer-link mt-4">
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none fw-semibold">Priority</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none fw-semibold">Jóvenes</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none fw-semibold">Patrimonial</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-4 col-lg-3 text-center text-sm-start">
                <div class="resources">
                    <h6 class="footer-heading text-uppercase text-white fw-bold">La empresa</h6>
                    <ul class="list-unstyled footer-link mt-4">
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none fw-semibold">Términos y condiciones</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none fw-semibold">Análisis Financiera</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none fw-semibold">Servicios</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none fw-semibold">RSS</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-4 col-lg-2 text-center text-sm-start">
              <div class="social">
                  <h6 class="footer-heading text-uppercase text-white fw-bold">Social</h6>
                  <ul class="list-inline my-4">
                    <li class="list-inline-item"><a href="#" class="text-white btn-sm btn btn-primary mb-2"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-danger btn-sm btn btn-light mb-2"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-white btn-sm btn btn-primary mb-2"><i class="bi bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-white btn-sm btn btn-success mb-2"><i class="bi bi-whatsapp"></i></a></li>
                </ul>
              </div>
          </div>
            <div class="col-sm-6 col-md-6 mt-4 col-lg-4 text-center text-sm-start">
              <div class="contact">
                  <h6 class="footer-heading text-uppercase text-white fw-bold">Contáctanos</h6>
                  <address class="mt-4 m-0 text-white mb-1"><i class="bi bi-pin-map fw-semibold"></i> Av. Industria Metalúrgica, Blvd. del Parque Industrial Francisco R. Alanis 2001, 25900 Ramos Arizpe, Coah.</address>
                  <a href="tel:+" class="text-white mb-1 text-decoration-none d-block fw-semibold"><i class="bi bi-telephone"></i>  844 503 9865</a>
                  <a href="mailto:" class="text-white mb-1 text-decoration-none d-block fw-semibold"><i class="bi bi-envelope"></i> 23040068@alumno.utc.edu.mx</a>
                  <br>
              </div>
            </div>
        </div>
    </div>
    </footer>

        <!-- <p>Bienvenido, <?= $_SESSION['user_nombre']; ?>. Has iniciado sesión correctamente.</p> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="myjs.js"></script>
        <!-- Toastr JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
                "positionClass": "toast-top-right",
            };
        </script>
</body>
</html>