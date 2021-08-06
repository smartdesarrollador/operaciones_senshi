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

include '../model/Pedido.php';
$objPedido = new Pedido();
$idPedido = trim($_REQUEST['idPedido']);


$affectedRows = $objPedido->borrarPedido($idPedido);
if ($affectedRows > 0) {
    echo json_encode(array('ok' => 'true', 'message' => 'Pedido eliminado correctamente'));
}else{
    echo json_encode(array('ok' => 'false', 'message' => 'Error inesperado al borrar el pedido'));
}
