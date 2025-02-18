<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CND Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/styles.css">
    <!-- CDN Londrina Solid font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid&display=swap" rel="stylesheet">
    <title>Timo Burguer</title>
    <link rel="shortcut icon" href="images/Logo.png" type="image/x-icon">
    <!-- CDN Font Awasome -->
    <script src="https://kit.fontawesome.com/f60af16eb1.js" crossorigin="anonymous"></script>
    <!-- CDN AOS Scroll  -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark ">
        <div class="container-fluid" data-bs-theme="dark">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="images/Logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex me-auto ms-auto" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link bttnsNav mx-2" href="registro.php">Registrar</a>
                    <a class="nav-link bttnsNav mx-2" href="login.php">Inicia Sesion</a>
                    <a class="nav-link bttnsNav mx-2" href="">A domicilio</a>
                    <a class="nav-link ms-2 bttnsNav" type="button" data-bs-toggle="offcanvas" href="#offcanvasScrolling" aria-controls="offcanvasScrolling">Anuncios</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header" data-bs-theme="dark">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body text-light sideBarAnuncios">
            <div class="card mb-2" style="width: 100%;">
                <img src="images/anuncio1.jpg" class="card-img-top" alt="...">
            </div>
            <hr class="border border-1">
            <div class="card mb-2" style="width: 100%;">
                <img src="images/anuncio2.jpg" class="card-img-top" alt="...">
            </div>
            <hr class="border border-1">
            <div class="card mb-2" style="width: 100%;">
                <img src="images/anuncio3.jpg" class="card-img-top" alt="...">
            </div>
        </div>
    </div>

    <section class="container-fluid portada p-0 mb-5">
        <img src="images/portada.png" class="w-100">
    </section>


    <section class="container presentacion mb-md-2 p-5" data-aos="zoom-in-up">
        <div class="row">
            <aside class="col-md-6 p-3 my-auto">
                <h6 class="text-light">Sobre Nosotros</h6>
                <br>
                <img src="images/portada-1.jpg" class="w-100 my-auto" alt="">
            </aside>
            <aside class="col-md-6 p-3">
                <p class="textoPres text-light">
                    Desde 1980, en nuestra taquería familiar hemos deleitado a generaciones de clientes con auténticos sabores mexicanos. Nos enorgullecemos de ser una de las taquerías más reconocidas de Saltillo, gracias a nuestra pasión por la <strong>calidad</strong> y el buen <strong>servicio</strong> . <br><br>

                    Nuestro menú es pequeño, pero cada platillo está preparado con ingredientes frescos y recetas tradicionales que garantizan un sabor inigualable. Creemos que la excelencia está en los detalles, por eso priorizamos la calidad sobre la cantidad. <br><br>

                    Te invitamos a visitarnos en nuestra sucursal ubicada en Urdinola y disfrutar de nuestros tacos preparados al momento. Si prefieres la comodidad de tu hogar, puedes registrarte en nuestra plataforma y pedir tus platillos favoritos a domicilio. <br> <br>

                    ¡Déjate conquistar por el auténtico sabor de nuestra tradición!
                </p>
            </aside>

        </div>
    </section>



    <section class="container text-center my-5" style="width: 50vw;">
        <button type="button" class="btn btn-lg btn-outline-danger pd-m-2 w-100 btnMenu" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Menu
        </button>

    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog bg-dark">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <img class="w-100" src="images/Menu.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-3 d-flex justify-content-center">
            <div class=" col-md-3 col-10 mx-3 p-md-5 p-3 steps text-center bg-light" data-aos="fade-right">
                <i class="fa-solid fa-rectangle-list fs-1"></i>
                <p class="m-0 p-md-4 p-3 fw-bold">Registrate</p>
                <p style="min-height:6rem; max-height: 6rem;">¡Sé parte de nuestra comunidad! Regístrate y disfruta de beneficios exclusivos. 🍽️✨</p>
                <a class="btn btn-danger mb-auto" href="">Registrarse</a>
            </div>
            <div class="col-md-3 col-10 mx-3 p-md-5 p-3 steps text-center bg-light" data-aos="zoom-in">
                <i class="fa-solid fa-user fs-1"></i>
                <p class="m-0 p-md-4 p-3 fw-bold">Inicia Sesion</p>
                <p style="min-height:6rem; max-height: 6rem;">Inicia sesión y sigue disfrutando de tus platillos favoritos. 🔑🍔</p>
                <a class="btn btn-danger mb-auto" href="">Iniciar Sesion</a>
            </div>
            <div class="col-md-3 col-10 mx-3 p-md-5 p-3 steps text-center bg-light" data-aos="fade-left">
                <i class="fa-solid fa-truck-fast fs-1"></i>
                <p class="m-0 p-md-4 p-3 fw-bold">A domicilio</p>
                <p style="min-height: 6rem; max-height: 6rem;">¡Tu comida favorita hasta la puerta de tu casa! Haz tu pedido ahora. 🛵🍕</p>
                <a class="btn btn-danger" href="">Delivery</a>
            </div>

        </div>

    </div>

    <div class="container-fluid bg-dark mt-4 mb-0 text-light p-3">
        <div class="row g-3">
            <div class="col-md-4 col-12 fs-3">
                Timo Burguer <i class="fa-regular fa-registered fs-5"></i>
            </div>

            <div class="col-md-3 col-12">
                <p class="fw-bold">Horarios</p>
                <hr>
                <p>Luenes-Jueves: 6pm-1:20am</p>
                <p>Viernes-Sabado: 6pm-2:30am</p>
                <p>Domingo: 6pm-12:30am</p>

            </div>
            <div class="col-md-3 col-12 text-light">
                <p class="fw-bold">Informacion</p>
                <hr>
                <span class="col-12 d-flex justify-content-between my-1">
                    <i class="fa-brands fa-square-facebook fs-2"></i>
                    <i class="fa-brands fa-x-twitter fs-2"></i>
                    <i class="fa-brands fa-linkedin fs-2"></i>
                    <i class="fa-brands fa-youtube fs-2"></i>
                    <i class="fa-brands fa-instagram fs-2"></i>
                </span>
                <span class="col-12 my-1">
                    <i class="fa-solid fa-phone"></i> 844 677 9274
                </span>
                <br>
                <span class="col-12 my-1">
                    <i class="fa-solid fa-location-dot"></i> Calle Humboldt 1425-a, Agua Azul, 25030 Saltillo, Coah.
                </span>

            </div>

        </div>
    </div>
    </div>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>