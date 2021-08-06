<?php
session_start();
error_reporting(0);
include "../../model/Pedido.php";
include "../../model/ClienteLocal.php";
include "../class/Cart.php";
$objPedido = new Pedido();
$objCLocal = new ClienteLocal();
$cart = new Cart();
$cartItems = $cart->contents();

$horaEntregaLocal = $_POST['horarioEntrega'];

if ($horaEntregaLocal == 'SELECCIONAR') {
    $horaEntregaLocal = $_POST['horarioEntregaSeleccionado'];
}


$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$direccion = $_POST['direccion'];
$distrito = $_POST['distrito'];
$referencia = $_POST['referencia'];
$celular = $_POST['celular'];
$medioDePago = $_POST['medioDePago'];
$documento = $_POST['documento'];
$dni = $_POST['dni'];
$ruc = $_POST['ruc'];
$razon_social = $_POST['razon_social'];
$direccion_fiscal = $_POST['direccion_fiscal'];
$fechaEnvio = $_POST['fechaEnvio'];
$horario = $_POST['horario'];
$descripcion = $_POST['descripcion'];

$costoEnvio = $_POST['costoEnvio'];
$adicionalEnvio = $_POST['adicionalEnvio'];
$costoEnvioPagado = $_POST['envioPagado'];
$local_distrito = 'san_borja';


$driver = 3;
if (isset($_POST['driver'])) {
    $driver = $_POST['driver'];
}

$multiquery = '';

$total = $cart->total();


$delivery = ($_POST['tipoEnvio'] == 'recojo') ? 'false' : 'true';




/*=============================
 * -----INICIAO DE TRANSACCIONES
 * */

$idClienteLocal = $objCLocal->addNewClienteLocal($nombre, $apellido, $correo, $celular, $fechaNacimiento);


$pedidoInsertado = $objPedido->addPedidoLocal($direccion, $celular, $descripcion, $total, $delivery, $local_distrito, $referencia, $distrito, $documento
    , $razon_social, $direccion_fiscal, $ruc, $idClienteLocal, $dni, $medioDePago, $fechaEnvio, $horaEntregaLocal,
    $driver, $costoEnvio, $adicionalEnvio, $driver,$costoEnvioPagado);


foreach ($cartItems as $item) {
    $multiquery .= "INSERT INTO pedido_items (idPedido,idProducto,cantidad,item_descripcion,observacionesPaquete) 
VALUES ('" . $pedidoInsertado . "', '" . $item['id'] . "', '" . $item['qty'] . "', '" . $item['productoIngredientes'] . "', '" . $item['observacionesPaquete'] . "');";
}

$pedidoItems = $objPedido->addItemsPedido($multiquery);

$cart->destroy();

$ir = $_SERVER['HTTP_REFERER'];
$_SESSION['mensaje'] = 'success';
header("location:$ir");
exit();
