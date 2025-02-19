<?php
session_start();
if (!isset($_SESSION['logged'])){
    $_SESSION['logged'] = false;
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
    div{
        position: absolute;
        width: 70vw;
        height: 70vh;
        top: 20vh;
        left: 15vw;
        display: flex;
        text-align: center;
    }
    div article{
        width: 60%;
        height: 100%;
        display: inline;
        
    }
    div article img{
        opacity: 0.8;
        width: 60%;
        height: auto;
        margin: auto;
        margin-top: 5vh;
        -webkit-box-reflect: below 3px 
        linear-gradient(transparent, rgba(0, 0, 0, 0.5));
    }
    div article p{
        margin-top: 15vh;
        font-size: 17px;
        font-weight: bold;
    }
    div aside{
        width: 40%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }
    div aside a{
        text-decoration: none;
        color: white;
        position: relative;
        transition: 150ms all ease-in-out;
    }
    div aside a:hover{
        transform: scale(1.05);
    }
    div aside a p{
        font-family: 'Segoe UI';
        font-size: 25px;
        font-weight: bold;
        letter-spacing: 5px;
        position: absolute;
        width: 100%;
        top: 7vh;
        text-shadow: 2px 2px 2px black;
    }
    .reparacion{
        align-content: center;
        text-align: center;
        margin: auto;
        width: 22vw;
        height: 25vh;
        background-image: url(imagenes/backgrounds/phone\ repair.jpeg);
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 4vh;
        filter: brightness(50%);
    }
    .venta{
        align-content: center;
        text-align: center;
        margin: auto;
        width: 22vw;
        height: 25vh;
        background-image: url(imagenes/equipos/iphone16.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 4vh;
        filter: brightness(50%);
    }
</style>
<body>
    <nav>
        <aside><img src="imagenes/logos/GEARLOGO.png" alt=""></aside>
        <section>
            <a href="">INICIO</a>
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
    <main>
    </main>
    <div>
        <article>
           <img src="imagenes/logos/PHONELOGO.png" alt="">
            <p>REPARACIÓN Y VENTA DE EQUIPOS CELULARES<br>SALTILLO, COAHUILA</p>
        </article>
        <aside>
            <a href="">
                <figure class="reparacion"></figure>
                <p>REPARACION</p>
            </a>
            <br>
            <a href="productos.php">
                <figure class="venta"></figure>
                <p>VENTAS</p>
            </a>
        </aside>
    </div>
</body>
<footer style="background-color: #222; color: #fff; text-align: center; padding: 20px;">
    <p><strong>Phone Fix</strong> &copy; 2025 | Reparación rápida y profesional de dispositivos móviles.</p>
    <p>📞 Teléfono: [844 870 6455] | ✉️ Email: <a href="mailto:23040136@alumno.utc.edu.mx" style="color: #f4b400;">23040136@alumno.utc.edu.mx</a></p>
    
    <p>🚀 ¡Confía en los expertos para devolverle la vida a tu smartphone!</p>
</footer>
</html>