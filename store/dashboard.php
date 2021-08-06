<?php
session_start();
error_reporting(0);
$page = 'dashboard';
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


include 'model/Pedido.php';
include 'model/EstadoPedido.php';
include 'model/Horario.php';
include 'model/Helper.php';

$helper = new Helper();
$objPedido = new Pedido();
$objHorario = new Horario();
$objEstadoPedido = new EstadoPedido();
$listaEstadosPedido = $objEstadoPedido->getEstadoPedidos();
$listaHorarios = $objHorario->getAllHorarios();

date_default_timezone_set('America/Lima');
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

$totalVentas = 0;
$numeroDepedidosEnLista = 0;

foreach ($pedidos as $pedido) {
    $numeroDepedidosEnLista++;
    $totalVentas += $pedido['precioTotal'];

}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>.::Dashboard::.</title>
    <?php include 'layout/library.php' ?>
    <link rel="stylesheet" href="css/dashboard.css">

    <script src="js/dashboardHead.js"></script>
    <style>
        .tab {
            width: 50% !important;
        }

        .tab a {
            font-weight: bolder;
        }

        .tabs .tab a:hover, .tabs .tab a.active {
            background-color: #f44336;
            color: #ffffff;
        }
    </style>
</head>
<body>


<?php include 'layout/userNavBar.php' ?>
<div class="container animated fadeIn fast">
    <div class="row"
         style="padding:0!important; margin-bottom: 20px">
        <div class="col l12 xl12 s12 s12 m12 center-align">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#">PEDIDOS WEB</a></li>
                <li class="tab col s3"><a href="dashboardLocal.php">PEDIDOS GENERADOS</a></li>

            </ul>
        </div>

    </div>
    <div class="row" style="padding: 0 !important;margin-bottom: 25px">
        <div class="col l4"></div>
        <div class="col l4  s12 center-align z-depth-4"
             style="border-radius:5px;border: 2px solid black;padding: 0 20px 20px 20px !important;">
            <?php
            if (isset($_GET['date'])) {
                $selectedDate = $_GET['date'];
                echo '<h6 style="font-weight: 900"><u>' . $selectedDate . '</u></h6>';
            } elseif (isset($_GET['code'])) {

                echo '<h6 style="font-weight: 900"><u>Ultimos 50 pedidos</u></h6>';

            } else {
                ?>
                <h6 id="" style="font-weight: 900"><u id="fechaActual"></u></h6>
                <script>dia()</script>
                <?php
            }
            ?>

            <label><strong>FILTRAR</strong></label>
            <select class="browser-default" onchange="filtrar(this.value)">
                <option value="" disabled selected>Elige un Opción</option>
                <option value="1">POR FECHA</option>
                <option value="2">ULTIMOS 50 PEDIDOS</option>
                <option value="3">HOY</option>
                <option value="4">ULTIMOS 50 PEDIDOS PENDIENTES</option>

            </select>
            <input type="text" id="fecha" class="datepicker">


        </div>
        <div class="col l4">
            <div>
                <small><strong>Agregar pedido </strong>(ctrl + enter)</small>
                <a target="_blank" title="Agregar Pedido" href="pedido/pedido" class="btn-floating blue"><i
                            class="material-icons">add</i></a>
            </div>
            <div>
                <small>Generar excel</small>
                <?php

                if (isset($_GET['date'])) {
                    $selectedDate = $_GET['date'];
                    ?>
                    <a <?php echo ($_SESSION['current_rol'] == 'cajero_san_borja') ? 'disabled' : '' ?>
                            href="excel/pedidosDelDia.php?date=<?php echo $selectedDate; ?>" class="btn-floating red"
                            title="EXPORTAR A EXCEL">
                        <i class="material-icons">
                            description
                        </i>
                    </a>
                    <?php
                } elseif (isset($_GET['code'])) {
                    $code = $_GET['code'];

                    if ($code == 'limit50') {

                        if (isset($_GET['filter'])) {
                            if ($_GET['filter'] = 'pending') {
                                ?>
                                <a <?php echo ($_SESSION['current_rol'] == 'cajero_san_borja') ? 'disabled' : '' ?>
                                        href="excel/pedidosDelDia.php?code=limit50&filter=pending"
                                        class="btn-floating red"
                                        title="EXPORTAR A EXCEL">
                                    <i class="material-icons">
                                        description
                                    </i>
                                </a>
                                <?php

                            } else {
                                ?>
                                <a <?php echo ($_SESSION['current_rol'] == 'cajero_san_borja') ? 'disabled' : '' ?>
                                        href="excel/pedidosDelDia.php?code=limit50" class="btn-floating red"
                                        title="EXPORTAR A EXCEL">
                                    <i class="material-icons">
                                        description
                                    </i>
                                </a>
                                <?php
                            }

                        } else {
                            ?>
                            <a <?php echo ($_SESSION['current_rol'] == 'cajero_san_borja') ? 'disabled' : '' ?>
                                    href="excel/pedidosDelDia.php?code=limit50" class="btn-floating red"
                                    title="EXPORTAR A EXCEL">
                                <i class="material-icons">
                                    description
                                </i>
                            </a>
                            <?php

                        }


                    }

                } else {
                    ?>
                    <a <?php echo ($_SESSION['current_rol'] == 'cajero_san_borja') ? 'disabled' : '' ?>
                            href="excel/pedidosDelDia.php" class="btn-floating red" title="EXPORTAR A EXCEL">
                        <i class="material-icons">
                            description
                        </i>
                    </a>
                    <?php
                }
                ?>
            </div>
            <div>
                <small>Reporte del motorizado</small>
                <a
                    <?php echo ($_SESSION['current_rol'] == 'cajero_san_borja') ? 'disabled' : '' ?>
                        href="excel/reporteMotorizadoDelDia.php" class="btn-floating orange waves-effect waves-light"
                        title="Reporte del motorizado">
                    <i class="material-icons">
                        two_wheeler
                    </i>
                </a>
            </div>
        </div>
    </div>

