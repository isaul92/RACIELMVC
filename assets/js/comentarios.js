$(document).on("ready", function () {
    oculta();


});


function oculta(elemento) {
    ///// capturamos el elemento



    $("#btnAgregarDireccion").val("nuevaDireccion");

    item = $("#" + elemento);

    if (elemento == "item0") {
        $("#frmCombos")[0].reset();
    }
    ///// verificamos su estado
    if ($(item).hasClass('visible')) {
        $(item).removeClass('visible');
        //// cambiamos su estado
        $(item).addClass('invisible');
        //// animamos
        $(item).slideUp('fast');
    } else {
        $(item).removeClass('invisible');
        $(item).addClass('visible');
        $(item).slideDown('fast');
    }
}


 