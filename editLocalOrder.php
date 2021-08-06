<?php
session_start();
$page = 'dashboard';
error_reporting(0);
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
include 'model/Pedido.php';
$objPedido = new Pedido();

$idPedido = trim($_GET['id']);

$pedido = $objPedido->getPedidoLocalByID($idPedido)

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>.::Dashboard::.</title>
    <?php include 'layout/library.php' ?>
    <style>
        .p-20 {
            padding: 20px !important;
        }

        .font-weight-bold {
            font-weight: bold !important;
        }
    </style>
</head>
<body class="">
<?php include 'layout/userNavBar.php' ?>
<div class="container" style="margin-bottom: 80px">


    <div class="row">
        <div class="col l6 s12 m8 xl6 push-l3 push-l3 push-xl3 push-xl3 push-m2 pull-m2 z-depth-5 p-20"
             style="border-radius: 5px; border: 3px solid black;margin-top: 30px">
            <h5 class="center-align">Editar Orden</h5>
            <hr>
            <form action="#" id="formEditarOrden" method="post">
                <div class="row">
                    <div class="col s12">
                        <h6 class="red-text font-weight-bold">Pedido</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">

                        <label for="direccionPedido">Dirección Pedido</label>
                        <input id="direccionPedido" type="text" value="<?php echo $pedido['direccionPedido'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">

                        <label for="pedidoObservaciones">Observaciones</label>
                        <input id="pedidoObservaciones" type="text"
                               value="<?php echo $pedido['pedidoObservaciones'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <label for="pedidoTelefono">Teléfono</label>
                        <input id="pedidoTelefono" type="text" value="<?php echo $pedido['pedidoTelefono'] ?>">
                    </div>
                    <div class="input-field col s6">
                        <label for="referencia">Referencia</label>
                        <input id="referencia" type="text" value="<?php echo $pedido['distrito'] ?>">
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <label for="fechaEnvio">Fecha Envío</label>
                        <input id="fechaEnvio" type="date" value="<?php echo $pedido['fechaEnvio'] ?>">
                    </div>
                </div>


                <div class="row">
                    <div class="col s12">
                        <h6>Horario de entrega</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">

                        <input id="fechaEnvio" type="time"
                               value="<?php echo ($pedido['horaEntregaLocal'] != 'AHORITA') ? $pedido['horaEntregaLocal'] : '' ?>">
                    </div>

                    <div class="input-field col s6">
                        <p>
                            <label>
                                <input
                                    <?php echo ($pedido['horaEntregaLocal'] == 'AHORITA') ? 'checked' : '' ?>
                                        value="AHORITA" name="horarioEntrega" type="checkbox" class="filled-in"/>
                                <span><strong>AHORITA</strong></span>
                            </label>
                        </p>
                    </div>
                </div>

                <div class="row" style="margin-top: 40px">
                    <div class="col s12 center-align">
                        <button class="black white-text btn btn-large">ACTUALIZAR</button>
                    </div>

                </div>


            </form>

        </div>
    </div>

</div>
<?php include 'layout/userFooter.php' ?>
<script>
    let formEditarOrden = document.getElementById('formEditarOrden');
    let direccionPedido = document.getElementById('direccionPedido');
    let pedidoObservaciones = document.getElementById('pedidoObservaciones');

    formEditarOrden.addEventListener('submit', (event) => {
        event.preventDefault();
        console.log(this);

    })

</script>


</body>
</html>
