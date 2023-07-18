<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        Bienvenido

        <?php if (isset($_SESSION['user'])) {
            echo $_SESSION['user'];
        } elseif (isset($_SESSION['user_first_name'])) {
            echo $_SESSION['user_first_name'];
        } ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>


            <li class="nav-item ">
                <a class="nav-link" href="reserva.php">Reservar Auto</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="listaAlquiler.php">Lista de alquiler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Cerrar Session</a>
            </li>
        </ul>
    </div>
</nav>