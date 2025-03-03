<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .navbar-nav .nav-link {
            color: rgb(80, 80, 82); /* Color del texto de los enlaces */
        }

        .navbar-nav .nav-link:hover {
            color: rgb(255, 255, 255); /* Color del texto cuando pasas el mouse por encima */
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color:rgb(0, 0, 0);
        }

        .section {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2em;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .section.bg1 { 
            background-size: cover;
            display: flex;
            flex-direction: column; /* Asegura que los elementos dentro de la sección se apilen de arriba a abajo */
            align-items: center; /* Centra los elementos horizontalmente */
            justify-content: center; /* Centra los elementos verticalmente */
            text-align: center; /* Centra el texto */
            
            font-size: 2em;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            height: 100vh; /* Altura de la sección */
        }

        .section.bg3 { 
                    background-size: cover;
            display: flex;
            flex-direction: column; /* Asegura que los elementos dentro de la sección se apilen de arriba a abajo */
            align-items: center; /* Centra los elementos horizontalmente */
            justify-content: center; /* Centra los elementos verticalmente */
            text-align: center; /* Centra el texto */
            color: white;
            font-size: 2em;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            height: 100vh; /* Altura de la sección */
        }

        .b {
            color:white;
            text-align: center;
            margin: 30px;
        }

        .section.bg1 p {
            margin-top: 6px; 
        }



        .navbar-toggler {
            border-color: white; /* Cambia el color del borde del botón */
        }

        .navbar-toggler-icon {
            background-color: white; /* Color de las barras */
            -webkit-mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            mask-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }


        .bg1 { background: url('https://img.freepik.com/foto-gratis/primer-plano-sabrosa-hamburguesa-doble-queso-derretido_23-2148290698.jpg?semt=ais_hybrid') no-repeat center center fixed; background-size: cover; }
        .bg2 { background: url('https://img.freepik.com/foto-gratis/vista-frontal-hamburguesa-stand_141793-15542.jpg?semt=ais_hybrid') no-repeat center center fixed; background-size: cover; }
        .bg3 { background: url('https://img.freepik.com/foto-gratis/vista-frontal-hamburguesas-stand_141793-15545.jpg?semt=ais_hybrid') no-repeat center center fixed; background-size: cover; }
    
       
        .img {
            margin: 20px;
            transition: opacity 0.1s ease; /* Efecto de transición suave */
        }

        .img:hover {
            transform: scale(1.80);; /* Cambia la opacidad al pasar el cursor */
        }
        
        /* Estilos generales de los anuncios */
        .anuncio {
            position: fixed;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px;
            border-radius: 10px;
            display: none;
            z-index: 1000;
            width: 300px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        /* Posiciones diferentes para cada anuncio */
        #anuncio1 { bottom: 20px; right: 20px; }
        #anuncio2 { top: 20px; right: 20px; }
        #anuncio3 { bottom: 20px; left: 20px; }
        #anuncio4 { top: 20px; left: 20px; }
        #anuncio5 { top: 50%; left: 50%; }

        .anuncio button {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 10px;
        }


        .anuncio img {
            max-width: 100%;
            height: auto;
        }



        /* Animación de entrada */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    
    </style>
</head>
<body >
<nav class="navbar navbar-expand-lg" style="background-color:rgb(33, 33, 34);">
    <div class="container-fluid">
        <a class="navbar-brand" href="mariano.php">
            <img src="images/ML1.png" width="150px" height="65px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span  class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link" href="registrarse.php">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="iniciar.php">Iniciar Sesion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="section bg1">
    <img src="images/logo.png" class="img-fluid" width="1070px" height="270px">
    <p>"Las mejores hamburguesas, hechas con pasión y sabor"</p> 
    
</div>
<br><br>
<div class="b">
<h1>Historia de Burgers Buckers</h1>
<br>
<p> Desde 1999, Burgers Buckers ha sido el lugar donde las hamburguesas se reinventan. Fundado por Javier en una esquina tranquila de la ciudad, este pequeño restaurante comenzó con una misión: ofrecer algo más que una hamburguesa común. Con ingredientes frescos y combinaciones únicas, rápidamente se ganó el corazón de los locales.

Lo que comenzó como un modesto local, pronto se transformó en un referente de la ciudad. Con hamburguesas gourmet y un ambiente cálido y familiar, Burgers Buckers creció, expandiendo sus sucursales y convirtiéndose en un destino para todos los amantes de las hamburguesas.

Hoy, 25 años después, seguimos ofreciendo lo mejor en cada bocado, manteniendo la receta secreta que nos hizo famosos y un compromiso constante por sorprender a nuestros clientes con nuevos sabores.</P>
<br>
<img class="img-fluid" src="data:image/jpeg;base64,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" alt="">
<br>
</div>




<div class="section bg2">
    <ul>
    <p>📜 Menú</p>
    <li>Hamburguesas clásicas ( Hamburguesa con queso, Doble carne, BBQ).</li>
    <li>Especialidades de la casa ( Hamburguesa artesanal, Picante Mexicana).</li>
    <li>Acompañamientos (papas fritas, aros de cebolla).</li>
    <li>Bebidas y postres (malteadas, refrescos, helados).</li>
    </ul>
</div>
<br>

<div class="b">
<p >
No solo contamos con hamburguesas, también ofrecemos una amplia variedad de opciones como deliciosos acompañamientos, papas, hot dogs, nachos, refrescos y una selección de postres caseros para hacer de tu comida una experiencia completa
</p>

<img class="img" src="https://img.freepik.com/foto-gratis/pancho_144627-19566.jpg?ga=GA1.1.1240151379.1737325733&semt=ais_hybrid" widht="150px" height="200px" alt="">


<img class="img" src="https://img.freepik.com/fotos-premium/nachos-cheddar_70983-7.jpg?ga=GA1.1.1240151379.1737325733&semt=ais_hybrid" widht="150px" height="200px" alt="">


<img class="img" src="https://img.freepik.com/foto-gratis/rebanada-brownie-chocolate-helado-nuez-vainilla_114579-903.jpg?ga=GA1.1.1240151379.1737325733&semt=ais_hybrid" widht="150px" height="200px" alt="">

<br>
</div>

<div class="section bg3">
    <h1>Ubicacion</h1><br>
    <br>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3120.054062032376!2d-77.036871!3d38.897676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0:0x0!2zMzgnMzAnMTIuMiJOIDc3wr4jNjgnMjA!5e0!3m2!1ses!2sus!4v1592769454350!5m2!1ses!2sus" width="300" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>



</div>

<div id="anuncio1" class="anuncio">
    <img src="images/apple.jpg" alt="Descuento del 50%" />
    🚀 ¡Descuento del 50% solo hoy! <br>
    <button onclick="cerrarAnuncio(1)">Cerrar</button>
</div>

<div id="anuncio2" class="anuncio">
    <img src="images/atarashi-gakko.jpeg" alt="Cupón de regalo" />
    Concierto J-POP <br>
    <button onclick="cerrarAnuncio(2)">Cerrar</button>
</div>

<div id="anuncio3" class="anuncio">
    <img src="images/tarjeta.jpeg" alt="Cashback" />
    💳 ¡Compra con tu tarjeta y recibe cashback!  <br>
    <button onclick="cerrarAnuncio(3)">Cerrar</button>
</div>

<div id="anuncio4" class="anuncio">
    <img src="images/xbox.jpg" alt="Oferta limitada" />
    🔥 ¡Oferta limitada en productos seleccionados! <br>
    <button onclick="cerrarAnuncio(4)">Cerrar</button>
</div>

<div id="anuncio5" class="anuncio">
    <img src="images/reloj.jpg" alt="Últimas unidades disponibles" />
    💥 ¡Últimas unidades disponibles, corre! <br>
    <button onclick="cerrarAnuncio(5)">Cerrar</button>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

 <!-- Anuncio emergente -->
 

 <script>
        function mostrarAnuncio(id) {
            let anuncio = document.getElementById("anuncio" + id);
            anuncio.style.display = "block";

            // Ocultar después de 5 segundos
            setTimeout(() => {
                anuncio.style.display = "none";
            }, 5000);
        }

        function cerrarAnuncio(id) {
            document.getElementById("anuncio" + id).style.display = "none";
        }

        // Mostrar cada anuncio en tiempos diferentes
        setTimeout(() => mostrarAnuncio(1), 55000);  // 5s
        setTimeout(() => mostrarAnuncio(2), 100000); // 10s
        setTimeout(() => mostrarAnuncio(3), 150000); // 15s
        setTimeout(() => mostrarAnuncio(4), 200000); // 20s
        setTimeout(() => mostrarAnuncio(5), 250000); // 25s

        // Para repetir los anuncios cada cierto tiempo
        setInterval(() => mostrarAnuncio(1), 30000);
        setInterval(() => mostrarAnuncio(2), 35000);
        setInterval(() => mostrarAnuncio(3), 40000);
        setInterval(() => mostrarAnuncio(4), 45000);
        setInterval(() => mostrarAnuncio(5), 50000);
    </script>

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
