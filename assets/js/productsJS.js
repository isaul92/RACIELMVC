/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.    $("div").remove("#tablaBuscarProd");
 */

$(document).on("submit", "#buscarProductos", function (e) {
    e.preventDefault();
    data = '{"accion":"' + $('input:radio[name=options]:checked').val() + '","inputProducto":"' + $("#inputBuscarProductoId").val() + '"}';


    $.ajax({
        type: "POST",
        "url": "../api/buscarProduct",
        data: data,

    }).done(function (data) {


        $("div").remove("#tablaBuscarProd");
        $("#buscadorProductos").append(data);
   

    }).fail(function (data) {
        alert("NO SE HA PODIDO MODIFICAR!");
        $("#buscadorProductos").html(data);

    });

});

$(document).change("#inputBuscarProductoId", function (e) {
    if ($("#inputBuscarProductoId").val()) {
        nombreProd = $("#inputBuscarProductoId").val();
        if (!nombreProd.trim() == "") {
            $("#btnBuscarProducto").prop("disabled", false);
        } else {
            $("#btnBuscarProducto").prop("disabled", true);
        }
    }
});


