<?php
session_start();

// Conectar a la base de datos
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "ecommerce"; 

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobar si los campos están definidos
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($password)) {
        // Consultar si el usuario existe
        $sql = "SELECT id, password FROM usuarios WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($stmt->num_rows > 0 && $password === $hashed_password){
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: pagina1.html");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos. <a href='index1.html'>Intentar de nuevo</a>";
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos. <a href='index1.html'>Intentar de nuevo</a>";
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();
?>
