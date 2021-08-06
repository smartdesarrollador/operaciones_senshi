<?php
date_default_timezone_set('America/Lima');
$actualDate = date('d-m-Y');
require_once "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    $pedidos = $objPedido->getPedidosByDate($selectedDate);

} elseif (isset($_GET['code'])) {
    $code = $_GET['code'];
    if ($code == 'limit50') {

        if (isset($_GET['filter'])) {
            if ($_GET['filter'] = 'pending') {

                $pedidos = $objPedido->getPedidosLimit50Pending();

            } else {
                $pedidos = $objPedido->getPedidosLimit50();

            }

        } else {
            $pedidos = $objPedido->getPedidosLimit50();

        }


    }

} else {
    $pedidos = $objPedido->getPedidosByDate($actualDate);
}


$htmlSheetContent = '';


foreach ($pedidos as $pedido) {
    $horarioPedido = '';
    $itemsPedido = '';
    foreach ($objPedido->getPedidosItemsByidPedido($pedido['idPedido']) as $items) {
        $itemsPedido .= '**'.strtolower($items['nombreProducto']) . '(X' . $items['cantidad'] . ')' . '- S/. ' .
            $items['precioProducto'] * $items['cantidad'] . ' ' .  $items['item_descripcion'];
    }
    foreach ($listaHorarios as $horario) {
        if ($horario['idHorario'] == $pedido['idHorario']) {

          $horarioPedido = $horario['descripcionHorario'];

        }
    }

    /*{$pedido['fechaEnvio']}*/
    $htmlSheetContent .= "
     <tr>
    <td>{$pedido['nombre']}</td>
    <td>{$pedido['pedidoTelefono']}</td>
    <td>$itemsPedido</td>
    <td></td>
    <td>$horarioPedido</td>
    <td>{$pedido['distrito']}</td>
    <td>{$pedido['direccionPedido']}</td>
    <td>{$pedido['pedidoObservaciones']}</td>
    <td>Web</td>
    <td>Andres</td>
  </tr>
    ";
}
$htmlString = '<table >
  <tr>
    <th>Cliente</th>
    <th>Telefono</th>
    <th>Pedido</th>
    <th>Hora despacho</th>
    <th>Rango de horario</th>
    <th>Distrito</th>
    <th>Direccion</th>
    <th>Obs</th>
    <th>Medio de Pago</th>
    <th>Driver</th>
  </tr>
 ' . $htmlSheetContent . '
  
</table>';

$demoHtml = '<table style="width:100%">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
  </tr>
</table>';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($htmlString);

$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_LIGHTGRAY)
    ->getStartColor()->setRGB('000000');

$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Excel.xlsx"');
header('Cache-Control: max-age=0');


$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

$writer->save('php://output');
exit;

