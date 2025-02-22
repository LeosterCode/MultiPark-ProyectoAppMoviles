<?php
session_start();
session_destroy(); // Destruir la sesión
header("Location: index1.html"); // Redirigir al login
exit();
?>
