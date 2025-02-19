    <?php
    session_start();
    include 'conn.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['login'])) {
            $mail = $_POST['mail'];
            $_SESSION['mail'] = $mail;      
            $contrasena = $_POST['contrasena'];
            $validar = mysqli_query($conn, "SELECT nombre, mail FROM usuarios WHERE mail='$mail' AND contrasena='$contrasena'");
            if (mysqli_num_rows($validar) > 0) {
                $row = mysqli_fetch_assoc($validar);
                $_SESSION['logged'] = true;
                $_SESSION['nombre'] = $row['nombre'];
                
                echo'
                    <script>
                        alert("Bienvenido ' . $row['nombre'] . '.");
                        window.location = "index.php";
                    </script>
                ';
            }
        } elseif (isset($_POST['sign'])) {
            $nombre = $_POST['nombre'];
            $contrasena = $_POST['contrasena'];
            $mail = $_POST['mail'];
            $asunto = "Phone Fix&Sell Store: Bienvenido, $nombre";
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
                        <h1>BIENVENIDO A PHONE FIX & SELL STORE</h1>
                        <h2>Nombre de Usuario: ' . $nombre . ' </h2>
                        <h2>Contraseña: ' . $contrasena . ' </h2>
                    </main>
                </body>
            </html>
            ';

            $query = "INSERT INTO usuarios(nombre, contrasena, mail)
                      VALUES('$nombre','$contrasena','$mail')";
            $ejecutar = mysqli_query($conn ,$query);
            if ($ejecutar){
                mail($mail, $asunto, $mensaje, $cabeceras);
                echo'
                    <script>
                    alert("Usuario Registrado");
                    window.location = "index.php";
                    </script>
                ';
            }else{
                echo'
                    <script>
                    alert("Error al registrar usuario");
                    window.location = "index.php";
                    </script>
                ';
            };
            mysqli_close($conn);
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
        text-align: center;
        display: flex;
        flex-direction: column;
        display: none;
    }
    .asidebuttons a{
        display: 1;
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
        gap: 5vh;
    }
    .form section img{
        width: 70%;
        height: auto;
        opacity: 0.8;
    }
    .form section button{
        width: 90%;
        height: 15%;
        border-radius: 2vh;
        border-style: none;
        background-color: rgb(34, 34, 34);
        color: white;
        font-weight: bold;
        font-size: 15px;
        cursor: pointer;
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
    .iniciarsesion{
        width: 20vw;
        display: 1;
        transition: 150ms all ease-in-out;
    }
    .iniciarsesion p, .registrarse p{
        font-weight: bold;
        font-size: 20px;
        color: white;
        margin-bottom: 5px;
    }
    .iniciarsesion input[type="text"], .iniciarsesion input[type="password"], .registrarse input[type="text"], .registrarse input[type="password"], .registrarse input[type="email"]{
        text-align: center;
        width: 100%;
        height: 4vh;
        border-radius: 1vh;
        border-style: none;
        background-color: white;
        color: rgb(19, 19, 19);
        margin-bottom: 10px;
        font-weight: bold;
    }
    .iniciarsesion input[type="submit"], .registrarse input[type="submit"]{
        width: 100%;
        height: 6vh;
        border-style: solid;
        border-color: white;
        background-color: rgb(12, 12, 12);
        color: white;
        font-weight: bold;
        font-size: 15px;
        border-radius: 2vh;
        cursor: pointer;
        transition: 100ms all ease-in-out;
    }
    .iniciarsesion input[type="submit"]:hover, .registrarse input[type="submit"]:hover{
        filter: brightness(2);
    }
    .registrarse{
        width: 20vw;
        display: none;
        transition: 150ms all ease-in-out;
    }
    #tag1, #tag2{
        transition: 150ms all ease-in-out;
    }
    #tag1 button, #tag2 button{
        transition: 150ms all ease-in-out;
    }
    #tag1 button:hover, #tag2 button:hover{
        transform: scale(1.04);
    }
    .divisor{
        margin: auto;
        width: 80%;
        height: 1px;
        background-color: white;
        margin-bottom: 10px;
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
                BIENVENIDO
                <a href=""><button>CERRAR SESIÓN</button></a>
            </section>
        </aside>
    </nav>
    <main>
    </main>
    <div class="principal">
        <div class="form">
            <section id="tag1">
                <img src="imagenes/logos/PHONELOGO.png" alt="">
                <button id="btnRegistrar">REGISTRAR<br>USUARIO</button>
            </section>
            <section id="tag2">
                <img src="imagenes/logos/PHONELOGO.png" alt="">
                <button id="btnIniciarSesion">INICIAR<br>SESIÓN</button>
            </section>
            <div class="formtype">
                <form class="iniciarsesion" method="post">
                    <p>INICIAR SESIÓN</p>
                    <div class="divisor"></div>
                    <input type="text" name="mail" placeholder="CORREO" required><br>
                    <input type="password" name="contrasena" required placeholder="CONTRASEÑA"><br>
                    <div class="divisor"></div>
                    <input type="submit" name="login" value="INICIAR SESIÓN">
                </form>
                <form class="registrarse" method="post">
                    <p>REGISTRAR<br>USUARIO</p>
                    <div class="divisor"></div>
                    <input type="text" name="nombre" required placeholder="USUARIO"><br>
                    <input type="password" name="contrasena" required placeholder="CONTRASEÑA"><br>
                    <input type="email" name="mail" required placeholder="CORREO"><br>
                    <div class="divisor"></div>
                    <input type="submit" name="sign" value="REGISTRAR">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
        const btnRegistrar = document.getElementById("btnRegistrar")
        const btnIniciarSesion = document.getElementById("btnIniciarSesion")
        const formType = document.querySelector(".formtype")
        const formInciarSesion = document.querySelector(".iniciarsesion")
        const formRegistrarse = document.querySelector(".registrarse")
        const tag1 = document.getElementById("tag1")
        const tag2 = document.getElementById("tag2")

        
        btnRegistrar.addEventListener("click", function() {
            formType.style.right = "30vw";
            formInciarSesion.style.display = "none";
            formRegistrarse.style.display = "inline";
            tag1.style.opacity = "0";
            tag2.style.opacity = "1";

        });

        btnIniciarSesion.addEventListener("click", function() {
            formType.style.right = "0";
            formInciarSesion.style.display = "inline";
            formRegistrarse.style.display = "none";
            tag1.style.opacity = "1";
            tag2.style.opacity = "0";
        });
</script>