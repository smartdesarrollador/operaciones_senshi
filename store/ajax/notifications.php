<?php
header('Content-Type: application/json');
date_default_timezone_set('America/Lima');

include "../model/Pedido.php";
$pedido = new Pedido();

$actualDate = date('Ymd');
$horaActual = date('H');

/*$horaActual = date('H');*/

$pedidos = $pedido->getPedidosByFechaDeEnvio($actualDate);
$pedidosLocal = $pedido->getPedidosLocalByFechaDeEnvio($actualDate);

$pedidosAEnviar = [];
foreach ($pedidos as $pedido) {
    if ($horaActual == 11 && $pedido['idHorario'] == 1) {
        array_push($pedidosAEnviar, $pedido);
    }
    if ($horaActual == 13 && $pedido['idHorario'] == 2) {
        array_push($pedidosAEnviar, $pedido);
    }

    if ($horaActual == 15 && $pedido['idHorario'] == 3) {
        array_push($pedidosAEnviar, $pedido);
    }
}

foreach ($pedidosLocal as $pedido) {
    if (strlen($pedido['horaEntregaLocal']) < 1) {
        break;
    }
    if ($pedido['horaEntregaLocal'] == 'AHORITA') {
        break;
    }

    $arrHoraEntrega = explode(':', $pedido['horaEntregaLocal']);
    $horaEntrega = $arrHoraEntrega[0];
    if ($horaActual == $horaEntrega - 1) {
        /*echo 'coincide';*/
        $pedido['descripcionHorario'] = $pedido['horaEntregaLocal'];
        array_push($pedidosAEnviar, $pedido);
    }

}


if (count($pedidosAEnviar) > 0) {
    echo $dataResponse = json_encode(array('ok' => 'true', 'data' => $pedidosAEnviar));

} else {
    echo $defaultResponse = json_encode(array('ok' => 'false'));
}

