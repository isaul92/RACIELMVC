
$(document).on("click", ".editarDireccion", function (e) {

    //CODIGO PAGA BAJAR A LA SECCION DE MOFICIAR***/
    var posicion_boton = $("#btnAgregar").offset().top;
    $("html, body").animate({scrollTop: posicion_boton + "px"});

    /*****/
    
    /*OBTIENE EL INDICE ANTERIOR PARA DESELECCIONARLO Y SELECCIONAR EL NUEVO**/
    valor = $("#cmbEstados").val();
    $("#btnAgregarDireccion").val("modificarDireccion");
    $("#cmbEstados option[value=" + valor + "]").attr("selected", false);
    /****/
    
    
    e.preventDefault();

    id = $(this).attr('name');
    // alert(id);

    var cdpostal = $("#cdpostal" + id).val();
    var estado = $("#estado" + id).val();

    var municipio = $("#municipio" + id).val();
    var colonia = $("#colonia" + id).val();
    var calle = $("#calle" + id).val();
    var noExterior = $("#noExterior" + id).val();
    var noInterior = $("#noInterior" + id).val();
    var entreCalles = $("#entreCalles" + id).val();
    var referencias = $("#referencias" + id).val();
    var teleContacto = $("#teleContacto" + id).val();
    $("#idDireccion").val(id);
    $("#CDPOSTAL").val(cdpostal);
    $("#colonia").val(colonia);
    $("#calle").val(calle);
    $("#noInterior").val(noInterior);
    $("#noExterior").val(noExterior);
    $("#entreCalles").val(entreCalles);
    $("#referencias").val(referencias);
    $("#teleContacto").val(teleContacto);


/***SELECCIONA UN ESTADO NUEVO Y ACTIVA EL EVENTO ONCHANGE***/
    $("#cmbEstados option[value=" + estado + "]").attr("selected", true);
    document.getElementById("cmbEstados").onchange();
    $("#cmbMunicipios option[value=" + municipio + "]").attr("selected", true);
/****/

});


$(document).on("click", ".modificarContra", function (e) {
    e.preventDefault();
    // id=$(this).attr('id');
$("#passFormulario").show("slow");


});

/****CODIGO PARA MOSTRAR MENSAJE Y OCULTARLO***/
function showTooltip()
{
    $("#messageEliminado").show("slow");
    setTimeout(hideTooltip, 3000)
}

function hideTooltip()
{
    $("#messageEliminado").hide("slow");

}
/****/

$(document).on("click", ".eliminarDireccion", function (e) {

    e.preventDefault();
    /*obtiene el atributo name pues es el nombre de identificacion del comentario*/
    buttonpressed = $(this).attr('name');
    data = '{"idComentario":' + '"' + buttonpressed + '"' + '}';
    $.ajax({
        type: "POST",
        "url": "../api/eliminarDireccion",
        data: data,
        dataType: 'json'
    }).done(function (data) {
        $("div").remove(".divEliminarDireccion" + buttonpressed);
        var posicion_boton = $("#btnAgregar").offset().top;
        /***CODIGO PARA BAJAR SCROLL*/
        $("html, body").animate({scrollTop: posicion_boton + "px"});
        
        /***CODIGO PARA MOSTRAR Y OCULTAR MENSAJE DE EXITO**/
        setTimeout(showTooltip, 500);

    }).fail(function (data) {
        alert("NO SE HA PODIDO MODIFICAR!");
    });




});




 