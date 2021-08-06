<?php
session_start();
include '../model/Producto.php';
include '../model/Producto_ingrediente.php';
$objProducto = new Producto();
$objProductoIngrediente = new Producto_ingrediente();

$producto = $objProducto->getProductoById(342);
$ingredientes = $objProductoIngrediente->getIngredientesByIdProductoAndTipo(342, 'MAKI', 'nombre');
$ingredientesSashimi = $objProductoIngrediente->getIngredientesByIdProductoAndTipo(342, 'SASHIMI', 'posicion');
$ingredientesSushis = $objProductoIngrediente->getIngredientesByIdProductoAndTipo(342, 'SUSHI', 'posicion');
$ingredientesGunkans = $objProductoIngrediente->getIngredientesByIdProductoAndTipo(342, 'GUNKAN', 'posicion');
$ingredientesPlatosCalientes = $objProductoIngrediente->getIngredientesByIdProductoAndTipo(342, 'PLATOCALIENTE', 'posicion');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Senshi - Paquete 4</title>
    <script src="https://kit.fontawesome.com/5afb46a9e0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../library/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/carta.css">
    <link rel="stylesheet" href="../css/paquetes.css">
    <style>
        .input-group-ingredientes {
            width: 100%;
        }
    </style>
</head>
<body>


