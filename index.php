<?php


//Include Configuration File
include('config.php');


$url = 'http://localhost:8090/Autos/listar';
$json = file_get_contents($url);
$data = json_decode($json);


$login_button = '';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Alquiler de Autos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .success {
            color: green;
        }

        .error {
            color: red;
        }

        body {
            text-align: center;

            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        body {
            background-color: #f8f9fa;
        }

        .jumbotron {
            background-image: url('https://via.placeholder.com/1200x600');
            /* Cambiar esta URL por la imagen que desees */
            background-size: cover;
            background-position: center;
            min-height: 600px;
        }

        .rental-form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .carousel-item img {
            max-width: 100vw;
            /* Ajusta el ancho máximo de las imágenes */
            max-height: 90vh;
            /* Ajusta la altura máxima de las imágenes */
            margin: 0 auto;
            /* Centra las imágenes horizontalmente */
        }
    </style>


</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Alquiler de Autos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>

                    <?php if (!isset($_SESSION['user']) && !isset($_SESSION['access_token'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user']) ||  isset($_SESSION['access_token'])) {  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="listaAlquiler.php">Auto alquiladoss</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExample" data-slide-to="1"></li>
                <li data-target="#carouselExample" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="admin/assets/uploads/cars_img/1603338000_DSC_7294_800x450.jpg" class="d-block w-100" alt="Imagen 1"> <!-- Cambiar esta URL por la imagen que desees -->
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
                <div class="carousel-item">
                    <img src="admin/assets/uploads/cars_img/1603338300_honda civic.jpg" class="d-block w-100" alt="Imagen 2"> <!-- Cambiar esta URL por la imagen que desees -->
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
                <div class="carousel-item">
                    <img src="admin/assets/uploads/cars_img/1686759420_bmw2.jpg" class="d-block w-100" alt="Imagen 3"> <!-- Cambiar esta URL por la imagen que desees -->
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h3>Título de la imagen 3</h3>
                        <p>Descripción de la imagen 3</p> -->
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </header>


    <main>
        <section class="mt-5" id="servicios">

            <div class="container">
                <div class="row">

                    <?php

                    ?>

                    <?php foreach ($data as $auto) { ?>

                        <?php if ($auto->idEstadoAuto->disponibilidad == "DISPONIBLE") { ?>


                            <div class="col-md-4">
                                <form action="reserva.php" method="POST">
                                    <div class="card-body bg-light text-dark p-4">
                                        <h5 class="card-title"><?php echo $auto->idMarcaAuto->nombreMarca ?></h5>
                                        <img class="card-img-top" src="admin/assets/uploads/imgServices/<?php echo $auto->foto ?>" alt="Car 1">
                                        <div class="card-body">
                                            <p class="card-text">Marca: <?php echo $auto->idTipoAuto->nombreTipo ?></p>
                                            <p class="card-text">Modelo: <?php echo $auto->modelo ?></p>
                                            <p class="card-text border border-success p-2">Estado: <?php echo $auto->idEstadoAuto->disponibilidad ?></p>
                                            <input type="hidden" name="auto_id" value="<?php echo  $_SESSION['auto_id'] = $auto->idAuto  ?>">
                                            <input type="hidden" name="precio_a_id" value="<?php echo $auto->precio ?>">

                                            <button type="submit" class="btn btn-primary">Alquilar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </section>

    </main>

    <footer class="py-3 bg-light">
        <div class="container text-center">
            <p>© 2023 Alquiler de Autos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 3000 // Cambia la imagen cada 3 segundos (3000 ms)
            });
        });
    </script>

</body>

</html>