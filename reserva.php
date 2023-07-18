<?php
include('config.php');
//session_start(); // Iniciar la sesión

if (isset($_SESSION['user']) ||  isset($_SESSION['access_token'])) {

    $url = $url = 'http://localhost:8090/Autos/autos/' . $_SESSION['auto_id'];
    $json = file_get_contents($url);
    $auto = json_decode($json);
} else {
    // El usuario no tiene la sesión iniciada, puedes redirigirlo a una página de inicio de sesión
    header('Location: login.php');
    exit();
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Reserva de Auto</title>
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

    <section id="rentalForm" class="mt-5">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <?php

                    ?>
                    <div action="reserva.php" method="POST">
                        <div class="card-body bg-light text-dark p-4">
                            <h5 class="card-title"><?php echo $auto->idMarcaAuto->nombreMarca ?></h5>
                            <img class="card-img-top smaller-image" src="admin/assets/uploads/imgServices/<?php echo $auto->foto ?>" alt="Car 1">
                            <div class="card-body">
                                <p class="card-text">Marca: <?php echo $auto->idTipoAuto->nombreTipo ?></p>
                                <p class="card-text">Modelo: <?php echo $auto->modelo ?></p>
                                <!-- <p class="card-text border border-success p-2">Estado: <?php //echo $auto->idEstadoAuto->disponibilidad 
                                                                                            ?></p> -->
                                <input type="hidden" name="auto_id" value="<?php echo $auto->idAuto ?>">
                                <p class="card-text">Capacidad: <?php echo $auto->capacidad ?></p>
                                <p class="card-text">Año: <?php echo $auto->año ?></p>
                                <p class="card-text">precio: <?php echo $auto->precio ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <section id="rentalForm" class="mt-5">
                        <form class="rental-form" action="alquilerService.php" method="POST">
                            <h2 class="mb-4">Reserva tu Auto</h2>
                            <div class="form-group">
                                <label for="pickup">Fecha de Recogida:</label>
                                <input type="date" class="form-control" id="pickup" name="pickup" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dropoff">Fecha de Entrega:</label>
                                <input type="date" class="form-control" id="dropoff" name="dropoff" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <input type="hidden" name="auto_id_a" value="<?php echo $auto->idAuto ?>">
                            <input type="hidden" name="precio_a" value="<?php echo  $auto->precio ?>">
                            <input type="hidden" name="user_a" value="<?php echo "USPRU" ?>">
                            <input type="hidden" name="encargado_a" value="<?php echo "USADM" ?>">

                            <button type="submit" class="btn btn-primary btn-block">Reservar</button>
                        </form>
                    </section>
                </div>
            </div>


        </div>
    </section>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>