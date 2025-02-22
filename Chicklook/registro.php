<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root"; // Cambia esto si usas otro usuario
$password = ""; // Cambia esto si tienes una contraseña
$dbname = "ecommerce"; // Cambia por el nombre de tu base de datos

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("<script>alertify.error('Error de conexión: " . $conn->connect_error . "');</script>");
}

// Obtener datos del formulario
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password']; // Contraseña en texto plano

// Preparar la consulta SQL
$sql = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Enviar correo de confirmación
    $to = $email;
    $subject = "Registro exitoso en E-commerce";
    $message = "Hola $username,\n\nGracias por registrarte en nuestro sitio.\n\nTu usuario: $username\nTu contraseña: $password\n\nSaludos,\nEl equipo de E-commerce.";
    $headers = "From: no-reply@tuweb.com\r\n";
    $headers .= "Reply-To: soporte@tuweb.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar el correo
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>
            alertify.success('Registro exitoso. Se ha enviado un correo de confirmación.');
            setTimeout(function() { window.location.href = 'index1.html'; }, 2000);
        </script>";
    } else {
        echo "<script>alertify.warning('Registro exitoso, pero no se pudo enviar el correo.');</script>";
    }
} else {
    echo "<script>alertify.error('Error en el registro: " . $stmt->error . "');</script>";
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
