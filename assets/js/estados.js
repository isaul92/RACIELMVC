var codMunicipios = new Array();
var idEstado = new Array();
var municipios = new Array();

function limpiarMunicipios() {
    console.log("log");
    var reference = document.frmCombos.cmbMunicipios;
    var largo = reference.options.length;
    for (j = 0; j < 8; j++)
        for (i = 0; i < largo; i++)
            document.frmCombos.cmbMunicipios.remove(i);
}

function cargarMunicipios(valor) {
    var longitud = idEstado.length;
    var reference = document.frmCombos.cmbMunicipios;
    var i = 0;
    var j = 0;

    limpiarMunicipios();

    for (i = 0; i < longitud; i++) {
        if (idEstado[i] == valor) {
            var newOption = new Option(municipios[i], codMunicipios[i]);
            reference.options[j] = newOption;
            j++;
        }
    }
   
}

