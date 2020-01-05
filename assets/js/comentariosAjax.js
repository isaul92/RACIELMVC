

$(document).ready(function () {
    
    $(document).on("click", ".eliminarCommentario", function (e) {
        e.preventDefault();
        /*obtiene el atributo name pues es el nombre de identificacion del comentario*/
        buttonpressed = $(this).attr('name');
        data = '{"idComentario":' + '"' + buttonpressed + '"' + '}';
        $.ajax({
            type: "POST",
            "url": "api/eliminarComentario",
            data: data,
             dataType: 'json'
        }).done(function (data) {

            $("div").remove(".divComentarioEliminar" + buttonpressed);

        }).fail(function (data) {
            alert("Servidor ocupado");
        });


    });



    $(document).on("click",".submitComent", function (e) {
        /*obtiene el atributo name pues es el nombre de identificacion del comentario*/
        buttonpressed = $(this).attr('name');
        item = $("#" + buttonpressed);
        clase = $("." + buttonpressed);
        /*e prevent evita que se mande la peticion de reedireccion ***/
        e.preventDefault();
        /* guarda los datos que se reciben del serialize del formulario para usarlos despues*/
        var datos = $("#" + buttonpressed).serialize();
        /* convierte el serialize en un OBJETO PARA guardar 
         * los valos de comentario en la vista y poder eliminarlo en algun caso
         */
        var query = datos;
        var pairs, i, keyValuePair, key, value, map = {};
        // remove leading question mark if its there
        if (query.slice(0, 1) === '?') {
            query = query.slice(1);
        }
        if (query !== '') {
            pairs = query.split('&');
            for (i = 0; i < pairs.length; i += 1) {
                keyValuePair = pairs[i].split('=');
                key = decodeURIComponent(keyValuePair[0]);
                value = (keyValuePair.length > 1) ? decodeURIComponent(keyValuePair[1]) : undefined;
                map[key] = value;
            }
        }
        idTextArea = "#comentario" + map["id_noticia"];
        //  datos = JSON.stringify(map);
        datos = JSON.stringify(map);
        if (!$.trim($(idTextArea).val())) {
        } else {
            $(".submitComent").prop("disabled", true);
            /*id_noticia
             * 
             * manda el metodo guardarComentario al siguiente servicio ajax.php
             * @return {undefined}
             */
            $.ajax({
                type: "POST",
                "url": "api/guardarComentario",
                data: datos,
                dataType: 'json'
            }).done(function (data) {
                //   console.log(JSON.stringify(data));
                id = data.idComentario;

                //id = data;
                $(".submitComent").prop("disabled", false);
                $(clase).append("<div class='eliminarCommentt comments m-0 p-0 detailcomment divComentarioEliminar" + id + "'><div class='col-12 d-flex justify-content-between'><p><small>Hace un momento</small></p><form class='idComment" + id + "'><input type='hidden' name='idComentario' value='" + id + "'> <button type='submit'  class='eliminarCommentario btn btn-sm btn-outline-danger ' name='" + id + "'>Eliminar</buttom></form> </div> <div class='col-12 comentarios4'> <p>" + map['comentario'] + "</p>  </div> </div>");
            }).fail(function (data) {
                $(".submitComent").prop("disabled", false);
                alert("Servidor ocupado intente de nuevo");
            });
        }


    });




});