<div class="container mb-5" style="margin-top:50px">

    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                    <h3><?php echo $producto['nombreProducto'] ?></h3>

                    <img class="" style="max-width: 300px" loading="lazy"
                         src="img/carta/platos/<?php echo $producto['imagenProducto'] ?>" alt="">
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <form action="script/cartAction.php" method="get" id="formComprar">
                        <div class="row mt-2">
                            <div class="col text-center">

                                <input type="hidden" name="action" value="addToCart">
                                <input type="hidden" class="idProducto" name="id"
                                       value="<?php echo $producto['idProducto'] ?>">
                                <p><?php echo $producto['descripcionProducto'] ?></p>
                                <p class="font-weight-bolder">S/. <?php echo $producto['precioProducto'] ?>.00</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 border border-dark rounded ">

                                <strong class="text-info">Escoge 1 variedad de maki</strong>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Maki</th>
                                        <th scope="col">Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody class="makisContainer">

                                    <?php foreach ($ingredientes as $ingrediente) {
                                        if ($ingrediente['estado'] == 'ACTIVO') {
                                            ?>
                                            <tr>
                                                <td><?php echo $ingrediente['nombre'] ?></td>
                                                <td>
                                                    <div class="input-group input-group-ingredientes">
                                                        <div class="input-group-prepend input-group-append">
                                                            <button onclick="changeQtyMin0(this,'minus',0,2)"
                                                                    class="btn btn-light" type="button">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input required onkeypress="return solonumeros(event);"
                                                                   type="number"
                                                                   readonly
                                                                   data-nombreIngrediente="<?php echo $ingrediente['nombre'] ?>"
                                                                   minlength="1"
                                                                   class="form-control text-center font-weight-bolder"
                                                                   min="0" name="cantidad" value="0"
                                                                   placeholder="Cantidad"
                                                                   aria-label="Cantidad"
                                                                   aria-describedby="button-addon2">
                                                            <button onclick="changeQtyMin0(this,'add',0,2)"
                                                                    type="button" class="btn btn-light">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>


                                    </tbody>
                                </table>

                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 border border-dark rounded ">


                                <strong class="text-info">Escoge 6 cortes de sashimi o 1 sashimi moriawase</strong>
                                <small class="text-danger">Máximo 4 por variedad</small>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sashimi</th>
                                        <th scope="col">Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody class="sashimisContainer" id="sashimisContainer">

                                    <?php foreach ($ingredientesSashimi as $ingrediente) {
                                        if ($ingrediente['estado'] == 'ACTIVO') {
                                            ?>
                                            <tr>
                                                <td>

                                                    <?php echo $ingrediente['nombre'] ?>


                                                </td>
                                                <td>
                                                    <div class="input-group input-group-ingredientes">
                                                        <div class="input-group-prepend input-group-append">
                                                            <button onclick="changeQtyMin0(this,'minus',0,4)"
                                                                    class="btn btn-light" type="button">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input required onkeypress="return solonumeros(event);"
                                                                   type="number"
                                                                   readonly
                                                                   data-nombreIngrediente="<?php echo $ingrediente['nombre'] ?>"
                                                                   data-obs="<?php echo $ingrediente['observaciones'] ?>"
                                                                   minlength="1"
                                                                   class="form-control text-center font-weight-bolder"
                                                                   min="0" name="cantidad" value="0"
                                                                   placeholder="Cantidad"
                                                                   aria-label="Cantidad"
                                                                   aria-describedby="button-addon2">
                                                            <button onclick="changeQtyMin0(this,'add',0,4)"
                                                                    type="button" class="btn btn-light">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    <tr>
                                        <td>SASHIMI MORIAWASE<br><small class="text-info">(A elección del
                                                itamae)</small></td>
                                        <td>
                                            <div class="input-group justify-content-center input-group-ingredientes"
                                            >
                                                <div class="text-center">
                                                    <input class="mt-2" style="transform: scale(1.5);"
                                                           id="moriawaseSashimis"
                                                           type="checkbox"
                                                           aria-describedby="button-addon2">

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 border border-dark rounded ">


                                <strong class="text-info">Escoge 8 cortes de sushi o 1 sushi moriawase</strong>
                                <table class="table  table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sushi</th>
                                        <th scope="col">Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody class="sushisContainer" id="sushisContainer">

                                    <?php foreach ($ingredientesSushis as $ingrediente) {
                                        if ($ingrediente['estado'] == 'ACTIVO') {
                                            ?>
                                            <tr>
                                                <td> <span class="m-0 p-0">
                                                      <?php echo $ingrediente['nombre'] ?>
                                                    </span>
                                                    <select onchange="addFlambeado(this)"
                                                            class="custom-select custom-select-sm bg-secondary text-white">
                                                        <option selected>¿flambeado?</option>
                                                        <option value="salsa de ostión">salsa de ostión</option>
                                                        <option value="salsa parrillera">salsa parrillera</option>
                                                        <option value="parmesano con crema picante">parmesano con crema
                                                            picante
                                                        </option>
                                                    </select></td>
                                                <td>
                                                    <div class="input-group input-group-ingredientes">
                                                        <div class="input-group-prepend input-group-append">
                                                            <button onclick="changeQtyMin0(this,'minus',0,4)"
                                                                    class="btn btn-light" type="button">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input required onkeypress="return solonumeros(event);"
                                                                   type="number"
                                                                   readonly
                                                                   data-nombreIngrediente="<?php echo $ingrediente['nombre'] ?>"
                                                                   data-obs="<?php echo $ingrediente['observaciones'] ?>"
                                                                   minlength="1"
                                                                   class="form-control text-center font-weight-bolder inputCantidadSahimis"
                                                                   min="0" name="cantidad" value="0"
                                                                   placeholder="Cantidad"
                                                                   aria-label="Cantidad"
                                                                   aria-describedby="button-addon2">
                                                            <button onclick="changeQtyMin0(this,'add',0,4)"
                                                                    type="button" class="btn btn-light">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?><?php foreach ($ingredientesGunkans as $ingrediente) {
                                        if ($ingrediente['estado'] == 'ACTIVO') {
                                            ?>
                                            <tr>
                                                <td><?php echo $ingrediente['nombre'] ?></td>
                                                <td>
                                                    <div class="input-group input-group-ingredientes">
                                                        <div class="input-group-prepend input-group-append">
                                                            <button onclick="changeQtyMin0(this,'minus',0,4)"
                                                                    class="btn btn-light" type="button">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input required onkeypress="return solonumeros(event);"
                                                                   type="number"
                                                                   readonly
                                                                   data-nombreIngrediente="<?php echo $ingrediente['nombre'] ?>"
                                                                   data-obs="<?php echo $ingrediente['observaciones'] ?>"
                                                                   minlength="1"
                                                                   class="form-control text-center font-weight-bolder"
                                                                   min="0" name="cantidad" value="0"
                                                                   placeholder="Cantidad"
                                                                   aria-label="Cantidad"
                                                                   aria-describedby="button-addon2">
                                                            <button onclick="changeQtyMin0(this,'add',0,4)"
                                                                    type="button" class="btn btn-light">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    <tr>
                                        <td>SUSHI MORIAWASE<br><small class="text-info">(A elección del
                                                itamae)</small></td>
                                        <td>
                                            <div class="input-group justify-content-center input-group-ingredientes"
                                                 style="">
                                                <div class="text-center">
                                                    <input class="mt-2" style="transform: scale(1.5);"
                                                           id="sushiMoriawase"
                                                           type="checkbox"
                                                           aria-describedby="button-addon2">

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 border border-dark rounded ">

                                <strong class="text-info">Escoge 1 plato caliente</strong>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Plato</th>
                                        <th scope="col">Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody class="platosCalientesContainer">

                                    <?php foreach ($ingredientesPlatosCalientes as $ingrediente) {
                                        if ($ingrediente['estado'] == 'ACTIVO') {
                                            ?>
                                            <tr>
                                                <td><?php echo $ingrediente['nombre'] ?></td>
                                                <td>
                                                    <div class="input-group input-group-ingredientes">
                                                        <div class="input-group-prepend input-group-append">
                                                            <button onclick="changeQtyMin0(this,'minus',0,1)"
                                                                    class="btn btn-light" type="button">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input required onkeypress="return solonumeros(event);"
                                                                   type="number"
                                                                   readonly
                                                                   data-nombreIngrediente="<?php echo $ingrediente['nombre'] ?>"
                                                                   minlength="1"
                                                                   class="form-control text-center font-weight-bolder"
                                                                   min="0" name="cantidad" value="0"
                                                                   placeholder="Cantidad"
                                                                   aria-label="Cantidad"
                                                                   aria-describedby="button-addon2">
                                                            <button onclick="changeQtyMin0(this,'add',0,1)"
                                                                    type="button" class="btn btn-light">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col col-md-12">
                                <input placeholder="OBSERVACIONES" id="observacionesPaquete" type="text" class="observacionesPaquete">
                                <label for="observacionesPaquete">OBSERVACIONES</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    <strong class="text-info">Cantidad</strong>
                                    <div class="input-group mb-3 d-inline ">
                                        <div class="input-group-prepend input-group-append m-auto" style="width: 300px">
                                            <button onclick="changeQty(this,'minus')"
                                                    class="btn btn4" type="button">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input required onkeypress="return solonumeros(event);"
                                                   type="number"
                                                   minlength="1" class="form-control text-center cantidad"
                                                   min="1" name="cantidad" value="1" placeholder="Cantidad"
                                                   aria-label="Cantidad"
                                                   aria-describedby="button-addon2">
                                            <button onclick="changeQty(this,'add')"
                                                    type="button" class="btn btn4">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn4 btn-lg btn-comprar mt-2">COMPRAR
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="far fa-check-circle"></i> Producto
                    agregado al carrito</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-footer">
                <a href="#" data-dismiss="modal">Seguir comprando</a>
                <a href="paquetes?code=success" class="btn btn-danger">VER ORDEN</a>
            </div>
        </div>
    </div>
</div>

<script src="../library/js/jquery-3.4.1.min.js"></script>
<script src="../library/js/popper.min.js"></script>
<script src="../library/js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    //flambeado
    function addFlambeado(dropDrown) {

        let inputCantidad = dropDrown.parentElement.parentElement.querySelector('.inputCantidadSahimis');
        let oldAttributte = inputCantidad.getAttribute('data-nombreIngrediente');

        let value = dropDrown.value;
        let elemento = dropDrown.parentElement.firstElementChild;
        let flambeadoElement = document.createElement('small');
        flambeadoElement.textContent = 'flambeado con ' + value;

        elemento.append(flambeadoElement);
        inputCantidad.setAttribute('data-nombreIngrediente', oldAttributte + ' flambeado con ' + value);


        dropDrown.style.display = 'none';
    }

    //END  flambeado


    $(document).ready(function () {
        let sashimisContainer = document.getElementById('sashimisContainer');

        $('#moriawaseSashimis').click(function () {
            if ($(this).prop("checked") == true) {
                $('#sashimisContainer').find('button').attr('disabled', 'disabled');
                $('#sashimisContainer').find('input[type=number]').val(0);
            } else if ($(this).prop("checked") == false) {
                $('#sashimisContainer').find('button').attr('disabled', false);

            }
        });

        $('#sushiMoriawase').click(function () {
            if ($(this).prop("checked") == true) {

                $('#sushisContainer').find('button').attr('disabled', 'disabled');
                $('#sushisContainer').find('input[type=number]').val(0);
            } else if ($(this).prop("checked") == false) {

                $('#sushisContainer').find('button').attr('disabled', false);

            }
        });
    });


    $('#formComprar').submit(function (event) {
        event.preventDefault();
        let infoSeleccionados = '';
        let totalSeleccionadoMaki = 0;


        /*
        * MAKIS
        * */
        $('.makisContainer input[type=number]').each(function () {
            let cantidad = ($(this).val() * 1);
            totalSeleccionadoMaki += cantidad;
            if (cantidad > 0) {
                infoSeleccionados = infoSeleccionados + $(this).attr("data-nombreIngrediente") + ` (X${cantidad})` + ', ';

            }
        });
        if (totalSeleccionadoMaki !== 1) {
            Swal.fire(
                'Puedes elegir como máximo 1 variedades de maki',
                '',
                'error'
            );
            infoSeleccionados = '';
            totalSeleccionadoMaki = 0;
            return false;
        }
        /*
        * END MAKIS
        * */
        /*
        * SASHIMIS
        * */
        if ($('#moriawaseSashimis').prop("checked") == true) {
            infoSeleccionados = infoSeleccionados + 'SASHIMI MORIAWASE' + ', ';

        } else {
            let totalSeleccionadoSashimi = 0;
            $('.sashimisContainer input[type=number]').each(function () {

                let cantidad = ($(this).val() * 1);
                totalSeleccionadoSashimi += cantidad;
                if (cantidad > 0) {
                    infoSeleccionados = infoSeleccionados + $(this).attr("data-nombreIngrediente") + ` (X${cantidad})` + ', ';
                }
            });

            if (totalSeleccionadoSashimi !== 6) {
                Swal.fire(
                    'Puedes elegir como máximo 6 variedades de sashimi o 6 sashimis de una misma variedad',
                    '',
                    'error'
                );
                infoSeleccionados = '';
                totalSeleccionadoSashimi = 0;
                return false;
            }

        }

        /*
                * END SASHIMIS
                * */

        /*
       * Sushis
       * */
        if ($('#sushiMoriawase').prop("checked") == true) {
            infoSeleccionados = infoSeleccionados + 'SUSHI MORIAWASE' + ', ';

        } else {
            let totalSeleccionadoSushis = 0;
            $('.sushisContainer input[type=number]').each(function () {

                let cantidad = ($(this).val() * 1);
                totalSeleccionadoSushis += cantidad;
                if (cantidad > 0) {
                    infoSeleccionados = infoSeleccionados + $(this).attr("data-nombreIngrediente") + ` (X${cantidad})` + ', ';
                }
            });

            if (totalSeleccionadoSushis !== 8) {
                Swal.fire(
                    'Puedes elegir como máximo 8 variedades de sushis o 8 sushis de una misma variedad',
                    '',
                    'error'
                );
                infoSeleccionados = '';
                totalSeleccionadoSushis = 0;
                return false;
            }

        }
        /*
                * END SUSHIS
                * */

        /*PLATOS CALIENTES*/

        let platosCalientesContainer = 0;
        $('.platosCalientesContainer input[type=number]').each(function () {

            let cantidad = ($(this).val() * 1);
            platosCalientesContainer += cantidad;
            if (cantidad > 0) {
                infoSeleccionados = infoSeleccionados + $(this).attr("data-nombreIngrediente") + ` (X${cantidad})` + ', ';
            }
        });

        if (platosCalientesContainer !== 1) {
            Swal.fire(
                'Puedes elegir 1 plato caliente',
                '',
                'error'
            );
            infoSeleccionados = '';
            platosCalientesContainer = 0;
            return false;
        }

        /*END CALIENTES*/

        /*let campo = '<input type="hidden"   name="productoIngredientes" value="' + infoSeleccionados + '" />';
        $(this).append(campo);*/

        let formulario = this;
        let id = formulario.querySelector('.idProducto').value;
        let button = formulario.querySelector('.btn-comprar');
        let cantidad = formulario.querySelector('.cantidad').value;

        let observacionesPaquete = formulario.querySelector('.observacionesPaquete').value;
        let data = new FormData();
        button.disabled = true;

        data.append('id', id);
        data.append('cantidad', cantidad);
        data.append('action', 'addToCart');

        data.append('productoIngredientes', infoSeleccionados);
        data.append('observacionesPaquete', observacionesPaquete);

        fetch('script/cartAction.php', {
            method: 'POST',
            body: data
        }).then(function (response) {
            if (response.ok) {
                return response.text();
            } else {
                alert("Error de conexión, verifica si tu dispositivo esta conectado a internet");
                window.location.reload();
            }
        }).then(function (response) {
            $('#exampleModal').modal('show');
            button.disabled = false;

        }).catch(function (error) {
            alert("Error de conexión, verifica si tu dispositivo esta conectado a internet");
        });

    })
</script>

</body>
</html>
