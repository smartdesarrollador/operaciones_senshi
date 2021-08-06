<?php
session_start();
header('Content-Type: application/json');
if (isset($_SESSION["current_email"]) && $_SESSION["current_email"] != '') {

} else {

    echo json_encode(array('ok' => 'false', 'message' => 'Error, por favor inicia sesión nuevamente'));
    exit();
}

if ($_SESSION['current_rol'] == 'admin') {

} else {
    echo json_encode(array('ok' => 'false', 'message' => 'No tienes permisos para realizar esta acción'));
    exit();
}
include '../../model/ClienteLocal.php';
$objClienteLocal = new ClienteLocal();

$idCliente = $_REQUEST['id'];

$clienteLocal = $objClienteLocal->getClienteLocal($idCliente);

echo json_encode(array('ok' => 'true', 'message' => 'Cliente Obtenido', 'data' => $clienteLocal));
