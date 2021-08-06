<?php
session_start();
error_reporting(0);
if (isset($_SESSION["current_email"]) && $_SESSION["current_email"] != '') {
} else {
    header('HTTP/1.1 301 Moved Permanently');
    header('location: ./');
    exit();
}
if ($_SESSION['current_rol'] == 'admin' || $_SESSION['current_rol'] == 'cajero_san_borja') {

} else {
    header('HTTP/1.1 301 Moved Permanently');
    header('location: ./');
    exit();
}
include '../model/Pedido.php';
$objPedido = new Pedido();
include '../model/Helper.php';

include '../model/Horario.php';
$objHorario = new Horario();

$helper = new Helper();
include '../model/Tienda.php';

$objTienda = new Tienda();

$costoDelivery = trim($objTienda->getCostoEnvio()['costoDelivery']);

$idPedido = $_GET['order'];
$pedido = $objPedido->getPedidoByID(trim($idPedido));
$items = $objPedido->getPedidosItemsByidPedido(trim($idPedido));
$listaHorarios = $objHorario->getAllHorarios();


?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido</title>
    <style>
        * {
            font-weight: bolder;
        }

        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;

            width: 44mm;
            background: #FFF;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: 1em;
        }

        #invoice-POS h3 {
            font-size: 1.3em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: .6em;
            color: black;
            line-height: 1.2em;
        }

        #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: .6em;
            background: #EEE;
        }

        #invoice-POS .tableitem {
            padding: 0;
            margin: 0;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: .6em;
        }

        #invoice-POS #legalcopy {
            margin-top: 1mm;
        }

        @media print {
            .buttons {
                display: none;
            }
        }
    </style>
</head>
<body>

<div id="invoice-POS">
    <div id="mid">
        <div class="info">
            <h2 style="text-align: center;margin-top: 0;margin-bottom: 0">Senshi - Delivery</h2>
            <p>

                Pedido Nro: #<?php echo str_pad($pedido['idPedido'], 8, "0", STR_PAD_LEFT); ?></br>
                Hora y fecha: <strong><?php echo $pedido['horaPedido'] ?>( <?php echo $pedido['fechaPedido'] ?>
                    )</strong></br>
                Dirección: <strong><?php echo $pedido['direccionPedido'] ?></strong></br>
                Nombres: <strong><?php echo $pedido['nombre'] ?></strong></br>
                Apellidos: <strong><?php echo $pedido['apellido'] ?></strong></br>

                <?php
                if ($pedido['documento'] == 'factura') {
                    ?>
                    RUC: <strong><?php echo $pedido['ruc'] ?></strong></br>
                    Dirección fiscal: <strong><?php echo $pedido['direccionFiscal'] ?></strong></br>
                    Razón social: <strong><?php echo $pedido['razonSocial'] ?></strong></br>
                    <?php
                } else {
                    ?>
                    DNI: <strong><?php echo $pedido['DNI'] ?></strong></br>
                    <?php
                }
                ?>


                Celular: <strong><?php echo $pedido['pedidoTelefono'] ?></strong></br>
                Correo: <strong><?php echo $pedido['email'] ?></strong></br>
                Fec Nacimiento: <strong><?php echo $pedido['fechaNacimiento'] ?></strong></br>
                Tarjeta: <strong><?php echo $pedido['brand'] ?></strong></br>
                Reparto: <strong><?php if ($pedido['delivery'] == 'false') {
                        echo 'Recojo en tienda';
                    } else {
                        echo 'Delivery';
                    } ?></strong>
            </p>
        </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item"><h2 style="padding: 0;margin: 0">Producto</h2></td>
                    <td class="Hours"><h2 style="padding: 0;margin: 0">Cantidad</h2></td>
                    <td class="Rate"><h2 style="padding: 0;margin: 0">SubTotal</h2></td>
                </tr>

                <?php foreach ($items as $item) { ?>
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext">
                                <?php echo '<strong>' . $item['nombreProducto'] . ':</strong><br>';

                                if ($item['item_descripcion'] != '') {
                                    echo '<br><strong>' . str_ireplace(',','<br>',strtolower($item['item_descripcion'])) . '</strong>';
                                }

                                ?>
                            </p></td>
                        <td class="tableitem"><p class="itemtext"><?php echo $item['cantidad'] ?></p></td>
                        <td class="tableitem"><p class="itemtext">S/. <?php echo $item['precioProducto']*$item['cantidad'] ?></p></td>
                    </tr>

                <?php } ?>

                <?php if ($pedido['delivery'] == 'true') { ?>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2>Delivery</h2></td>
                        <td class="payment"><h2>S/. <?php echo $pedido['costoEnvioPagado'] ?></h2></td>
                    </tr>
                <?php } ?>
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate"><h2>Total</h2></td>
                    <td class="payment"><h2>S/. <?php echo $pedido['precioTotal'] ?></h2></td>
                </tr>

            </table>
        </div><!--End Table-->

        <div id="legalcopy">
            <p class="legal" style="margin: 0 !important;">
                <?php echo $pedido['pedidoObservaciones'] ?>
            </p>
        </div>
        <div style="font-size: 1.2em;font-weight: bolder">
            <p style="margin: 0;">
                Fecha de entrega: <?php echo $pedido['fechaEnvio'] ?>
            </p>
            <?php
            foreach ($listaHorarios as $horario) {
                if ($horario['idHorario'] == $pedido['idHorario']) {
                    ?>
                    <p style="margin: 0"><?php echo $horario['descripcionHorario']; ?></p>
                    <?php
                }
            } ?>
        </div>


    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
<div class="buttons" style="text-align: center">
    <button style="padding: 30px;font-size: 25px" onclick="window.print()">IMPRIMIR</button>
</div>

</body>
</html>
