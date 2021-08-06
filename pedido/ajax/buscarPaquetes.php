<?php
include '../../model/Producto.php';
$objProducto = new Producto();


$listaProductos = "";
if (isset($_POST['consulta'])) {
    $q = $_POST['consulta'];
    $listaProductos = $objProducto->getProductosBySearchAndTipoProducto($q, 27);

} else {
    $listaProductos = $objProducto->getProductosBySearchAndTipoProducto('', 27);
}

include '../../model/Ingrediente.php';
$objIngrediente = new Ingrediente();
$listaMakis = $objIngrediente->getIngredientesByTipo('MAKI');
$listaSashimis = $objIngrediente->getIngredientesByTipo('SASHIMI');
$listaSushis = $objIngrediente->getIngredientesByTipo('SUSHI');
$listaPlatoCaliente = $objIngrediente->getIngredientesByTipo('PLATOCALIENTE');
?>

<div class="row z-depth-2 flexColumn " id="ingredientesContainer"
     style="border: 2px solid #c23032;border-radius: 8px;margin-bottom: 15px">
    <?php foreach ($listaProductos as $producto) {
        $idSelect = uniqid();
        $idCantidadIngredientes = uniqid();
        ?>

        <div class="col s12 " style="margin-bottom: 15px">
            <div class="card white  flex-content h100">
                <div class="card-content black-text">
                    <span class="card-title"><?php echo $producto['nombreProducto'] ?></span>
                    <p><?php echo $producto['descripcionProducto'] ?></p>
                    <input type="hidden" value="<?php echo $producto['idProducto']; ?>">
                    <p>
                        <strong>S/ <?php echo $producto['precioProducto']; ?>.00</strong>
                    </p>
                </div>
                <div class="card-action mt-auto">
                    <form class="form-plato">
                        <div class="row">
                            <div class="col s6">
                                <table class="tabla-ingredientes">


                                </table>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col s4">

                                <label for="<?php echo $idSelect ?>">Selecciona los ingredientes</label>
                                <select id="<?php echo $idSelect ?>" name="cars" class="browser-default selectIngredientes">
                                    <option value="" selected>Selecciona un opcion</option>
                                    <optgroup label="MAKIS">
                                        <?php foreach ($listaMakis as $maki) { ?>
                                            <option value="<?php echo $maki['nombre'] ?>"><?php echo $maki['nombre'] ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="SASHIMI">
                                        <?php foreach ($listaSashimis as $sashimi) { ?>
                                            <option value="<?php echo $sashimi['nombre'] ?>"><?php echo $sashimi['nombre'] ?></option>
                                        <?php } ?>

                                    </optgroup>
                                    <optgroup label="SUSHIS">
                                        <?php foreach ($listaSushis as $sushi) { ?>
                                            <option value="<?php echo $sushi['nombre'] ?>"><?php echo $sushi['nombre'] ?></option>
                                        <?php } ?>

                                    </optgroup>
                                    <optgroup label="PLATOS CALIENTES">
                                        <?php foreach ($listaPlatoCaliente as $plato) { ?>
                                            <option value="<?php echo $plato['nombre'] ?>"><?php echo $plato['nombre'] ?></option>
                                        <?php } ?>

                                    </optgroup>
                                </select>
                            </div>
                            <div class="col s4">
                                <div class=" browser-default col s6">
                                    <input value="1" min="1" id="<?php echo $idCantidadIngredientes ?>" type="number"
                                           class="validate cantidadIngrediente"
                                           autocomplete="off"
                                    >
                                    <label for="<?php echo $idCantidadIngredientes ?>">Cantidad</label>
                                </div>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in chkFlambeado" />
                                        <span>¿flambeado?</span>
                                    </label>
                                </p>


                            </div>
                            <div class="col s4">
                                <button
                                        style="margin-top: 22px;"
                                        class="btn btn-flat btn-small btnAddIngrediente" type="button">
                                    <i class="material-icons">control_point</i>
                                </button>
                            </div>
                        </div>


                        <div class="row" style="margin-top: 15px">

                            <div class="col s12 center-align">
                                <hr>

                                <input class="idProducto" type="hidden" name="id"
                                       value="<?php echo $producto['idProducto'] ?>">

                                <div class="" style="margin-top: 15px">
                                    <button onclick="changeQty(this,'minus')"
                                            class="btn btn-small btn-flat grey" type="button">
                                        <i class="material-icons">remove</i>
                                    </button>
                                    <input style="width: 30%;" required onkeypress="return solonumeros(event);"
                                           type="number"
                                           minlength="1" class="cantidad center-align "
                                           min="1" name="cantidad" value="1" placeholder="Cantidad"
                                    >
                                    <button onclick="changeQty(this,'add')"
                                            type="button" class="btn btn-small btn-flat grey">
                                        <i class="material-icons">add</i>

                                    </button>

                                </div>
                                <button class="btn btn4 btn-lg btn-comprar">
                                    Comprar
                                </button>
                            </div>

                        </div>


                    </form>

                </div>
            </div>
        </div>
    <?php } ?>

</div>
<script>
    $('.form-plato').submit(function (event) {

        event.preventDefault();
        let form = this;

        let id = form.querySelector('.idProducto').value;
        let button = form.querySelector('.btn-comprar');
        let cantidad = form.querySelector('.cantidad').value;
        let data = new FormData();



        let ingredientesElement = form.querySelector('.tabla-ingredientes').getElementsByTagName('input');


        let infoSeleccionados = '';
        for (let index = 0; index < ingredientesElement.length; ++index) {
           infoSeleccionados +=  ingredientesElement[index].dataset.nombreingrediente + ` (X${ingredientesElement[index].value})`+ ', ';
        }




        data.append('id', id);
        data.append('cantidad', cantidad);
        data.append('action', 'addToCart');
        data.append('productoIngredientes', infoSeleccionados);
        button.disabled = true;
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

           window.location.href = 'paquetes?code=success';

        }).catch(function (error) {
            Swal.fire({
                title: 'Error !',
                text: 'Error de conexión, verifica si tu dispositivo esta conectado a internet',
                icon: 'error',
                onAfterClose: () => window.location.reload()
            });


        });
        console.log();
        return false;
    });

