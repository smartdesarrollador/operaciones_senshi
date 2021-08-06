<?php
session_start();
error_reporting(0);
include '../model/Horario.php';
$objHorario = new Horario();


if (isset($_SESSION["current_email"]) && $_SESSION["current_email"] != '' ) {

} else {
    http_response_code(500);
    echo "Usuario no Autorizado";
    exit();
}

if ($_SESSION['current_rol'] =='admin') {

}else{
    echo "No tienes Permisos para acceder a este lugar";
    exit();
}
$id = trim($_POST['id']);
$estado = trim($_POST['estado']);

$estado = $objHorario->updateHorarioStatus($id,$estado);
echo $estado;
