<?php
session_start();
header('Content-Type: application/json');
include '../../model/Producto.php';
$objProducto = new Producto();


$listaProductos = "";
if (isset($_REQUEST['consulta'])) {
    $q = $_REQUEST['consulta'];
    $listaProductos = $objProducto->getPlatosNormales($q);

} else {
    $listaProductos = $objProducto->getPlatosNormales();
}

echo json_encode(['ok' => 'true', 'data' => $listaProductos]);
