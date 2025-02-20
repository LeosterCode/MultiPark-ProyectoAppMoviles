<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Búsqueda</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="product.css">
        <style>
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                margin: 0;
            }

            footer {
                margin-top: auto;
            }
        </style>
    </head>
    <header>
    <nav class="navbar navbar-expand-lg bg-secondary-subtle">
    <div class="container-fluid">
        <div class="divlogo">
            <a href="index.php">
                <img src="images/logocar.png" alt="logocar" width="60px">
            </a>
        </div>
        <a class="navbar-brand" href="index.php">CarsCon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
            <button class="btn btn-danger">
                <a href="logout.php" style="color: white;">Cerrar Sesión</a>
            </button>
    </div>
    </nav>
</header>
<body>
    <br><br>
        <center>
            <?php
                        // Verificar si la búsqueda tiene un valor
                        if (isset($_GET['query'])) {
                            $query = $_GET['query'];
                            // Conectar a la base de datos
                            $dsn = "mysql:host=localhost;dbname=mariano";
                            $username = "root";
                            $password = "";
                            
                            try {
                                $pdo = new PDO($dsn, $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                                // Buscar productos (ajusta el nombre de la tabla y las columnas)
                                $stmt = $pdo->prepare("SELECT * FROM productos WHERE nombre LIKE :query");
                                $stmt->execute(['query' => "%" . $query . "%"]);
                                $resultados = $stmt->fetchAll();
            
                                if ($resultados) {
                                    echo "<h2>Resultados de la búsqueda para: '$query'</h2>";
                                    echo "<ul>";
                                    foreach ($resultados as $producto) {
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
                                    echo "</ul>";
                                } else {
                                    echo "<p>No se encontraron resultados para '$query'.</p>";
                                }
            
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        } else {
                            echo "<p>Por favor, ingrese un término de búsqueda.</p>";
                        }
                        ?>
        </center>
    <br><br>
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
</body>
</html>