var id;
$(document).on("click", ".selectAdress", function (e) {
    id = $(this).attr('name');
   
    $("#direccion").val(id);
    $("#confirmarDireccion").removeAttr("disabled");
});


