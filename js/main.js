/*$('.myAccount').dropdown();
mediumZoom('[data-zoomable]', {
    margin: 0,
    background: '#000000',
    scrollOffset: 40

});*/
/*$(function () {
    $('[data-toggle="popover"]').popover()
})*/

function changeQtyMin0(value, param, min, max) {
    const parent = value.parentElement;
    let add = parent.childNodes[3];
    if (param === 'add') {
        if (parseInt(add.value) < max) {
            add.value = parseInt(add.value) + 1;
        }
    }
    if (param === 'minus') {

        if (parseInt(add.value) > min) {
            add.value = parseInt(add.value) - 1;
        } else {
        }

    }


}

function toLowerCase(e) {
    e.value = e.value.toLowerCase();
}

function solonumeros(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;

    return /\d/.test(String.fromCharCode(keynum));
};

/*
setTimeout(manteniminto,5000);

function manteniminto(){
    Swal.fire(
        'Lamentamos las molestias, este sitio se encuentra en mantenimiento',
        'Por favor aún no realice compras',
        'warning'
    )
}*/
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function mostrarLoading() {
    document.getElementById("loading").style.display = "block";
}

function forceLower(strInput) {
    strInput.value = strInput.value.toLowerCase();
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

function checkboxlimit(checkgroup, limit, productoName = 'makis') {
    for (var i = 0; i < checkgroup.length; i++) {

        let checkedcount = 0;
        for (let i = 0; i < checkgroup.length; i++)
            checkedcount += (checkgroup[i].checked) ? 1 : 0;

        if (checkedcount !== limit) {
            alert("En este paquete puedes elegir " + limit + " " + productoName + ".");
            return false;
            /* this.checked = false*/
        }
        return true;


    }
}

function checkboxlimitGeneric(checkgroup, limit) {
    var checkgroup = checkgroup
    var limit = limit
    for (var i = 0; i < checkgroup.length; i++) {
        checkgroup[i].onclick = function () {
            var checkedcount = 0
            for (var i = 0; i < checkgroup.length; i++)
                checkedcount += (checkgroup[i].checked) ? 1 : 0
            if (checkedcount > limit) {
                alert("You can only select a maximum of " + limit + " checkboxes")
                this.checked = false
            }
        }
    }
}

