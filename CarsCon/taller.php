<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Interactivo</title>
    <!-- Incluye el CSS de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="index-styles.css">
    <link rel="stylesheet" href="product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        #map { 
            height: 600px; 
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
            <a class="navbar-brand" href="index.php">CarsCon</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
            <button class="btn btn-danger">
                <a href="logout.php" style="color: white;">Cerrar Sesión</a>
            </button>
    </div>
    </nav>
</header>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
        <h1>TALLER</h1>
    </div>
    <h2>Tu ubicación y el camino hacia el destino</h2>
    <div id="map"></div>

    <!-- Incluye las librerías de Leaflet y la API de Directions (Ruta) -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script>
        // Crear el mapa centrado en un punto por defecto
        var map = L.map('map').setView([25.380525, -101.003706], 13);  // Coordenadas de Guadalajara, por ejemplo

        // Añadir OpenStreetMap como capa base
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Ubicación fija (Destino)
        var destino = [25.380525, -101.003706];  // Ejemplo de coordenadas (Guadalajara)

        // Crear un marcador para el destino
        L.marker(destino).addTo(map)
            .bindPopup("Destino: CarsCon")
            .openPopup();

        // Función para obtener la ubicación del usuario y marcar el camino
        function obtenerUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var usuarioLat = position.coords.latitude;
                    var usuarioLon = position.coords.longitude;
                    
                    // Crear marcador para la ubicación del usuario
                    var usuarioMarker = L.marker([usuarioLat, usuarioLon]).addTo(map)
                        .bindPopup("Tu ubicación")
                        .openPopup();

                    // Añadir la ruta entre la ubicación del usuario y el destino
                    L.Routing.control({
                        waypoints: [
                            L.latLng(usuarioLat, usuarioLon),
                            L.latLng(destino[0], destino[1])
                        ]
                    }).addTo(map);
                    
                    // Centrar el mapa en la ubicación del usuario
                    map.setView([usuarioLat, usuarioLon], 13);
                }, function() {
                    alert("No se pudo obtener la ubicación.");
                });
            } else {
                alert("La geolocalización no es compatible con tu navegador.");
            }
        }

        // Llamar a la función para obtener la ubicación y trazar el camino
        obtenerUbicacion();
    </script>
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
</body>
</html>
