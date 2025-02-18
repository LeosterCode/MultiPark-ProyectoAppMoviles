<?php
require_once 'db_conection.php';

    if (isset($_POST["signup"])){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confPassword = $_POST['confPassword'];

        if (!empty($email) && !empty($name) && !empty($username) && !empty($password) && !empty($confPassword)){
            if($password === $confPassword){
                $signUp = $cnnPDO->prepare('INSERT INTO usuarios VALUES (null,?,?,?,?,null)');
                $signUp->execute([$name, $username,$password, $email]);
                
                echo 'Datos registrados';
            }else{
                echo 'Las contraseñas no coiciden';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Londrina Solid font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid&display=swap" rel="stylesheet">
    <!-- CND Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Registro | TimoBurguer</title>
    <link rel="shortcut icon" href="images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body class="forms-body">
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid" data-bs-theme="dark">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="images/Logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex me-auto ms-auto" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link btnAct mx-2" href="registro.php">Registrar</a>
                    <a class="nav-link mx-2 bttnsNav" href="login.php">Inicia Sesion</a>
                    <a class="nav-link bttnsNav mx-2" href="">A domicilio</a>
                    <a class="nav-link ms-2 bttnsNav" type="button" data-bs-toggle="offcanvas" href="#offcanvasScrolling" aria-controls="offcanvasScrolling">Anuncios</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header" data-bs-theme="dark">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
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

    <div class="container col-md-6 col-11 my-5 px-5 py-3">
        <div class="row">
            <div class="col-12 mx-auto text-light">
                <form method="POST">
                    <div class="m-2 text-center">
                        <p class="fs-1 text-center text-form">Crear cuenta</p>
                        <img  src="images/Logo.png" style="width:7vw;">
                    </div>
                    <hr>
                    <div class="mb-4">
                        <label class="my-1" for="email">Usuario:</label>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>
                    <div class="mb-4">
                        <label class="my-1" for="email">Nombre Completo:</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="mb-4">
                        <label class="my-1" for="email">Ingresa tu correo:</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="mb-4">
                        <label class="my-1" for="email">Crea una contrasena:</label>
                        <input class="form-control" type="text" name="password" id="password">
                    </div>
                    <div class="mb-4">
                        <label class="my-1" for="email">Confirmar contrasena:</label>
                        <input class="form-control" type="text" name="confPassword" id="confPassword">
                    </div>
                    <div class="mb-4">
                        <button class="btn btn-danger w-100" name="signup">Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>