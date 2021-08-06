<?php
session_start();
error_reporting(0);
include '../class/Cart.php';

if ($_REQUEST['code'] == 'recojo') {
    $_SESSION['envio'] = 'recojo';
}
if ($_REQUEST['code'] == 'reparto') {
    $_SESSION['envio'] = 'reparto';
}

$cart = new Cart();
$cart->save_cart();

?>
<script>
    window.location = '../pedido';
</script>


