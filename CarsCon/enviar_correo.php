<?php 
if (isset($_POST['contacto'])){
    $correo = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['message']);

    if(!empty($correo) && !empty($mensaje)){

        // Validar el formato del correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                toastr.warning('El correo electrónico no es válido.', 'Validación');
            </script>";
            return; // Detener la ejecución si el correo no es válido
        }

        // Configuración del correo
        $to = $correo; // Correo del usuario
        $subject = "Gracias por ponerte en contacto con nosotros";
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: no-reply@carscon.com\r\n";

        // Mensaje del correo
        $message = "
        <html>
        <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);'>
                <h1 style='color: #27ae60; text-align: center;'>Gracias por tu mensaje!</h1>
                <h1 style='color: black; text-align: center;'>CarsCon</h1>
                <p style='font-size: 16px; color: #333;'>Hola</p>
                <p style='font-size: 16px; color: #333;'>Gracias por ponerte en contacto con nosotros. Te responderemos en breve.</p>
                <p style='font-size: 16px; color: #333;'><strong>Tu mensaje:</strong></p>
                <p style='font-size: 16px; color: #333;'>$mensaje</p>
            </div>
        </body>
        </html>";

        // Enviar el correo
        if (mail($to, $subject, $message, $headers)) {
            echo "<script>
                setTimeout(function() {
                    toastr.success('Correo enviado, verifique su bandeja de entrada');
                }, 100); // Retraso de 100 ms
            </script>";
        } else {
            echo "<script>
                toastr.warning('Por favor, completa todos los campos.', 'Validación');
            </script>";
        }
}
}
?>