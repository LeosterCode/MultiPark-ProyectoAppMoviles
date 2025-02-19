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
    .main{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
    }
    .principal{
        margin-top: 20vh;
        width: 85%;
        height: 80vh;
        background: linear-gradient(white,white,white,rgb(218, 218, 218));
    }
    .row{
        margin: auto;
        width: 85%;
        height: 50%;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .item{
        position: relative;
        width: 15vw;
        height: 80%;
        background-color: white;
        border-radius: 4vh;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 150ms all ease-in-out;
    }
    .item a{
        text-decoration: none;
        color: black;
    }
    .item:hover{
        transform: scale(1.03);
    }
    .item figure{
        width: 100%;
        height: 70%;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .item figure img{
        width: auto;
        height: 80%;
    }
    .item section{
        width: 100%;
        height: 30%;
        display: 1;
        justify-content: center;
        align-content: center;
        text-align: center;
    }
    .modal1{
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
    <div class="main">
        <div class="principal">
            <div class="row">
                <div class="item" id="box1">
                    <a href="equipo1.php">
                        <figure>
                            <img src="imagenes/equipos/huaweinova13pro.png" alt="">
                        </figure>
                        <section>
                            HUAWEI NOVA 13 PRO<br><b>$10000 MXN</b>
                        </section>
                    </a>
                </div>
                <div class="item">
                    <a href="equipo2.php">
                        <figure>
                            <img src="imagenes/equipos/iphone12.jpg" alt="">
                        </figure>
                        <section>
                            IPHONE 12 PRO<br><b>$13000 MXN</b>
                        </section>
                    </a>
                </div>
                <div class="item">
                    <a href="equipo3.php">
                        <figure>
                            <img src="imagenes/equipos/iphone166.jpg" alt="">
                        </figure>
                        <section>
                            IPHONE 16 PRO MAX<br><b>$22000 MXN</b>
                        </section>
                    </a>
                </div>
                <div class="item">
                    <a href="equipo4.php">
                        <figure>
                            <img src="imagenes/equipos/oneplus13.jpg" alt="">
                        </figure>
                        <section>
                            ONE PLUS 13<br><b>$15000 MXN</b>
                        </section>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <a href="equipo5.php">
                        <figure>
                            <img src="imagenes/equipos/pocophone m5s.png" alt="">
                        </figure>
                        <section>
                            POCO PHONE M5S<br><b>$10000 MXN</b>
                        </section>
                    </a>
                </div>
                <div class="item">
                    <a href="equipo6.php">
                        <figure>
                            <img src="imagenes/equipos/samsungnote20ultra.jpg" alt="">
                        </figure>
                        <section>
                            NOTE 22 ULTRA<br><b>$22000 MXN</b>
                        </section>
                    </a>
                </div>
                <div class="item">
                    <a href="equipo7.php">
                        <figure>
                            <img src="imagenes/equipos/samsungs24ultra.jpg" alt="">
                        </figure>
                        <section>
                            S24 ULTRA<br><b>$18000 MXN</b>
                        </section>
                    </a>
                </div>
                <div class="item">
                    <a href="equipo8.php">
                        <figure>
                            <img src="imagenes/equipos/xiaomi114ultra.png" alt="">
                        </figure>
                        <section>
                            XIAOMI 14 ULTRA<br><b>$8000 MXN</b>
                        </section>
                    </a>
                </div>
            </div>
            <dialog >
                <img src="imagenes/equipos/samsungnote20ultra" alt="">
            </dialog>
        </div>
    </div>
</body>
</html>
<script>
</script>