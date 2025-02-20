<?php 
session_start();

include 'conn.php';
if (!isset($_SESSION['logged'])){
    $_SESSION['logged'] = false;
}
if ($_SESSION['logged']){
}else{
    echo '
        <script>
            alert("No has iniciado sesión");
            window.location = "index.php";
        </script>
    ';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo = $_POST['modelo'];
    $nombreusuario = $_SESSION['nombre'];
    $mail = $_SESSION['mail'];
    $validar = mysqli_query($conn, "SELECT * FROM equipos WHERE modelo='$modelo'");
    if (mysqli_num_rows($validar) > 0) {
        $row = mysqli_fetch_assoc($validar);
        if ($row['cantidad'] > 0){
            mysqli_query($conn, "UPDATE equipos SET cantidad = cantidad - 1 WHERE modelo='$modelo'");
            mysqli_query($conn, "UPDATE usuarios SET comprasrealizadas = comprasrealizadas + 1 WHERE nombre='$nombreusuario'");
            $asunto = "Phone Fix&Sell Store: Bienvenido, $nombreusuario";
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= 'From: '.$mail."\r\n";
            $mensaje ='
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                </head>
                <style>
                    body{
                        margin: 0;
                    }
                    main{
                        padding: 5vh;
                        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                        background-color: rgb(221, 221, 221);
                        text-align: center;
                    }
                    main img{
                        width: 30%;
                        height: auto;
                        margin: auto;
                    }
                </style>
                <body>
                    <main>
                        <img src="imagenes/logos/PHONELOGO.png" alt="">
                        <h1>COMPRA DE UN '.$modelo .' : PHONE FIX & SELL STORE</h1>
                        <h2>Nombre de Usuario: ' . $nombreusuario . ' </h2>
                        <h2>Modelo: ' . $modelo . ' </h2>
                        <h2>Precio: $13,000 </h2>
                    </main>
                </body>
            </html>
            ';
            mail($mail, $asunto, $mensaje, $cabeceras);
            echo '
                <script>
                    alert("Compra a nombre de ' . $_SESSION['nombre'] . ' realizada con éxito.");
                    window.location = "index.php";
                </script>
            ';
        }else{
            echo '
                <script>
                    alert("No hay equipos disponibles.");
                    window.location = "index.php";
                </script>
            ';
        }
    }else{
        echo '
            <script>
                alert("No existe el equipo.");
                window.location = "index.php";
            </script>
        ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta & Reparación de Celulares</title>
</head>
<style>
    body{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
    }
    nav{
        display: flex;
        width: 100%;
        height: 15vh;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.3);
        position: fixed;
        background-color: white;
        z-index: 2;
    }
    nav aside{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }
    nav aside img{
        width: 6vw;
        
    }
    nav section{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        width: 100%;
        display: flex;
        justify-content: left;
        align-items: center;
        padding-left: 3vw;
        font-weight: 700;
    }
    nav section a{
        font-size: 20px;
        text-decoration: none;
        color: black;
    }
    .asidebuttons section{
        flex-direction: column;
        text-align: center;
    }
    .asidebuttons a{
        display: <?php echo $_SESSION['logged'] ? 'none' : 'block'; ?>;
    }
    .asidebuttons section a, .asidebuttons section p{
        display: <?php echo $_SESSION['logged'] ? 'flex' : 'none'; ?>;
    }
    .asidebuttons a button{
        font-size: 15px;
        width: 15vw;
        height: 6vh;
        border-style: none;
        cursor: pointer;
        background-color: rgba(0, 0, 0, 0);
        font-weight: bold;
        transition: 150ms all ease-in-out;
    }
    .asidebuttons button:hover{
        background-color: rgb(230, 230, 230);
        color: rgb(46, 46, 46);
    }
    .asidebuttons section button{
        font-size: 15px;
        width: 15vw;
        height: 6vh;
        border-style: none;
        cursor: pointer;
        background-color: rgb(153, 0, 0);
        color: white;
        font-weight: bold;
        transition: 150ms all ease-in-out;
        border-radius: 10px;
    }
    .asidebuttons section button:hover{
        background-color: rgb(207, 0, 0);
        color: rgb(228, 228, 228);
    }
    main{
        width: 100%;
        height: 100vh;
        background-image: url(imagenes/backgrounds/phone\ repair.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 30px;
        background-attachment: fixed;
        opacity: 0.4;
    }
    main::before{
        content: '';
        width: 50%;
        height: 100%;
        clip-path: polygon(0 0, 100 0, 100 100, 0 100);
        background: linear-gradient(to left, black, rgba(0,0,0,0));
        position: absolute;
        right: 0;
    }
    .principal{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
    }
    .form{
        margin-top: 25vh;
        position: relative;
        width: 60vw;
        height: 60vh;
        background-color: white;
        border-radius: 5vh;
        box-shadow: 0 1vh 1vh rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-around;
    }
    .form section{
        position: relative;
        width: 40%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 0vh;
    }
    .form section a{
        position: absolute;
        top: 10px;
        left: 0px;
        color: black;
        text-decoration: none;
        border-radius: 5vh;
        width: 5vh;
        height: 5vh;
        border-style: solid;
        border-color: grey;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: 22px;
        font-weight: bold
    }
    .comprarbutton{
        width: 20vw;
        height: 10vh;
        font-size: 17px;
        font-weight: bold;
        color: white;
        background-color: grey;
        border-style: solid;
        border-color: white;
        cursor: pointer;
        transition: 180ms all ease-in-out;
    }
    .comprarbutton:hover{
        transform: scale(1.02);
        background-color: rgb(46, 46, 46);
    }
    .formtype{
        position: absolute;
        width: 30vw;
        height: 60vh;
        right: 0;
        top: 0;
        background-color: rgb(54, 54, 54);
        border-radius: 5vh;
        transition: 350ms all ease-in-out;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        text-align: center;
    }
    .formtype img{
        width: auto;
        height: 80%;
        margin: 30px;
        background-color: white;
        border-radius: 10px;
    }
</style>
<body>
    <nav>
        <aside><img src="imagenes/logos/GEARLOGO.png" alt=""></aside>
        <section>
            <a href="index.php">INICIO</a>
        </section>
        <aside class="asidebuttons">
            <section>
                <p>BIENVENIDO <?php echo $_SESSION['nombre'] ?></p>
                <a href="logout.php"><button>CERRAR SESIÓN</button></a>
            </section>
            <a href="loginsingup.php"><button>INICIAR SESIÓN</button></a>
            <a href="loginsingup.php"><button>REGISTRAR USUARIO</button></a>   
        </aside>
    </nav>
    <main></main>
    <div class="principal">
        <div class="form">
            <section>
                <a href="productos.php"><</a>
                <h2>IPHONE 12 PRO</h2>
                <p>COSTO:<b>$13000</b></p>
                <form method="post">
                    <input style="display:none" type="text" name="modelo" readonly value="iphone12pro">
                    <input class="comprarbutton" type="submit" value="COMPRAR">
                </form>
            </section>
            <section></section>
            <div class="formtype"><img src="imagenes/equipos/iphone12.jpg" alt=""></div>
        </div>
    </div>
</body>
</html>
<script>
</script>