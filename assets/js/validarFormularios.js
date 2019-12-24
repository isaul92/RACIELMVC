    function validar(e) {
     var boton = $("#botonGuardar");
     var input="#"
     input+=e.target.id;
          input=$(input);
    if (e.target.value.trim() == ""){
        input.removeClass("is-valid");
              input.addClass("is-invalid");
               if (document.getElementById("botonGuardar")) {

        document.getElementById("botonGuardar").setAttribute("disabled","disabled");
               }
    }else{
            input.removeClass("is-invalid");
           input.addClass("is-valid");
         if (document.getElementById("botonGuardar")) {
            document.getElementById("botonGuardar").removeAttribute("disabled"); 
        }
            
    
    }
}