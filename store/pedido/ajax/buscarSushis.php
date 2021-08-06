<?php
include '../../model/Producto.php';
$objProducto = new Producto();


$listaProductos = "";
if (isset($_POST['consulta'])) {
    $q = $_POST['consulta'];
    $listaProductos = $objProducto->getProductosBySearchAndTipoProducto($q, 31);

} else {
    $listaProductos = $objProducto->getProductosBySearchAndTipoProducto('', 31);
}

require '../../model/Ingrediente.php';
$objProductoIngrediente = new Ingrediente();
$listaIngredientes = $objProductoIngrediente->getAllIngredientes();
?>
<div class="row z-depth-2 flexColumn" style="border: 2px solid #c23032;border-radius: 8px;margin-bottom: 15px">
    <?php foreach ($listaProductos as $producto) { ?>

        <div class="col s12 m6" style="margin-bottom: 15px">
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
                            <div class="col s7">
                                <input class="idProducto" type="hidden" name="id"
                                       value="<?php echo $producto['idProducto'] ?>">


                                <?php if ($producto['productoObservaciones'] == 'SUSHI_SIN_FLAMBEADO') { ?>
                                <?php } else { ?>
                                    <div><strong>¿ flambeado ? + S/. 2</strong></div>
                                <?php } ?>
                                <?php foreach ($listaIngredientes as $ingrediente) {

                                    if ($ingrediente['idProducto'] == $producto['idProducto']) {
                                        $uniqueIdIng = uniqid();
                                        ?>

                                        <p>
                                            <label>
                                                <input name="radioIngrediente"
                                                       value="<?php echo $ingrediente['nombre'] ?>"
                                                       id="<?php echo $uniqueIdIng ?>"
                                                       type="radio"/>
                                                <span><?php echo $ingrediente['nombre'] ?></span>
                                            </label>
                                        </p>


                                        <?php
                                    }
                                } ?>


                                <div class="">
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
                            </div>
                            <div class="col s5">
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

        let chkIngredientes = form.querySelector('input[name="radioIngrediente"]:checked');


        data.append('id', id);
        data.append('cantidad', cantidad);
        data.append('action', 'addToCart');

        if (chkIngredientes) {
            let ingredientes = chkIngredientes.value;
            data.append('productoIngredientes', "Flambeado con " + ingredientes + ", ");
            data.append('adicional', '2');
        }


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
            window.location.href = 'sushi?code=success';
            button.disabled = false;

        }).catch(function (error) {
            Swal.fire({
                title: 'Error !',
                text: 'Error de conexión, verifica si tu dispositivo esta conectado a internet',
                icon: 'error',
                onAfterClose: () => window.location.reload()
            });


        });
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


</script>


