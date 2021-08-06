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

$idCliente = $_POST['idCliente'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$celular = $_POST['celular'];


$affectedRows = $objClienteLocal->updateClienteLocal($idCliente, $nombre, $apellido, $correo, $fechaNacimiento, $celular);

if ($affectedRows >= 0) {
    echo json_encode(array('ok' => 'true', 'message' => 'Cliente actualizado correctamente'));
    exit();
} else {
    echo json_encode(array('ok' => 'false', 'message' => 'No tienes permisos para realizar esta acción'));
    exit();
}


