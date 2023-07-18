

<?php

include('config.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            <div class="login-header">
                <img src="https://www.zarla.com/images/zarla-alquila-car-1x1-2400x2400-20220110-7ydf4xvrx3c7cktr4wtj.png?crop=1:1,smart&width=250&dpr=2" alt="Imagen de Perfil">
            </div>
            <h2 class="text-center mb-3">Inicio de Sesión</h2>
            <form action="validarLoginService.php" method="post">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave" required>
                </div>
                <div class="form-group text-center">
                    <div style="display: inline-block;">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                    <div style="display: inline-block; margin-left: 10px;">
                        <?php
                        // Ancla para iniciar sesión con Google
                        if (!isset($_SESSION['access_token'])) {
                            echo '<a href="' . $google_client->createAuthUrl() . '" style="background: #dd4b39; border-radius: 5px; color: white; display: inline-block; font-weight: bold; padding: 0px 0px; text-align: center; text-decoration: none; width: 100%; box-sizing: border-box;">
                    <img src="https://1000logos.net/wp-content/uploads/2016/11/google-logo.jpg" alt="Login With Google" width="120" height="50">
                </a>';
                        }
                        ?>
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>

</html>