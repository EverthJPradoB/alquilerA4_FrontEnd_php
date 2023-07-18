<?php
include('config.php');
//session_start(); // Iniciar la sesión

if (isset($_SESSION['user']) ||  isset($_SESSION['access_token'])) {

    $url = 'http://localhost:8090/Alquiler/listar';
    $json = file_get_contents($url);
    $listaAlquiler = json_decode($json);


} else {
    // El usuario no tiene la sesión iniciada, puedes redirigirlo a una página de inicio de sesión
    header('Location: login.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de aquiler de autos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .smaller-image {
            max-width: 300px;
            /* Ajusta el tamaño según tus necesidades */
            max-height: 300px;
            /* Ajusta el tamaño según tus necesidades */
        }
    </style>
</head>

<body>
   <?php include('nav.php'); ?>

    <div class="container pt-3">
        <h3>Lista de Autos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Modelo</th>
                    <th>TIpo de auto</th>
                    <th>Fecha de prestamo</th>
                    <th>Fecha de devolucion</th>
                    <th>Dias alquilados</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaAlquiler as $listaA) : ?>
                    <tr>
                        <td><?php echo $listaA->auto->placa; ?></td>
                        <td><?php echo $listaA->auto->modelo; ?></td>
                        <td><?php echo $listaA->auto->idTipoAuto->nombreTipo; ?></td>
                        <td><?php echo $listaA->fechaPrestamo ?></td>
                        <td><?php echo $listaA->fechaDevolucion ?></td>
                        <td><?php echo $listaA->numDias ?></td>
                        <td><?php echo $listaA->monto ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>



</body>

</html>