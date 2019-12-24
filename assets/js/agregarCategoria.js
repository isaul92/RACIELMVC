$(document).on("click", ".btnCategoriaCrear", function (e) {

    e.preventDefault();
    $("#formCategoria").attr('action', '../categorias/save');
    $("#inputCategoria").val("");
    $("#idCategoria").val("");
    $("#nombreCategoria").val("");
    $("#tituloCategorias").text("Crear Categoria");
    if ($(".divCrearCategoria").hasClass('visible')) {
        $(".divCrearCategoria").removeClass('visible');
        //// cambiamos su estado
        $(".divCrearCategoria").addClass('invisible');
        //// animamos
        $(".divCrearCategoria").slideUp('fast');
    } else {
        $(".divCrearCategoria").removeClass('invisible');
        $(".divCrearCategoria").addClass('visible');
        $(".divCrearCategoria").slideDown('fast');


    }
});


$(document).on("click", ".editarCategoria", function (e) {

    e.preventDefault();
    
    $("#formCategoria").attr('action', '../categorias/update');
    id = $(this).attr("name");
    val = $(this).attr("id");
    console.log(val);

    if ($(".divCrearCategoria").hasClass('visible')) {
        $("#idCategoria").val(id);
        $("#nombreCategoria").val(val);
        $(".divCrearCategoria").removeClass('visible');
        //// cambiamos su estado
        $(".divCrearCategoria").addClass('invisible');
        //// animamos
        $(".divCrearCategoria").slideUp('fast');
        $(".divCrearCategoria").removeClass('invisible');
        $(".divCrearCategoria").addClass('visible');
        $(".divCrearCategoria").slideDown('slow');
        $("#inputCategoria").val("");
        $("#tituloCategorias").delay(200).queue(function () {
            $("#tituloCategorias").text("Modificar Categoria");
            $("#btnCrearCat").prop("disabled", false);
            $(this).dequeue();
            $("#inputCategoria").val(val);
        });



    } else {
        $("#idCategoria").val(id);
        $("#nombreCategoria").val(val);
        $(".divCrearCategoria").removeClass('invisible');
        $(".divCrearCategoria").addClass('visible');
        $(".divCrearCategoria").slideDown('fast');
        $("#inputCategoria").val("");
        $("#tituloCategorias").text("Modificar Categoria");
        $("#inputCategoria").val(val);



        $("#btnCrearCat").prop("disabled", false);
    }
});

$(document).on("click", ".btnGuardarCategoria", function (e) {



});
$(document).change("#inputCategoria", function (e) {
    if ($("#inputCategoria").val()) {
        
 
    nombreCat = $("#inputCategoria").val();


    if (!nombreCat.trim() == "") {
        $("#btnCrearCat").prop("disabled", false);
    } else {
        $("#btnCrearCat").prop("disabled", true);
    }
   }

});