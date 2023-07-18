<?php

// Verificar si se ha enviado el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capturar los valores de los campos del formulario

    $auto_id_a = $_POST['auto_id_a'];

    $user_a = $_POST['user_a'];

    $estado = 1;
    $pickupDate = $_POST['pickup'];

    $dropoffDate = $_POST['dropoff'];

    // // para restar las fechas, numero de dias
    $pickupDate = new DateTime($pickupDate);

    $dropoffDate = new DateTime($dropoffDate);


    $interval = $pickupDate->diff($dropoffDate);
    $days = $interval->days;




    $precio_a = $_POST['precio_a'];
    $monto =  $days * $precio_a;

    $encargado_a = $_POST['encargado_a'];



    // // //formato para pasar la fechas en json 
    $pickupDate_ = date('Y-m-d', strtotime($_POST['pickup']));
    $dropoffDate_ = date('Y-m-d', strtotime($_POST['dropoff']));


    echo   $auto_id_a . "\n";
    echo   $user_a . "\n";
    echo   $estado . "\n";

    echo   $pickupDate_ . "\n";
    echo   $dropoffDate_ . "\n";
    echo   $days . "\n";

    echo   $precio_a . "\n";



    echo   $monto . "\n";

    echo   $encargado_a . "\n";


    $datos = array(
        'auto_id_a' => $auto_id_a,
        'user_a' => $user_a,
        'estado' => $estado,
        'fechapres' =>  $pickupDate_,
        'fechadevo' => $dropoffDate_,


        'numdias' => $days,
        'precio' => $precio_a,
        'monto' => $monto,
        'encargado_a' => $encargado_a,
    );


    // URL del servicio en Spring
    $url = 'http://localhost:8090/Alquiler/addAlquiler';


    $ch = curl_init();

    // // Configurar la solicitud POST
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datos));

    // Configurar la solicitud POST con contenido JSON
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Ejecutar la solicitud y obtener la respuesta
    $response = curl_exec($ch);

    // Verificar si ocurrió algún error
    if (curl_errno($ch)) {
        echo 'Error en la solicitud: ' . curl_error($ch);
    }


    //Obtener el código de estado de la respuesta
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Cerrar la conexión cURL
    curl_close($ch);

    //Validar el código de estado de la respuesta
    if ($httpCode == 200) {
       
        header('Location: listaAlquiler.php');
        exit();
    } else {
        header('Location: pagina_error.php');
        exit();
    }
}
