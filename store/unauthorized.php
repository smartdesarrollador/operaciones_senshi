<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>.::UNAUTHORIZED::.</title>
    <?php include 'layout/library.php' ?>

</head>
<body class="">
<?php include 'layout/userNavBar.php' ?>
<div class="container" style="margin-bottom: 80px">
    <div class="row">
        <div class="col l4 s12 m4 xl4 push-l4 push-l4 push-xl4 push-xl4 push-m4 pull-m4 z-depth-5 "
             style="border-radius: 5px; border: 3px solid black;margin-top: 30px;margin-top: 80px">

            <div class="row">
                <div class="col s12 center-align">
                    <img style="width: 50%" src="img/icons/unauthorized-person.png" alt="unauthorized">
                </div>
            </div>
            <h5 class="center-align">No tienes permisos para acceder a este lugar</h5>
            <div class="center-align">
                <a href="./" class="btn btn-large red white-text waves-effect waves-light" style="margin-top: 30px;margin-bottom: 30px">VOLVER</a>
            </div>
        </div>
    </div>

</div>
<?php include 'layout/userFooter.php' ?>

</body>
</html>