</script>
<script>


    function solonumeros(e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;

        return /\d/.test(String.fromCharCode(keynum));
    }

    function changeQty(value, param) {
        const parent = value.parentElement;
        let add = parent.childNodes[3];
        if (param === 'add') {
            add.value = parseInt(add.value) + 1;
        }
        if (param === 'minus') {
            if (parseInt(add.value) > 1) {
                add.value = parseInt(add.value) - 1;
            } else {
            }
        }
    }

    $('.form-plato').submit(function (event) {
        event.preventDefault();
    });
    $('.selectIngredientes').selectize({
        sortField: 'text'
    });

    document.getElementById('ingredientesContainer').addEventListener('click', function (e) {


        if (!e.target.classList.contains('btnAddIngrediente')) {
            return false;
        }
        const padre = e.target.parentElement.parentElement;

        if (padre.querySelector('.item') === null) {
            alert("tienes que seleccionar un ingrediente");
            return false;
        }

        let nombreIngrediente = padre.querySelector('.item').innerText;
        let cantidad = padre.querySelector('.cantidadIngrediente').value;
        let chkFlambeado = padre.querySelector('.chkFlambeado').checked;

        if (chkFlambeado){
            nombreIngrediente += ' - flambeado';
        }


        let elementoAgregar = crearElementoIngrediente(cantidad, nombreIngrediente);

        const table = e.target.parentElement.parentElement.parentElement.querySelector('table');
        /*table.append(elementoAgregar);*/
        table.innerHTML += `<tr><td>${nombreIngrediente}</td><td>${elementoAgregar}</td></tr>`;


    });

    function crearElementoIngrediente(cantidad, nombreIngrediente) {



        let elementoAgregar = document.createElement('input');
        elementoAgregar.setAttribute('type', 'number');
        elementoAgregar.setAttribute('value', cantidad);
        elementoAgregar.setAttribute('readonly', true);
        elementoAgregar.setAttribute('data-nombreingrediente', nombreIngrediente);

        return elementoAgregar.outerHTML;
    }
</script>


