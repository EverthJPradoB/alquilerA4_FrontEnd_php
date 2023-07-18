<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los valores de los campos del formulario

    // Iniciar la sesión
    session_start();
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Crear el arreglo de datos a enviar al servicio en Spring
    $datos = array(
        'usuario' => $usuario,
        'clave' => $clave,
    );

    // URL del servicio en Spring
    $url = 'http://localhost:8090/api/login';

    $ch = curl_init();

    // Configurar la solicitud POST con contenido JSON
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para obtener la respuesta en lugar de imprimirla directamente

    // Ejecutar la solicitud y obtener la respuesta
    $response = curl_exec($ch);

    // Verificar si ocurrió algún error
    if (curl_errno($ch)) {
        echo 'Error en la solicitud: ' . curl_error($ch);
        exit();
    }

    // Obtener el código de estado de la respuesta
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


    // Cerrar la conexión cURL
    curl_close($ch);

 
    // Verificar el código de estado y el contenido de la respuesta
    if ($httpCode === 200) {
        $_SESSION['user'] =  $usuario;

    
        // El login fue exitoso, redirigir al usuario a la página de reserva
        header('Location: index.php');
    } elseif ($httpCode == 401 && $response == '{"message":"Error de autenticación"}') {

        echo "Error de autenticación";
        
    } else {
    
        // Respuesta desconocida, mostrar un mensaje genérico
        echo "Error en la solicitud";
    }
}
