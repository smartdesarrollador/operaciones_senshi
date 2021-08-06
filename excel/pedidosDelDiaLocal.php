<?php
date_default_timezone_set('America/Lima');
$actualDate = date('d-m-Y');
require_once "../vendor/autoload.php";

include '../model/Pedido.php';
include '../model/EstadoPedido.php';
include '../model/Horario.php';
include '../model/Helper.php';

$helper = new Helper();
$objPedido = new Pedido();
$objHorario = new Horario();
$objEstadoPedido = new EstadoPedido();
$listaEstadosPedido = $objEstadoPedido->getEstadoPedidos();
$listaHorarios = $objHorario->getAllHorarios();

$actualDate = date('Ymd');

if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];
    $pedidos = $objPedido->getPedidosLocalByDate($selectedDate);

} elseif (isset($_GET['code'])) {
    $code = $_GET['code'];
    if ($code == 'limit50') {

        if (isset($_GET['filter'])) {
            if ($_GET['filter'] = 'pending') {

                $pedidos = $objPedido->getPedidosLocalLimit50Pending();

            } else {
                $pedidos = $objPedido->getPedidosLocalLimit50();

            }

        } else {
            $pedidos = $objPedido->getPedidosLocalLimit50();

        }


    }

} else {
    $pedidos = $objPedido->getPedidosLocalByDate($actualDate);
}


$htmlSheetContent = '';


foreach ($pedidos as $pedido) {

    $itemsPedido = '';
    foreach ($objPedido->getPedidosItemsByidPedido($pedido['idPedido']) as $items) {
        $itemsPedido .= '**'.strtolower($items['nombreProducto']) . '(X' . $items['cantidad'] . ')' . '- S/. ' .
            $items['precioProducto'] * $items['cantidad'] . ' ' .  $items['item_descripcion'];
    }


    /*{$pedido['fechaEnvio']}*/
    $htmlSheetContent .= "
     <tr>
    <td>{$pedido['nombre']}</td>
    <td>{$pedido['apellido']}</td>
    <td>{$pedido['pedidoTelefono']}</td>
    <td>$itemsPedido</td>
    <td>{$pedido['distrito']}</td>
    <td>{$pedido['direccionPedido']}</td>
    <td>{$pedido['pedidoObservaciones']}</td>
    <td>{$pedido['medio']}</td>
    <td>{$pedido['nombreDriver']}</td>
    <td>{$pedido['horaEntregaLocal']}</td>
     <td>{$pedido['adicionalEnvioLocal']}</td>

  </tr>
    ";
}
$htmlString = '<table >
  <tr>
    <th>Cliente</th>
    <th>Apellido</th>
    <th>Telefono</th>
    <th>Pedido</th>
    <th>Distrito</th>
    <th>Direccion</th>
    <th>Obs</th>
    <th>Medio de Pago</th>
    <th>Driver</th>
    <th>Hora Entrega</th>
    <th>Adicional motorizado</th>
  </tr>
 ' . $htmlSheetContent . '
  
</table>';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($htmlString);

$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_LIGHTGRAY)
    ->getStartColor()->setRGB('000000');

$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Excel.xlsx"');
header('Cache-Control: max-age=0');


$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

$writer->save('php://output');
exit;

