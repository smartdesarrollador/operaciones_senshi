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

if ($_SESSION['current_rol'] == 'admin' || $_SESSION['current_rol'] == 'cajero_san_borja') {
} else {
    echo "No tienes Permisos para acceder a este lugar";
    exit();
}
include 'class/Cart.php';
$cart = new Cart();
$itemsCarrito = $cart->contents();

require_once '../model/Tienda.php';

$objTienda2 = new Tienda();
$addConstoEnvio = $objTienda2->getCostoEnvio()['costoDelivery'];
require_once '../model/Driver.php';
require_once '../model/Ingrediente.php';
require_once '../model/Horario.php';
$objHorario = new Horario();
$objDriver = new Driver();
$horarios = $objHorario->getAllHorarios();
$drivers = $objDriver->getAllDrivers();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>.::Dashboard::.</title>
    <?php include 'shared/library.php' ?>
    <link rel="stylesheet" href="../css/loading.css">
    <link rel="stylesheet" href="../css/pedido.css">

</head>

<body class="">


    <div>
        <ul id="slide-out" class="sidenav sidenav-fixed">
            <li>
                <div class="user-view">
                    <div class="background black">
                    </div>
                    <a href="#user"><img class="circle" src="../img/logoMain.png"></a>
                    <span class="white-text name">Hola, <?= $_SESSION["current_fullName"] ?></span>
                    <a class="waves-effect waves-light btn">Local San Borja</a>
                    <span class="white-text email">Genera tu pedido ahora</span>
                </div>
            </li>
            <li>
                <a href="../" class="btn btn-flat white black-text"> <i class="material-icons">arrow_back</i>VOLVER</a>
            </li>
            <li><a href="pedido">Platos </a></li>
            <li><a href="paquetes">Paquetes </a></li>
            <li><a href="#!" class="grey">Sushi <i class="material-icons right">
                        label_important
                    </i></a></li>


            <li style="margin-top: 50px">

                <label onclick="window.location='utils/cambiarMetodoDeEnvio.php?code=recojo'">
                    <input class="with-gap" name="group3" <?php echo ($_SESSION['envio'] == 'recojo') ? 'checked' : '' ?> type="radio" />
                    <span> <i class="material-icons md-36">store_mall_directory</i> Recojo</span>
                </label>
                <label onclick="window.location='utils/cambiarMetodoDeEnvio.php?code=reparto'">
                    <input <?php echo ($_SESSION['envio'] !== 'recojo') ? 'checked' : '' ?> class="with-gap" name="group3" type="radio" />
                    <span><i class="material-icons md-36">two_wheeler</i> Delivery</span>
                </label>

            </li>

            <li>
                <a href="#carrito" class="btn red modal-trigger">
                    REALIZAR PEDIDO (<?php echo $cart->total_items() ?>)</a>
            </li>
        </ul>
        <div style="display: flex;justify-content: space-between" class="hide-on-lg-and-up">
            <!--<a href="#" data-target="slide-out" class="btn btn-flat red sidenav-trigger white-text" style="margin-top: 5px;margin-left: 5px">
            <i class="material-icons">menu</i>
        </a>-->
            <a href="../dashboardLocal.php" class="btn btn-flat red  white-text"><i class="material-icons">
                    home
                </i></a>
            <ul class="tabs">
                <li class="tab col s3"><a href="pedido">PLATOS</a></li>
                <li class="tab col s3"><a href="paquetes">PAQUETES</a></li>
                <li class="tab col s3"><a href="#" class="red-text" style="font-weight: bolder">SUSHI</a></li>
            </ul>
            <a href="#carrito" class="btn  red modal-trigger " style="margin-top: 5px;margin-right: 5px;line-height: 18px;">
                REALIZAR PEDIDO (<?php echo $cart->total_items() ?>)</a>
        </div>
    </div>

    <main>

        <div class="row " style="margin-bottom: 0;">
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12 m6 xl8 l8">
                        <input autocomplete="off" placeholder="BUSCAR PLATO" id="caja_busqueda" type="text" class="validate">
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col s12" style="padding: 25px">
                <div id="datos"></div>
            </div>
        </div>
    </main>


    <!-- Modal Structure -->
    <div id="carrito" class="modal">
        <div class="modal-content">
            <table class="centered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($itemsCarrito as $itemCarrito) { ?>
                        <tr>
                            <td><?php echo $itemCarrito['name'] ?> <br>
                                <small><?php echo $itemCarrito['productoIngredientes'] ?></small> <br>
                                <small><?php echo $itemCarrito['observacionesPaquete'] ?></small>

                            </td>
                            <td>
                                <a onclick="mostrarLoading()" href="script/cartAction.php?action=updateCartItem&id=<?php echo $itemCarrito['rowid']; ?>&qty=<?php echo $itemCarrito['qty'] - 1; ?>">
                                    <i class="material-icons left">remove</i></a>
                                <?php echo $itemCarrito['qty']; ?>
                                <a onclick="mostrarLoading()" href="script/cartAction.php?action=updateCartItem&id=<?php echo $itemCarrito['rowid']; ?>&qty=<?php echo $itemCarrito['qty'] + 1; ?>">
                                    <i class="material-icons right">add</i></a>

                            </td>
                            <td>S/<?php echo $itemCarrito['subtotal']; ?></td>
                            <td><a onclick="mostrarLoading()" class="btn btn-flat btn-small red white-text" href="script/cartAction.php?action=removeCartItem&id=<?php echo $itemCarrito['rowid']; ?>">
                                    <i class="material-icons">delete</i></a></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <div class="row">
                <div class="col s12">
                    <hr>

                    <h6>Total: S/.<?php echo $cart->total() ?></h6>
                </div>
            </div>

            <div class="row" style="margin-top: 30px">
                <div class="col s12">
                    <label>
                        <input id="seleccionarRecojoElement" class="with-gap" name="tipoEnvio" value="recojo" type="radio" />
                        <span> <i class="material-icons md-36">store_mall_directory</i> Recojo</span>
                    </label>
                    <label>
                        <input id="seleccionarDeliveryElement" value="delivery" class="with-gap" name="tipoEnvio" type="radio" />
                        <span><i class="material-icons md-36">two_wheeler</i> Delivery</span>
                    </label>
                </div>
            </div>
            <div class="row">

                <form action="script/checkout.php" class="col s12" method="post" id="formGenerarPedidoRecojo">
                    <h5>Ingresa los datos del cliente</h5>

                    <input name="direccion" id="direccion" type="hidden" value="-">
                    <input name="distrito" id="distrito" type="hidden" value="-">
                    <input name="referencia" id="referencia" type="hidden" value="-">

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea name="descripcion" id="descripcion" type="text" class="validate materialize-textarea"></textarea>
                            <label for="descripcion">Descripcion</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input required name="nombre" id="nombre" type="text" class="validate">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input required name="apellido" id="apellido" type="text" class="validate">
                            <label for="apellido">Apellido</label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input name="correo" id="correo" type="text" class="validate">
                            <label for="correo">Correo</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="fechaNacimiento" id="fechaNacimiento" type="date" class="validate">
                            <label for="fechaNacimiento">Fecha Naciemiento</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="celular" id="celular" type="text" class="validate">
                            <label for="celular">Celular</label>
                        </div>
                        <div class="input-field col s6">
                            <input required name="fechaEnvio" id="fechaEnvio" type="date" class="validate">
                            <label for="fechaEnvio">Fecha de Envio</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <h5>Horario de entrega</h5>
                            <p>
                                <label>
                                    <input id="ahoritaRecojoElement" value="AHORITA" name="horarioEntrega" type="radio" required />
                                    <span><strong>AHORITA</strong></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input id="horarioEntregaRecojoElement" value="SELECCIONAR" name="horarioEntrega" type="radio" />
                                    <span><strong>SELECCIONAR</strong></span>
                                </label>
                            </p>
                        </div>

                        <div class="col s6" id="horarioEntregaContainer">
                            <div class="input-field col s12">
                                <input id="horarioEntregaSeleccionado" type="time" name="horarioEntregaSeleccionado">
                                <label for="horarioEntregaSeleccionado">Horario de Entrega</label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <select name="medioDePago">
                                <option disabled selected>Elije el medio de pago</option>
                                <option value="YAPE">YAPE</option>
                                <option value="PLIN">PLIN</option>
                                <option value="BCP">BCP</option>
                                <option value="INTERBANK">INTERBANK</option>
                                <option value="BBVA">BBVA</option>
                                <option value="SCOTIABANK">SCOTIABANK</option>
                                <option value="INTERBANCARIO">INTERBANCARIO</option>
                                <option value="EFECTIVO">EFECTIVO</option>
                                <option value="TARJETA">TARJETA</option>

                            </select>
                            <label>Elije el medio de pago</label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col s12">
                            <h5>¿Boleta o factura?</h5>
                            <p>
                                <label>
                                    <input id="boletaElementRecojo" class="documentoRecojo" value="boleta" name="documento" type="radio" required />
                                    <span><strong>BOLETA</strong></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input id="facturaElementRecojo" class="documentoRecojo" value="factura" name="documento" type="radio" />
                                    <span><strong>FACTURA</strong></span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row" id="boletaContainerRecojo">
                        <div class="input-field col s6">
                            <input name="dni" id="dniInput" type="text" class="validate">
                            <label for="dniInput">DNI</label>
                        </div>


                    </div>

                    <div class="row" id="facturaContainerRecojo">
                        <div class="input-field col s6">
                            <input name="ruc" id="rucInput" type="text" class="validate">
                            <label for="rucInput">RUC</label>
                        </div>

                        <div class="input-field col s6">
                            <input name="razon_social" id="razSocialInput" type="text" class="validate">
                            <label for="razSocialInput">Razón social</label>
                        </div>

                        <div class="input-field col s6">
                            <input name="direccion_fiscal" id="dirFiscal" type="text" class="validate">
                            <label for="dirFiscal">Dirección fiscal</label>
                        </div>


                    </div>

                    <input type="hidden" value="3" name="driver">
                    <input type="hidden" value="-" name="costoEnvio">
                    <input type="hidden" value="-" name="adicionalEnvio">

                    <div class="right-align" style="padding: 20px">
                        <a href="#!" class="modal-close " style="margin-right: 10px">Seguir comprando</a>
                        <button type="submit" <?php echo ($cart->total() <= 0) ? 'disabled' : ''; ?> class="btn red white-text">Generar Pedido
                        </button>
                    </div>
                </form>

                <form action="script/checkout.php" class="col s12" method="post" id="formGenerarPedidoDelivery">

                    <h5>Ingresa los datos del cliente</h5>

                    <div class="row">
                        <div class="input-field col s6">
                            <input required name="direccion" id="direccionDelivery" type="text" class="validate">
                            <label for="direccionDelivery">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input required name="distrito" id="distritoDelivery" type="text" class="validate">
                            <label for="distritoDelivery">Distrito</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="referencia" id="referenciaDelivery" type="text" class="validate">
                            <label for="referenciaDelivery">Referencia</label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea name="descripcion" id="descripcionDelivery" type="text" class="validate materialize-textarea"></textarea>
                            <label for="descripcionDelivery">Descripcion</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input required name="nombre" id="nombreDelivery" type="text" class="validate">
                            <label for="nombreDelivery">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input required name="apellido" id="apellidoDelivery" type="text" class="validate">
                            <label for="apellidoDelivery">Apellido</label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input name="correo" id="correoDelivery" type="text" class="validate">
                            <label for="correoDelivery">Correo</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="fechaNacimiento" id="fechaNacimientoDelivery" type="date" class="validate">
                            <label for="fechaNacimientoDelivery">Fecha Naciemiento</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input required name="celular" id="celularDelivery" type="text" class="validate">
                            <label for="celularDelivery">Celular</label>
                        </div>
                        <div class="input-field col s6">
                            <input required name="fechaEnvio" id="fechaEnvioDelivery" type="date" class="validate">
                            <label for="fechaEnvioDelivery">Fecha de Envio</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <h5>Horario de entrega</h5>
                            <p>
                                <label>
                                    <input id="ahoritaElementDelivery" value="AHORITA" name="horarioEntrega" type="radio" required />
                                    <span><strong>AHORITA</strong></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input id="horarioEntregaElementDelivery" value="SELECCIONAR" name="horarioEntrega" type="radio" />
                                    <span><strong>SELECCIONAR</strong></span>
                                </label>
                            </p>
                        </div>

                        <div class="col s6" id="horarioEntregaContainerDelivery">
                            <div class="input-field col s12">
                                <input id="horarioEntregaSeleccionadoDelivery" type="time" name="horarioEntregaSeleccionado">
                                <label for="horarioEntregaSeleccionadoDelivery">Horario de Entrega</label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <select name="medioDePago">
                                <option disabled selected>Elije el medio de pago</option>
                                <option value="YAPE">YAPE</option>
                                <option value="PLIN">PLIN</option>
                                <option value="BCP">BCP</option>
                                <option value="INTERBANK">INTERBANK</option>
                                <option value="BBVA">BBVA</option>
                                <option value="SCOTIABANK">SCOTIABANK</option>
                                <option value="INTERBANCARIO">INTERBANCARIO</option>
                                <option value="EFECTIVO">EFECTIVO</option>
                                <option value="TARJETA">TARJETA</option>

                            </select>
                            <label>Elije el medio de pago</label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col s12">
                            <h5>¿Boleta o factura?</h5>
                            <p>
                                <label>
                                    <input id="boletaElementDelivery" class="" value="boleta" name="documento" type="radio" required />
                                    <span><strong>BOLETA</strong></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input id="facturaElementDelivery" class="" value="factura" name="documento" type="radio" />
                                    <span><strong>FACTURA</strong></span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row" id="boletaContainerDelivery">
                        <div class="input-field col s6">
                            <input name="dni" id="dniInputDelivery" type="text" class="validate">
                            <label for="dniInputDelivery">DNI</label>
                        </div>


                    </div>

                    <div class="row" id="facturaContainerDelivery">
                        <div class="input-field col s6">
                            <input name="ruc" id="rucInputDelivery" type="text" class="validate">
                            <label for="rucInputDelivery">RUC</label>
                        </div>

                        <div class="input-field col s6">
                            <input name="razon_social" id="razSocialInputDelivery" type="text" class="validate">
                            <label for="razSocialInputDelivery">Razón social</label>
                        </div>

                        <div class="input-field col s6">
                            <input name="direccion_fiscal" id="dirFiscalDelivery" type="text" class="validate">
                            <label for="dirFiscalDelivery">Dirección fiscal</label>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col s12">
                            <h5>Elije el Driver</h5>

                            <?php foreach ($drivers as $driver) { ?>
                                <p>
                                    <label>
                                        <input value="<?php echo $driver['idDriver'] ?>" name="driver" type="radio" required />
                                        <span><strong><?php echo $driver['nombre'] ?></strong></span>
                                    </label>
                                </p>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input onClick="this.select();" value="4" min="1" name="costoEnvio" id="costoEnvioDelivery" type="number" class="validate">
                            <label for="costoEnvioDelivery">Pago al motorizado</label>
                        </div>
                        <div class="input-field col s4">
                            <input onClick="this.select();" min="0" value="0" name="adicionalEnvio" id="adicionalEnvioDelivery" type="number" class="validate">
                            <label for="adicionalEnvioDelivery">Adicional motorizado</label>
                        </div>
                        <div class="input-field col s4">
                            <input required onClick="this.select();" min="0" value="0" name="envioPagado" step="any" id="envioPagadoDelivery" type="number" class="validate">
                            <label for="envioPagadoDelivery">Envio Pagado</label>
                        </div>
                    </div>

                    <div class="right-align" style="padding: 20px">
                        <a href="#!" class="modal-close " style="margin-right: 10px">Seguir comprando</a>
                        <button type="submit" <?php echo ($cart->total() <= 0) ? 'disabled' : ''; ?> class="btn red white-text">Generar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <?php include 'shared/userFooter.php' ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let elems = document.querySelectorAll('.sidenav');
            let instances = M.Sidenav.init(elems);
            document.getElementById('fechaEnvio').valueAsDate = new Date();
            document.getElementById('fechaEnvioDelivery').valueAsDate = new Date();
        });
        //BUSQUEDA
        $(buscar_datos());

        function buscar_datos(consulta) {

            $.ajax({
                    url: 'ajax/buscarSushis.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        consulta: consulta
                    },
                    beforeSend: function() {
                        $("#datos").html(
                            "\n" +
                            " <div class='row center-align' style='margin-top: 22%'>" +
                            "  <div class=\"preloader-wrapper center-align big active\">\n" +
                            "    <div class=\"spinner-layer spinner-blue-only\">\n" +
                            "      <div class=\"circle-clipper left\">\n" +
                            "        <div class=\"circle\"></div>\n" +
                            "      </div><div class=\"gap-patch\">\n" +
                            "        <div class=\"circle\"></div>\n" +
                            "      </div><div class=\"circle-clipper right\">\n" +
                            "        <div class=\"circle\"></div>\n" +
                            "      </div>\n" +
                            "    </div>\n" +
                            "  </div></div>");
                    },
                })
                .done(function(respuesta) {
                    $("#datos").html(respuesta);
                })
                .fail(function() {
                    console.log("error");
                });


        }

        $(document).on('keyup', '#caja_busqueda', function() {

            var valor = $(this).val();
            if (valor != "") {
                buscar_datos(valor);
            } else {
                buscar_datos();
            }

        });

        $(document).ready(function() {
            /* var elems = document.querySelectorAll('.modal');*/
            $('#modalReparto').modal();
            $('#carrito').modal();
            <?php
            if ($_GET['code'] == 'success') {

            ?>
                $('#carrito').modal();
                $('#carrito').modal('open');

            <?php
            }
            ?>
        });
    </script>
    <script>
        let tipoDocumento = '';

        let formGenerarPedidoRecojo = document.getElementById('formGenerarPedidoRecojo');
        let formGenerarPedidoDelivery = document.getElementById('formGenerarPedidoDelivery');

        let seleccionarRecojoElement = document.getElementById('seleccionarRecojoElement');
        let seleccionarDeliveryElement = document.getElementById('seleccionarDeliveryElement');


        let horarioEntregaContainer = document.getElementById('horarioEntregaContainer');

        let boletaElementRecojo = document.getElementById('boletaElementRecojo');
        let facturaElementRecojo = document.getElementById('facturaElementRecojo');


        let ahoritaRecojoElement = document.getElementById('ahoritaRecojoElement');
        let horarioEntregaRecojoElement = document.getElementById('horarioEntregaRecojoElement');

        let boletaContainerRecojo = document.getElementById('boletaContainerRecojo');
        let facturaContainerRecojo = document.getElementById('facturaContainerRecojo');


        seleccionarRecojoElement.addEventListener('click', function() {
            if (this.checked === true) {
                formGenerarPedidoRecojo.style.display = 'block';
                formGenerarPedidoDelivery.style.display = 'none';
            }
        });
        seleccionarDeliveryElement.addEventListener('click', function() {
            if (this.checked === true) {
                formGenerarPedidoDelivery.style.display = 'block';
                formGenerarPedidoRecojo.style.display = 'none';
            }
        });


        /* RECOJO EN TIENDA*/
        facturaContainerRecojo.style.display = 'none';
        boletaContainerRecojo.style.display = 'none';
        horarioEntregaContainer.style.display = 'none';
        formGenerarPedidoRecojo.style.display = 'none';
        formGenerarPedidoDelivery.style.display = 'none';

        boletaElementRecojo.addEventListener('click', function() {
            if (this.checked === true) {
                facturaContainerRecojo.style.display = 'none';
                boletaContainerRecojo.style.display = 'block';
                tipoDocumento = 'BOLETA';
            }
        });
        facturaElementRecojo.addEventListener('click', function() {
            if (this.checked === true) {
                facturaContainerRecojo.style.display = 'block';
                boletaContainerRecojo.style.display = 'none';
                tipoDocumento = 'FACTURA';
            }
        });

        ahoritaRecojoElement.addEventListener('click', function() {
            if (this.checked === true) {
                horarioEntregaContainer.style.display = 'none';

            }
        });
        horarioEntregaRecojoElement.addEventListener('click', function() {
            if (this.checked === true) {
                horarioEntregaContainer.style.display = 'block';

            }
        });
        /* END RECOJO EN TIENDA*/


        document.addEventListener('DOMContentLoaded', function() {


        });


        formGenerarPedidoRecojo.addEventListener('submit', function(event) {

            this.appendChild(seleccionarRecojoElement);
            this.appendChild(seleccionarDeliveryElement);

        });

        let ahoritaElementDelivery = document.getElementById('ahoritaElementDelivery');
        let horarioEntregaElementDelivery = document.getElementById('horarioEntregaElementDelivery');
        let horarioEntregaContainerDelivery = document.getElementById('horarioEntregaContainerDelivery');

        let boletaElementDelivery = document.getElementById('boletaElementDelivery');
        let facturaElementDelivery = document.getElementById('facturaElementDelivery');

        let boletaContainerDelivery = document.getElementById('boletaContainerDelivery');
        let facturaContainerDelivery = document.getElementById('facturaContainerDelivery');


        boletaContainerDelivery.style.display = 'none';
        facturaContainerDelivery.style.display = 'none';
        horarioEntregaContainerDelivery.style.display = 'none';


        ahoritaElementDelivery.addEventListener('click', function() {
            if (this.checked === true) {
                horarioEntregaContainerDelivery.style.display = 'none';

            }
        });
        horarioEntregaElementDelivery.addEventListener('click', function() {
            if (this.checked === true) {
                horarioEntregaContainerDelivery.style.display = 'block';

            }
        });

        boletaElementDelivery.addEventListener('click', function() {
            if (this.checked === true) {
                boletaContainerDelivery.style.display = 'block';
                facturaContainerDelivery.style.display = 'none';
                tipoDocumento = 'BOLETA';
            }
        });
        facturaElementDelivery.addEventListener('click', function() {
            if (this.checked === true) {
                boletaContainerDelivery.style.display = 'none';
                facturaContainerDelivery.style.display = 'block';
                tipoDocumento = 'FACTURA';
            }
        });

        formGenerarPedidoDelivery.addEventListener('submit', function(event) {

            this.appendChild(seleccionarRecojoElement);
            this.appendChild(seleccionarDeliveryElement);

        });
        <?php if (isset($_SESSION['mensaje'])) {
            if ($_SESSION['mensaje'] == 'success') {
        ?>
                Swal.fire(
                    'Correcto!',
                    'Se generó el nuevo pedido!',
                    'success'
                );
        <?php
            }
            unset($_SESSION['mensaje']);
        }

        ?>
    </script>
</body>

</html>