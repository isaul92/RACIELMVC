$(document).on("click", "#fechaBuscar", function (e) {

    $("#datepicker").removeAttr('style');
    $("#inputBuscarNoticiaId").css("display", "none");




});
$(document).on("click", "#nombreBuscar,#idNoticia", function (e) {
    $("#inputBuscarNoticiaId").css("display", "block");
    $("#datepicker").css("display", "none")
});

$(document).on("submit", "#buscarNoticias", function (e) {
    e.preventDefault();

    opcion = $('input:radio[name=options]:checked').val();
    if (opcion == "nombreBuscarNoticia" || opcion == "idBuscarNoticia") {
        if (!$("#inputBuscarNoticiaId").val().trim() == "") {
            data = '{"accion":"' + $('input:radio[name=options]:checked').val() + '","inputNoticia":"' + $("#inputBuscarNoticiaId").val() + '","idUser":"' + $("#idUser").val() + '" }';
           alert(data);
            $.ajax({
                type: "POST",
                "url": "./api/buscarNoticia",
                data: data
            }).done(function (data) {
                
                $("div").remove("#divError");
                $("div").remove("#grupoDeCards");
                $("#buscadorNoticias").append(data);


            }).fail(function (data) {
             
                $("#buscadorNoticias").html(data);

            });
        } else {
            alert("Ingrese informacion valida!");
        }
        
        
        

    } else {
        if (!$("#datepicker").val().trim() == "") {
      data = '{"accion":"' + $('input:radio[name=options]:checked').val() + '","inputNoticia":"' + $("#datepicker").val() + '","idUser":"' + $("#idUser").val() + '" }';
            //alert("buscando por fecha" + data);
            $.ajax({
                type: "POST",
                "url": "./api/buscarNoticia",
                data: data
          }).done(function (data) {
                
                $("div").remove("#divError");
                $("div").remove("#grupoDeCards");
                $("#buscadorNoticias").append(data);


            }).fail(function (data) {
             
                $("#buscadorNoticias").html(data);
                });


        } else {
            alert("No hay fecha, Ingrese una fecha");
        }

    }

    //alert($("#datepicker").val());
});