<?php
date_default_timezone_set('America/Lima');
$actualDate = date('d-m-Y');
require_once "../vendor/autoload.php";

include '../model/Pedido.php';

$objPedido = new Pedido();


$actualDate = date('Ymd');

$pedidos = $objPedido->reporteDriver($actualDate);


$htmlSheetContent = '';


foreach ($pedidos as $pedido) {

    $totalPagoMotorizado = intval($pedido['adicionalEnvioLocal']) + intval($pedido['costoEnvioLocal']);
    $restante = intval($pedido['costoEnvioPagado']) - $totalPagoMotorizado;
    $costoEnvioPagado = intval($pedido['costoEnvioPagado']);
    /*{$pedido['fechaEnvio']}*/
    $htmlSheetContent .= "
     <tr>
    <td>{$pedido['nombreDriver']}</td>
    <td>{$pedido['direccionPedido']}</td>
    <td>{$pedido['precioTotal']}</td>
    <td>$costoEnvioPagado</td>
    <td>{$pedido['costoEnvioLocal']}</td>
    <td>{$pedido['adicionalEnvioLocal']}</td>
    <td>$totalPagoMotorizado</td>
    <td>$restante</td>


  </tr>
    ";
}
$htmlString = '<table >
  <tr>
    <th>DRIVER</th>
    <th>DIRECCION PEDIDO</th>
    <th>TOTAL PEDIDO</th>
    <th>PAGO DEL CLIENTE</th>
    <th>PAGO BASE MOTORIZADO</th>
    <th>PAGO ADICIONAL ADICIONAL</th>
    <th>PAGO TOTAL MOTORIZADO</th>
    <th>RESTANTE</th>
    
  </tr>
 ' . $htmlSheetContent . '
  
</table>';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($htmlString);

$spreadsheet->getActiveSheet()->getStyle('A1:H1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_LIGHTGRAY)
    ->getStartColor()->setRGB('000000');

$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte-motorizados-'.$actualDate.'.xlsx"');
header('Cache-Control: max-age=0');


$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

$writer->save('php://output');
exit;

