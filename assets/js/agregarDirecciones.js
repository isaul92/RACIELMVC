
$(document).ready(function () {

    $("#btnAgregarDireccion").on("click", function (e) {
        e.preventDefault();


        valor = $("#btnAgregarDireccion").val();
        console.log(valor);

        var selectMunicipio = $("#cmbMunicipios option:selected").text();
        var valorMunicipio = $("#cmbMunicipios").val();
        var selectEstado = $("#cmbEstados option:selected").text();
        var valorEstado = $("#cmbEstados").val();
        var cdPostal = $("#CDPOSTAL").val();
        var colonia = $("#colonia").val();
        var calle = $("#calle").val();
        var noExterior = $("#noExterior").val();
        var noInterior = $("#noInterior").val();
        var entreCalles = $("#entreCalles").val();
        var referencias = $("#referencias").val();
        var teleContacto = $("#teleContacto").val();
        var idUser = $("#user_id").val();
        var id = $("#idDireccion").val();
        if (selectEstado == "Selecciona..." || cdPostal == "" ||
                colonia == "" || calle == "" || noExterior == "" ||
                entreCalles == "" || referencias == "" || teleContacto == "") {
            alert("Faltan datos");
        } else {


            $("#frmCombos")[0].reset();
            if ($("#btnAgregarDireccion").val() == "nuevaDireccion") {
                var data = '{"idUser":' + '"' + idUser + '"'
                        + ',' + '"cdPostal":' + '"' + cdPostal + '"' + ','
                        + '"IdEstado":' + '"' + valorEstado + '"' + ','
                        + '"IdMunicipio":' + '"' + valorMunicipio + '"' + ','
                        + '"valorEstado":' + '"' + selectEstado + '"' + ','
                        + '"valorMunicipio":' + '"' + selectMunicipio + '"' + ','
                        + '"colonia":' + '"' + colonia + '"' + ','
                        + '"calle":' + '"' + calle + '"' + ','
                        + '"noExterior":' + '"' + noExterior + '"' + ','
                        + '"noInterior":' + '"' + noInterior + '"' + ','
                        + '"entreCalles":' + '"' + entreCalles + '"' + ','
                        + '"referencias":' + '"' + referencias + '"' + ','
                        + '"id":' + '"' + '"' + ','
                        + '"teleContacto":' + '"' + teleContacto + '"' +
                        '}';

            } else {

                var data = '{"idUser":' + '"' + idUser + '"'
                        + ',' + '"cdPostal":' + '"' + cdPostal + '"' + ','
                        + '"IdEstado":' + '"' + valorEstado + '"' + ','
                        + '"IdMunicipio":' + '"' + valorMunicipio + '"' + ','
                        + '"valorEstado":' + '"' + selectEstado + '"' + ','
                        + '"valorMunicipio":' + '"' + selectMunicipio + '"' + ','
                        + '"colonia":' + '"' + colonia + '"' + ','
                        + '"calle":' + '"' + calle + '"' + ','
                        + '"noExterior":' + '"' + noExterior + '"' + ','
                        + '"noInterior":' + '"' + noInterior + '"' + ','
                        + '"entreCalles":' + '"' + entreCalles + '"' + ','
                        + '"referencias":' + '"' + referencias + '"' + ','
                        + '"id":' + '"' + id + '"' + ','
                        + '"teleContacto":' + '"' + teleContacto + '"' +
                        '}';

            }


            $.ajax({
                type: "POST",
                "url": "../api/guardarDireccion",
                data: data,
                dataType: 'json'
            }).done(function (data) {
                var mensaje;
                var id = data.idNuevaDireccion;
                if ($("#btnAgregarDireccion").val() == "modificarDireccion") {
                    mensaje = "Direccion modificada"

                    $("div").remove(".divEliminarDireccion" + id);



                } else {
                    mensaje = "Direccion creada";
                }

                item0 = '"item0"'
                $(".agregarDivsDirecciones").append("<div id='message' class='mensaje badge badge-success'>" + mensaje + "</div><div  class='col-12 d-flex my-3 p-2 contenedorDirecciones divEliminarDireccion" + id + "'>\n\
    \n\
    <div class='col-10'>" + " " + cdPostal + " " + selectEstado + " " + selectMunicipio + " " + colonia + " " + calle + " " + noExterior + " " + noInterior + " " + entreCalles + " " + referencias + " Telefono: " + teleContacto + " </div> \n\
        <div class='col-2 p-0 '>\n\
                 <form class='direccionDiv' id='direccion" + id + "'>                      \n\
      <input type='hidden' id='estado" + id + "' value='" + valorEstado + "'>   \n\
      <input type='hidden' id='calle" + id + "' value='" + calle + "'>      \n\
  <input type='hidden' id='noExterior" + id + "' value='" + noExterior + "'>  \n\
 <input type='hidden' id='noInterior" + id + "' value='" + noInterior + "'>  \n\
 <input type='hidden' id='entreCalles" + id + "' value='" + entreCalles + "'>          \n\
  <input type='hidden' id='referencias" + id + "' value='" + referencias + "'>  \n\
    <input type='hidden' id='teleContacto" + id + "' value='" + teleContacto + "'>     \n\
      <input type='hidden' id='cdpostal" + id + "' value='" + cdPostal + "'>\n\
           <input type='hidden' id='colonia" + id + "' value='" + colonia + "'> \n\
          <input type='hidden' id='municipio" + id + "' value='" + valorMunicipio + "'>                                                      \n\
<a href='#'   name='" + id + "' onclick='javascript:oculta(" + item0 + ")'  class='editarDireccion'>Editar</a>              \n\
    <a href='#'  name='" + id + "' class='eliminarDireccion'>Eliminar</a>    \n\
          </form>\n\
   </div>\n\
  </div>\n\
\n\
");


                $("#item0").removeClass('visible');
                //// cambiamos su estado
                $("#item0").addClass('invisible');
                //// animamos
                $("#item0").slideUp('fast');
                setTimeout(showTooltip, 500);

            }).fail(function (data) {
                alert("error")

            });
            /*obtiene el atributo name pues es el nombre de identificacion del comentario*/
        }
    });
    function showTooltip()
    {
        $("#message").show("slow");
        setTimeout(hideTooltip, 3000)
    }

    function hideTooltip()
    {
        $("#message").hide("slow");
        $(".mensaje").removeAttr('id');
    }
});
   