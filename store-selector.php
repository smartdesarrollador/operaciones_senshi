<?php
session_start();
$page = 'store-selector';

if (isset($_SESSION["current_email"]) && $_SESSION["current_email"] != '') {
} else {
    header('HTTP/1.1 301 Moved Permanently');
    header('location: ./');
    exit();
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>.::Store-Selector::.</title>
    <?php include 'layout/library.php' ?>
    <link rel="stylesheet" href="css/dashboard.css">

    <script src="js/dashboardHead.js"></script>

</head>

<body>
    <nav>
        <div class="nav-wrapper black">
            <!-- <a href="#!" class="brand-logo center">Logo</a>-->
            <img class="brand-logo center" src="img/logoMain.png" alt="" style="width: 50px;margin-top: 5px">
        </div>
    </nav>
    <div class="container animated fadeIn fast">

        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 z-depth-6 xl6 offset-xl3">
                <div class="card-panel ">
                    <h5 class="center-align grey-text text-darken-1" style="font-weight: bolder">Bienvenido,
                        <?= $_SESSION["current_fullName"] ?></h5>
                    <h6 class="center-align grey-text text-darken-1" style="font-weight: bold">Selecciona un Local</h6>
                    <div class="row">
                        <div class="col-12">
                            <div class="collection">
                                <a href="/operaciones_senshi/" class="collection-item grey-text text-darken-2">
                                    <h6>
                                        <i class="material-icons left">store</i>
                                        Local 1 (Lince)
                                    </h6>
                                </a>
                                <a href="/operaciones_senshi/store" class="collection-item grey-text text-darken-2">
                                    <h6>
                                        <i class="material-icons left">store</i>
                                        Local 2 (San Borja)
                                    </h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-s12 center-align">
                <a href="script/logOut.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>


</body>

</html>