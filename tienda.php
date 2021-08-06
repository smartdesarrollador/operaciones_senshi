<?php
session_start();
$page = 'store';
error_reporting(0);
if (isset($_SESSION["current_email"]) && $_SESSION["current_email"] != '') {

} else {
    header('HTTP/1.1 301 Moved Permanently');
    header('location: ./');
    exit();
}

if ($_SESSION['current_rol'] == 'admin') {

} else {
    header('Location: unauthorized');
    exit();
}

include 'model/Tienda.php';
include 'model/Horario.php';
require_once 'model/Driver.php';
$objHorario = new Horario();
$objTienda = new Tienda();
$tienda = $objTienda->getStoreStatus();
$objDriver = new Driver();
$drivers = $objDriver->getAllDrivers();

$listaHorarios = $objHorario->getAllHorarios();


$estado = $tienda['estado'];
$costoDelivery = trim($objTienda->getCostoEnvio()['costoDelivery']);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>.::Dashboard::.</title>
    <?php include 'layout/library.php' ?>


    <style>
        .switch label {
            font-weight: 900;
        }

        .switchHorario {
            padding-top: 10px;
        }
        .colAddHorario{
         padding-top: 15px !important;
        }

        .horarioCollection {
            display: flex;
            justify-content: space-around
        }
    </style>
</head>
<body class="">
<?php include 'layout/userNavBar.php' ?>
<div class="container" style="margin-bottom: 80px">
    <div class="row">
        <div class="col l4 s12 m4 xl4 push-l4 push-l4 push-xl4 push-xl4 push-m4 pull-m4 z-depth-5 "
             style="border-radius: 5px; border: 3px solid black;margin-top: 30px">
            <h5 class="center-align">Estado de la Tienda</h5>

            <!-- Switch -->
            <?php if ($estado == 'CERRADO') { ?>
                <div class="switch center-align " style="margin-top: 100px;margin-bottom: 100px">
                    <label>
                        CERRADO
                        <input onclick="return confirm('Estas Seguro?');" id="chkTiendaStatus" type="checkbox" class="">
                        <span class="lever"></span>
                        ABIERTO
                    </label>
                </div>
            <?php } ?>
            <?php if ($estado == 'ABIERTO') { ?>
                <div class="switch center-align " style="margin-top: 100px;margin-bottom: 100px">
                    <label>
                        CERRADO
                        <input onclick="return confirm('Estas Seguro?');" checked id="chkTiendaStatus" type="checkbox"
                               class="">
                        <span class="lever"></span>
                        ABIERTO
                    </label>
                </div>
            <?php } ?>
        </div>
    </div>

    <!--<div class="row">
        <div class="col l4 s12 m4 xl4 push-l4 push-l4 push-xl4 push-xl4 push-m4 pull-m4 z-depth-5  "
             style="border-radius: 5px; border: 3px solid black;margin-top: 30px">
            <h5 class="center-align">Costo de Delivery</h5>

            <form action="script/updateDeliveryCost.php" method="post">


                <div class="row">
                    <div class="col s12 m12 xl12 l12 center-align">
                        S/
                        <div class="input-field inline ">

                            <input name="costoEnvio" value="<?php /*echo $costoDelivery; */?>"
                                   onkeypress="return solonumeros()" required
                                   id="first_name" type="number" class="validate center-align">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 s12 xl12 m12 center-align">
                        <button type="submit" class="waves-effect waves-light btn-large black"
                                style="margin-bottom: 20px"><i
                                    class="material-icons right">save</i>Guardar
                        </button>

                    </div>
                </div>

            </form>

        </div>
    </div>-->

    <div class="row">
        <div class="col l4 s12 m4 xl4 push-l4 push-l4 push-xl4 push-xl4 push-m4 pull-m4 z-depth-5  "
             style="border-radius: 5px; border: 3px solid black;margin-top: 30px">
            <h5 class="center-align">Horarios</h5>

            <ul class="collection">
                <?php foreach ($listaHorarios as $horario) { ?>
                    <li class="collection-item horarioCollection" style="">
                        <p><?php echo $horario['descripcionHorario'] ?></p>
                        <div class="switch switchHorario" style="">
                            <label>
                                NO
                                <input class="chkHorario" disabled="disabled"
                                       data-id="<?php echo $horario['idHorario'] ?>" <?php echo ($horario['estado'] == 'ACTIVO') ? 'checked' : ''; ?>
                                       type="checkbox">
                                <span class="lever"></span>
                                SI
                            </label>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <hr>
            <form action="script/addHorario.php" method="post">
                <div class="row">
                    <div class="input-field col s8">
                        <input disabled="disabled" name="descripcion" required minlength="2" placeholder="Descripcion horario" id="first_name" type="text" class="validate">
                        <label for="first_name">Agregar Horario</label>
                    </div>
                    <div class="col s4 colAddHorario center-align">
                        <button disabled="disabled" type="submit" class="btn black white-text btn-flat">
                            <i class="material-icons">
                                add
                            </i></button>
                    </div>
                </div>
            </form>


            <div class="row" style="margin-bottom: 15px">
                <div class="col s12 center-align">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col l4 s12 m4 xl4 push-l4 push-l4 push-xl4 push-xl4 push-m4 pull-m4 z-depth-5  "
             style="border-radius: 5px; border: 3px solid black;margin-top: 30px">
            <h5 class="center-align">DRIVERS</h5>
            <ul class="collection">
                <?php foreach ($drivers as $driver) { ?>
                    <li class="collection-item avatar">
                        <i class="material-icons circle red">moped</i>
                        <h6 class="title"><?php echo $driver['nombre'] ?></h6>

                        <a href="driver?id=<?php echo $driver['idDriver'] ?>" class="secondary-content red-text"><i
                                    class="material-icons">send</i></a>
                    </li>
                <?php } ?>

            </ul>

        </div>
    </div>
</div>
<?php include 'layout/userFooter.php' ?>
<script>
    $('#chkTiendaStatus').change(function () {
        setTimeout(cambiarEstado, 300);

    });

    function cambiarEstado() {
        window.location = 'script/changeStoreStatus.php';
    }

    function solonumeros(e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;

        return /\d/.test(String.fromCharCode(keynum));
    };


    $(".chkHorario").on("click", function (e) {
        var checkbox = $(this);
        var url = "ajax/changeHorarioStatus.php";
        var id = $(this).attr("data-id");


        if (checkbox.is(":checked")) {

            var estado = "ACTIVO";
            var datos = {id: id, estado: estado};
            console.log(datos);
            $.post(url, datos, function (data) {
                console.log(data);
            }).fail(function () {
                alert("Se produjo un error, Verifica tu conexión a internet");
                location.reload();
            });
        } else {
            var estado = "INACTIVO";
            var datos = {id: id, estado: estado};
            console.log(datos);
            $.post(url, datos, function (data) {
                console.log(data);
            }).fail(function () {
                alert("Se produjo un error, Verifica tu conexión a internet");
                location.reload();
            });
        }

    });

</script>

<?php
if (isset($_GET['code'])) {
    if ($_GET['code'] == 'success') { ?>
        <script>M.toast({html: 'Correcto! Se ha Actualizado la Tienda!'})</script>
        <?php
    }
}

if (isset($_SESSION['code'])) {
    if ($_SESSION['code'] == 'success') {
        unset($_SESSION['code']);
        ?>
        <script>M.toast({html: 'Correcto! Horario agregado correctamente'})</script>
        <?php
    }
}
?>
</body>
</html>
