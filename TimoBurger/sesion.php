<?php
require 'db_conection.php';
session_start();
if (isset($_POST['pedir'])) {
    $clienteId = $_SESSION['clienteId'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $hEspecial = $_POST['hEspecial'];
    $tBurger = $_POST['tBurger'];
    $tSencilla = $_POST['tSencilla'];
    $tMaiz = $_POST['tMaiz'];
    $direccion = $_POST['direccion'];
    $direccion = $_POST['direccion'];
    if (!empty($nombre) && !empty($descripcion)) {
        $pedir = $cnnPDO->prepare('INSERT INTO pedidos (clienteId, descripcion, direccion) VALUES (?, ?, ?)');
        $pedir->execute([$clienteId, $nombre, $descripcion]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CND Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<body class="forms-body">
    <nav class="navbar navbar-expand-lg bg-dark ">
        <div class="container-fluid" data-bs-theme="dark">
            <a class="navbar-brand d-flex" href="index.php">
                <img class="logo" src="images/Logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex me-auto ms-auto" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link bttnsNav mx-2" href="">Mis Pedidos</a>
                    <a class="nav-link bttnsNav mx-2" href="logout.php">Cerrar Sesion</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container col-md-12 col-11 my-5 px-5 py-3">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="m-2 text-center">
                    <h1 class="fs-1 text-center text-form text-light">HAZ TU PEDIDO EN TIMO BURGER</h1>
                    <img src="images/Logo.png" style="width:7vw;">
                </div>
                <hr>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <fieldset class="form-floating text-dark mb-4">
                                <input value="<?php echo $_SESSION['name']; ?>" name="nombre" class="form-control" placeholder="Leave a comment here" id="inpNombre">
                                <label for="inpNombre">Nombre:</label>
                            </fieldset>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <fieldset class="form-floating text-dark mb-4">
                                <input name="direccion" class="form-control" placeholder="Leave a comment here" id="inpDireccion">
                                <label for="inpDireccion">Direccion:</label>
                            </fieldset>
                        </div>
                        <div class="col-md-2 col-sm-6 col-6 mb-4">
                            <button type="button" class="btn btn-warning w-100 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Menu</button>
                        </div>
                        <div class="col-md-2 col-sm-6 col-6 mb-4">
                            <button class="btn btn-danger w-100 py-3">Enviar pedido</button>
                        </div>
                    </div>

                    <div class="row">
                        <section class="col-md-6 col-12">
                            <h3 class="text-center tipoProd">Hamburguesas</h3>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <p class="producto">Hamburguesa especial</p>
                                <input value="0" type="number" class="p-2" id="hEspecial" name="hEspecial" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Timo Burger</p>
                                <input value="0" type="number" class="p-2" id="tBurger" name="tBurger" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Hamburguesa sencilla</p>
                                <input value="0" type="number" class="p-2" id="hSencilla" name="hSencilla" min="1" max="100" style="height: 30px;">
                            </div>
                        </section>

                        <section class="col-md-6 col-12">
                            <h3 class="text-center tipoProd">Tacos de Bisteck</h3>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Maiz</p>
                                <input value="0" type="number" class="p-2" id="tMaiz" name="tMaiz" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="me-5 producto">Maiz c/ queso</p>
                                <input value="0" type="number" class="p-2" id="tMaizQueso" name="tMaizQueso" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Harina</p>
                                <input value="0" type="number" class="p-2" id="tHarina" name="tHarina" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Harina c/ queso</p>
                                <input value="0" type="number" class="p-2" id="tHarinaQueso" name="tHarinaQueso" min="1" max="100" style="height: 30px;">
                            </div>
                        </section>

                        <section class="col-md-6 col-12">
                            <h3 class="text-center tipoProd">Extras</h3>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Hot-Dog</p>
                                <input value="0" type="number" class="p-2" id="hotDog" name="hotDog" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Salchica Asada</p>
                                <input value="0" type="number" class="p-2" id="sAsada" name="sAsada" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Extras</p>
                                <input value="0" type="number" class="p-2" id="extras" name="extras" min="1" max="100" style="height: 30px;">
                            </div>
                        </section>

                        <section class="col-md-6 col-12">
                            <h3 class="text-center tipoProd">Bebidas</h3>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Refresco</p>
                                <input value="0" type="number" class="p-2" id="refresco" name="refresco" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Agua Natural</p>
                                <input value="0" type="number" class="p-2" id="aNatural" name="aNatural" min="1" max="100" style="height: 30px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="producto">Cafe</p>
                                <input value="0" type="number" class="p-2" id="cafe" name="cafe" min="1" max="100" style="height: 30px;">
                            </div>
                        </section>



                    </div>



                    <!-- <fieldset class="form-floating text-dark mb-4">
                        <textarea name="descripcion" class="form-control" placeholder="Leave a comment here" id="inpDescripcion" style="height: 100px;"></textarea>
                        <label for="inpDescripcion">Describe tu pedido:</label>
                    </fieldset> -->


                </form>
            </div>
        </div>
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>