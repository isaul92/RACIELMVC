$(document).on("click", "#fechaBuscar", function (e) {

    $("#datepicker").removeAttr('style');
    $("#inputBuscarObraId").css("display", "none");




});
$(document).on("click", "#nombreBuscar,#idObra", function (e) {
    $("#inputBuscarObraId").css("display", "block");
    $("#datepicker").css("display", "none")
});

$(document).on("submit", "#buscarObra", function (e) {
    e.preventDefault();

    opcion = $('input:radio[name=options]:checked').val();
    if (opcion == "nombreBuscarObra" || opcion == "idBuscarObra") {
        if (!$("#inputBuscarObraId").val().trim() == "") {
            data = '{"accion":"' + $('input:radio[name=options]:checked').val() + '","inputObra":"' + $("#inputBuscarObraId").val() + '","idUser":"' + $("#idUser").val() + '" }';
            //alert(data)        ;
            $.ajax({
                type: "POST",
                "url": "../api/buscarObra",
                data: data
            }).done(function (data) {
                
                $("div").remove("#divError");
                $("div").remove("#grupoDeCards");
                $("#buscadorObras").append(data);


            }).fail(function (data) {
             
                $("#buscadorObras").html(data);

            });
        } else {
            alert("Ingrese informacion valida!");
        }
        
        
        

    } else {
        if (!$("#datepicker").val().trim() == "") {
      data = '{"accion":"' + $('input:radio[name=options]:checked').val() + '","inputObra":"' + $("#datepicker").val() + '","idUser":"' + $("#idUser").val() + '" }';
        alert(data)        ;
            //alert("buscando por fecha" + data);
            $.ajax({
                type: "POST",
                "url": "../api/buscarObra",
                data: data
          }).done(function (data) {
                
                $("div").remove("#divError");
                $("div").remove("#grupoDeCards");
                $("#buscadorObras").append(data);


            }).fail(function (data) {
             
                $("#buscadorObras").html(data);
                });


        } else {
            alert("No hay fecha, Ingrese una fecha");
        }

    }

    //alert($("#datepicker").val());
});