</div>
<div class="container">
    <?php
    if (count($pedidos) > 0) {
        ?>
        <?php if ($_SESSION['current_rol'] == 'admin') { ?>
            <div style="display: flex;justify-content: space-around">
                <strong class=''>Total de ventas = S/. <?php echo $totalVentas ?></strong>
                <strong class=''># de pedidos en esta lista = <?php echo $numeroDepedidosEnLista ?></strong>
            </div>
        <?php } ?>
        <?php
        foreach ($pedidos as $pedido) { ?>


            <div class="row z-depth-2 "
                 style="border: 2px solid rgb(197, 148, 62);border-radius: 8px;margin-bottom: 15px">
                <div class="col l4 m4 s12  xl4 l4">
                    <p>
                        <strong><u># <?php echo str_pad($pedido['idPedido'], 5, "0", STR_PAD_LEFT); ?></u> /
                            <span class="text-uppercase"><?php echo $pedido['documento'] ?></span></strong>
                    </p>
                    <p>
                        Hora: <strong><?php echo $pedido['horaPedido'] ?></strong>( <?php echo $pedido['fechaPedido'] ?>
                        )
                    </p>

                    <p>
                        Nombre: <strong style="text-transform: capitalize"><?php echo $pedido['nombre'] ?></strong>
                    </p>
                    <p>
                        Apellidos: <strong style="text-transform: capitalize"><?php echo $pedido['apellido'] ?></strong>
                    </p>
                    <p>
                        Direccion: <strong><?php echo $pedido['direccionPedido'] ?>
                            / <?php echo $pedido['distrito'] ?></strong>
                    </p>
                    <p>
                        Referencia: <strong><?php echo $pedido['referencia'] ?></strong>
                    </p>
                    <p>
                        Teléfono: <strong><?php echo $pedido['pedidoTelefono'] ?></strong>
                    </p>
                    <?php
                    if ($pedido['documento'] == 'factura') {
                        ?>
                        <p>
                            RUC: <strong><?php echo $pedido['ruc'] ?></strong>
                        </p>
                        <p>
                            Dirección fiscal: <strong><?php echo $pedido['direccionFiscal'] ?></strong>
                        </p>
                        <p>
                            Razón social: <strong><?php echo $pedido['razonSocial'] ?></strong>
                        </p>
                        <?php
                    } else {
                        ?>
                        <p>
                            DNI: <strong><?php echo $pedido['clienteDni'] ?></strong>
                        </p>
                        <?php
                    }
                    ?>

                    <p>
                        Fecha de Nac: <strong><?php echo $pedido['fechaNacimiento'] ?></strong>
                    </p>

                    <p>
                        Edad: <strong><?php
                            /*$arrayFechaNacimiento = explode('-',$pedido['fechaNacimiento']);
                            $anioActual = (int) date("Y");*/
                            echo $helper->calculaedad($pedido['fechaNacimiento']);
                            ?></strong>
                    </p>

                    <p>
                        Tarjeta: <strong><?php echo $pedido['brand'] ?> - <?php echo $pedido['last_four'] ?></strong>
                    </p>
                    <p>
                        Email: <strong><?php echo $pedido['email'] ?></strong>
                    </p>

                </div>
                <div class="col l4 m4 s12  xl4 l4">
                    <p><strong><u>Observaciones:</u></strong></p>
                    <p><?php echo $pedido['pedidoObservaciones'] ?></p>
                    <p><strong><u>Contenido del Pedido:</u></strong></p>
                    <ul class="collection"
                        style="margin-bottom:  0;margin-top:0;margin-left: 5px;list-style-type: disc">
                        <?php
                        foreach ($objPedido->getPedidosItemsByidPedido($pedido['idPedido']) as $items) { ?>

                        <li class="collection-item" style="text-transform: capitalize;padding: 5px">
                            <strong> <?php echo strtolower($items['nombreProducto']) ?>
                                (X<?php echo $items['cantidad'] ?>) - S/.
                                <?php echo $items['precioProducto'] * $items['cantidad'] ?></strong><br><br>
                            <ul class="descripcionItemsPedido">
                                <li><?php echo str_ireplace(',', '<br><br>', $items['item_descripcion']) ?></li>
                            </ul>
                            <?php } ?>
                        </li>
                    </ul>

                    <p><strong><u>Horario de entrega:</u></strong></p>

                    <?php if ($pedido['delivery'] == 'true') { ?>
                        <p>
                            Fecha de entrega: <?php echo $pedido['fechaEnvio'] ?>
                        </p>

                    <?php } ?>



                    <?php
                    foreach ($listaHorarios as $horario) {
                        if ($horario['idHorario'] == $pedido['idHorario']) {
                            ?>
                            <p><?php echo $horario['descripcionHorario']; ?></p>
                            <?php
                        }
                    } ?>
                    <div class="row">
                        <div class="col s12">

                            <div class="row">
                                <div class="col s12 l12 m12 xl12 center-align">
                                    <a class="btn btn-small btn-flat grey black-text" target="_blank"
                                       href="utils/printReceipt.php?order=<?php echo $pedido['idPedido'] ?>">
                                        <i class="material-icons right">print</i>Imprimir</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col l4 m4 s12  xl4 l4">
                    <p class="center-align"><strong>TOTAL: S/ <?php echo $pedido['precioTotal'] ?></strong></p>
                    <p class="center-align"><small>Envío: S/ <?php echo $pedido['costoEnvioPagado'] ?></small></p>
                    <div class="row">
                        <div class="input-field col s12">
                            <select onchange="changeStatus(this.value,<?php echo $pedido['idPedido']; ?>)"
                                    class="browser-default <?php
                                    switch ($pedido['idEstado']) {
                                        case '0':
                                            echo "red white-text";
                                            break;
                                        case '1':
                                            echo "orange white-text";
                                            break;
                                        case '2':
                                            echo "green white-text";
                                            break;
                                        default:
                                            echo "black white-text";
                                    }

                                    ?>">


                                <option value="" disabled selected>Elije una Opcion</option>


                                <?php foreach ($listaEstadosPedido as $estado) { ?>
                                    <option <?php if ($pedido['idEstado'] == $estado['idEstado']) {
                                        echo 'selected';
                                    } ?> value="<?php echo $estado['idEstado'] ?>">

                                        <?php echo $estado['nombreEstado']; ?></option>

                                <?php } ?>


                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 center-align">
                            <?php if ($pedido['delivery'] == 'false') { ?>
                                <i class="material-icons md-48">
                                    store_mall_directory
                                </i><br>
                                <strong>Recojo en tienda</strong>
                            <?php } else { ?>
                                <i class="material-icons md-48">
                                    two_wheeler
                                </i><br>
                                <strong>Delivery</strong>
                                <?php
                                if (strlen($pedido['latitud']) > 4) {
                                    ?>
                                    <div style="margin-top: 10px">
                                        <a class=" btn-flat red-text"
                                           target="_blank"
                                           href="https://www.google.com/maps/search/?api=1&query=<?php echo $pedido['latitud']; ?>,<?php echo $pedido['longitud']; ?>"><i
                                                    class="material-icons md-48">directions</i></a>
                                    </div>
                                    <?php
                                }

                                ?>


                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        <?php }
    } else {
        ?>
        <div class="row z-depth-4 hoverable animated fadeIn slow"
             style="border: 2px solid rgb(197, 148, 62);border-radius: 8px;margin-bottom: 10px">
            <div class="col l12 m12 s12  xl12 l12 center-align">
                <h5>No hay pedidos para esta fecha </h5>
                <p>Click en la fecha mostrada arriba para ver pedidos de días anteriores.</p>
            </div>
        </div>
        <?php
    }
    ?>

</div>
<div id="vista"></div>


<script>
    let i18n = {
        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
        weekdaysAbbrev: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        clear: 'Limpiar',
        done: 'Ok',
        cancel: 'Cancelar'
    };


    function filtrar(value) {
        if (value == 1) {
            $('.datepicker').datepicker('open');
        }
        if (value == 2) {
            window.location = `dashboard?code=limit50`
        }
        if (value == 3) {
            window.location = `dashboard`

        }
        if (value == 4) {
            window.location = `dashboard?code=limit50&filter=pending`
        }

    }

    var hoy = new Date();
    var dd = hoy.getDate();

    $(document).ready(function () {
        $('.datepicker').hide();
        /*    $('.datePickerPendientes').hide();
    */
        $('.datepicker').datepicker({
            formatSubmit: 'yyyymmdd',
            onSelect: function (date) {

                var mes = date.getMonth() + 1; //obteniendo mes
                var dia = date.getDate(); //obteniendo dia
                var ano = date.getFullYear(); //obteniendo año
                if (dia < 10)
                    dia = '0' + dia; //agrega cero si el menor de 10
                if (mes < 10)
                    mes = '0' + mes //agrega cero si el menor de 10

                var fechaActual = ano + "-" + mes + "-" + dia;

                console.log(fechaActual);
                window.location = `dashboard?date=${fechaActual}`

            },
            format: 'yyyymmdd',
            i18n: i18n,
            max: true
        });

        /*  $('.datePickerPendientes').datepicker({
              formatSubmit: 'yyyymmdd',
              onSelect: function (date) {

                  var mes = date.getMonth() + 1; //obteniendo mes
                  var dia = date.getDate(); //obteniendo dia
                  var ano = date.getFullYear(); //obteniendo año
                  if (dia < 10)
                      dia = '0' + dia; //agrega cero si el menor de 10
                  if (mes < 10)
                      mes = '0' + mes //agrega cero si el menor de 10

                  var fechaActual = ano + "-" + mes + "-" + dia;

                  console.log(fechaActual);
                  window.location = `dashboard?date=${fechaActual}`

              },
              format: 'yyyymmdd',
              i18n: i18n,
              max: true
          });
  */
    });


</script>
<?php include 'layout/userFooter.php' ?>


</body>
</html>
