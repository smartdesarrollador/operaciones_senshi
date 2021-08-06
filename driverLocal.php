<?php
session_start();
$page = 'store';
if (isset($_SESSION["current_email"]) && $_SESSION["current_email"] != '') {

} else {
    header('HTTP/1.1 301 Moved Permanently');
    header('location: ./');
    exit();
}

if ($_SESSION['current_rol'] == 'admin' || $_SESSION['current_rol'] == 'cajero') {

} else {
    echo "No tienes Permisos para acceder a este lugar";
    exit();
}
include './model/Driver.php';
include './model/Pedido.php';
$objDriver = new Driver();
$objPedido = new Pedido();
$id = trim($_GET['id']);
$driver = $objDriver->getDriver($id);


date_default_timezone_set('America/Lima');
$actualDate = date('Ymd');

if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];
    $pedidos = $objPedido->getPedidosByDriverAndFechaPedidoLocal($id, $selectedDate);

} else {
    $pedidos = $objPedido->getPedidosByDriverLocal($id);
}
$precioTotal = 0;
$totalCostoEnvio = 0;
$totalAdicional = 0;

foreach ($pedidos as $pedido) {
    $precioTotal += $pedido['precioTotal'];
    $totalCostoEnvio += intval($pedido['costoEnvioLocal']);
    $totalAdicional += intval($pedido['adicionalEnvioLocal']);
}


$total = count($pedidos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>.::Dashboard::.</title>
    <?php include 'layout/library.php' ?>

    <script src="js/dashboardHead.js"></script>


    <style>
        .switch label {
            font-weight: 900;
        }

        .active {
            font-weight: bolder;
        }
    </style>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css"


          href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>


    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>


</head>
<body class="">
<?php include 'layout/userNavBar.php' ?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s6"><a href="driver?id=<?php echo $id ?>">WEB</a></li>
                <li class="tab col s6"><a class="active" href="#">WHATSAPP</a></li>

            </ul>
        </div>
    </div>
    <div class="row" style="padding: 0 20px 20px 20px !important;margin-top: 30px">
        <div class="col l4 push-l4 pull-l4 s12 center-align z-depth-4"
             style="border-radius:5px;border: 2px solid black">
            <h6>Driver: <?php echo $driver['nombre'] ?></h6>
            <?php
            if (isset($_GET['date'])) {
                $selectedDate = $_GET['date'];
                echo '<h6 style="font-weight: 900"><u>' . $selectedDate . '</u></h6>';
            } else {
                ?>
                <h6 id="" style="font-weight: 900">Todos los pedidos</h6>

                <?php
            }
            ?>

            <label><strong>FILTRAR</strong></label>
            <select class="browser-default" onchange="filtrar(this.value)">
                <option value="" disabled selected>Elige un Opción</option>
                <option value="1">POR FECHA</option>
                <option value="3">TODOS</option>

            </select>
            <input type="text" id="fecha" class="datepicker">

        </div>
    </div>

    <div class="row" style="padding: 0 20px 20px 20px !important;margin-top: 30px">
        <div class="col s12">
            <p>nombre: <strong><?php echo $driver['nombre'] ?></strong></p>
            <p>Total de Pedidos en esta lista: <strong><?php echo $total ?></strong></p>
            <p>Monto: S/. <strong><?php echo $precioTotal ?></strong></p>
            <p>Total Costo Envio: S/. <strong><?php echo $totalCostoEnvio ?></strong></p>
            <p>Total Adicional: S/. <strong><?php echo $totalAdicional ?></strong></p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 80px">
        <div class="col s12">

            <table id="feedBackTable" class="nowrap" style="width: 100%">
                <thead>
                <tr>

                    <th>#</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Precio Total</th>

                </tr>
                </thead>

                <tbody>
                <?php foreach ($pedidos as $pedido) { ?>
                    <tr>
                        <td><?php echo $pedido['idPedido'] ?></td>
                        <td><?php echo $pedido['fechaPedido'] ?></td>
                        <td><?php echo $pedido['nombreEstado'] ?></td>
                        <td><?php echo $pedido['precioTotal'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'layout/userFooter.php' ?>


<script>
    function filtrar(value) {
        if (value == 1) {
            $('.datepicker').datepicker('open');
        }
        if (value == 3) {
            window.location = `driverLocal?id=<?php echo $id ?>`

        }


    }

    let hoy = new Date();
    let dd = hoy.getDate();

    $(document).ready(function () {
        $('.datepicker').hide();

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
                window.location = `driverLocal?date=${fechaActual}&id=<?php echo $id ?>`

            },
            format: 'yyyymmdd',
            i18n: {
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                weekdaysAbbrev: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                clear: 'Limpiar',
                done: 'Ok',
                cancel: 'Cancelar'
            },
            max: true
        });

    });

    $(document).ready(function () {


        $('#feedBackTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            responsive: true,
            "pageLength": 30,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });


    });

</script>

</body>
</html>
