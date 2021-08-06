<?php
ob_start();

include '../model/Tienda.php';

//echo $_GET["costoEnvioDistrito"];

if (isset($_POST["costoEnvioDistrito"])) {
    $costoEnvioDistrito = trim($_POST["costoEnvioDistrito"]);
    $idDistrito = $_POST["idDistrito"];


    $objTienda = new Tienda();

    $tienda = $objTienda->updateCostoEnvioDistrito($costoEnvioDistrito, $idDistrito);

    header('location: ../tienda?code=success');
} else {
    echo "No tiene autorizacion para ver esta pagina";
}
