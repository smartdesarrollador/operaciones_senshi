<div id="modalNotificacion" class="modal">
    <div class="modal-content">
        <h5>Los siguientes pedidos estan pendientes de atender</h5>
        <table id="tablaNotificacion">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha Envio</th>
                    <th>Fecha pedido</th>
                    <th>Hora pedido</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">OK</a>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $(".dropdown-trigger").dropdown({
            constrainWidth: false,
            coverTrigger: false
        });

        $('#modalNotificacion').modal();
    });

    $(document).ready(function() {
        $('select').formSelect();


        document.onkeyup = function(e) {
            if (e.ctrlKey && e.key === 'Enter') {
                /*window.location = './pedido/pedido';*/
                let win = window.open('./pedido/pedido', '_blank');
                win.focus();


            }
        };


    });
</script>
<script type="text/javascript" src="library/js/materialize.js"></script>
<script type="text/javascript" src="library/js/sweetalert2.min.js"></script>
<script>
    Notification.requestPermission().then(function(result) {});

    function NotificationAPI() {

        var options = {
            body: "Tienes un nuevo pedido",
            icon: 'img/logoMain.png',
        };

        var n = new Notification('SENSHI - DELIVERY', options);
        setTimeout(n.close.bind(n), 5000);
        n.onclick = function() {
            window.open('https://operaciones.cevicheriarichards.com/dashboard');
        };

    }


    var sound = document.getElementById("myAudio");
    var notificationSound = document.getElementById("notificationSound");

    function playAudio() {
        sound.play();
    }

    function pauseAudio() {
        sound.pause();
    }

    function refreshPedidos() {
        $.ajax({
            url: "ajax/updatePedidos.php",
            success: function(data) {
                if (data == actualPedidos) {
                    console.log("Ejecutandose");
                } else {

                    Swal.fire({
                        title: 'NUEVO PEDIDO!',
                        text: 'Tienes un Nuevo Pedido',
                        imageUrl: 'img/notificacion.jpg',
                        imageWidth: 400,
                        imageAlt: 'Custom image',
                        onAfterClose: redirigir
                    });

                    playAudio();
                    actualPedidos = data;
                    NotificationAPI();


                }
            }
        });
    }

    function redirigir() {
        location.reload();
    }

    let actualPedidos;
    $(document).ready(function() {
        $.ajax({
            url: "ajax/updatePedidos.php",
            success: function(data) {

                actualPedidos = data;
                console.log(actualPedidos);
            },
            complete: function() {
                var interval = setInterval('refreshPedidos()', 5000);

            }
        });

        setInterval('notification()', 900000);
        /*etInterval('notification()', 5000);*/
    });

    /*
     * NOTIFICACION 1HORA ANTES
     * */
    function notification() {
        fetch('ajax/notifications.php')
            .then(function(response) {

                return response.json();
            })
            .then(function(myJson) {


                if (myJson.ok === 'false') {
                    console.log('notification running')
                }
                if (myJson.ok === 'true') {
                    mostrarNotificacion(myJson.data);
                }

            });
    }


    function mostrarNotificacion(data) {
        let tabla = document.querySelector('#tablaNotificacion tbody');
        tabla.innerHTML = '';
        for (var i = 0; i < data.length; i++) {
            let fila = document.createElement("tr");
            let columna1 = document.createElement("td");
            let columna2 = document.createElement("td");
            let columna3 = document.createElement("td");
            let columna4 = document.createElement("td");
            columna1.innerText = data[i]['idPedido'];
            columna2.innerText = data[i]['fechaEnvio'];
            columna3.innerText = data[i]['fechaPedido'];
            columna4.innerText = data[i]['descripcionHorario'];

            fila.appendChild(columna1);
            fila.appendChild(columna2);
            fila.appendChild(columna3);
            fila.appendChild(columna4);

            tabla.appendChild(fila);
        }

        notificationSound.play();
        $('#modalNotificacion').modal('open');
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems, options);
    });

    // Or with jQuery

    $('.dropdown-trigger').dropdown();
</script>