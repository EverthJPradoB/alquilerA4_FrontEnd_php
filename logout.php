<?php

//logout.php

include('config.php');

//Reset OAuth access token
$google_client->revokeToken();

// Eliminar todas las variables de sesión
session_unset();

//Destroy entire session data.
session_destroy();

//redirect page to index.php
// Verificar si las variables de sesión han sido eliminadas
if (count($_SESSION) === 0) {
    header('Location: index.php');
} else {
    echo "Error al eliminar las variables de sesión o destruir la sesión.";
}
