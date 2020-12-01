/***********************************************************************************/
/***********************************************************************************/
/* Mensaje MODAL
/***********************************************************************************/
/***********************************************************************************/
/* Para implementar el mensaje modal debe existir el siguiente cógido html 
 * en la pagina que se va a mostrar
 
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalTitle">Modal Header</h4>
            </div>
            <div class="modal-body" id="myModalMessage">
                <p>This is a small modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
 */

 
 
 
  function cambiarMensajeModal(idDiv ,titulo, mensaje){
     $("#"+idDiv+"Title").html(titulo);
     $("#"+idDiv+"Message").html(mensaje);
 }

/***********************************************************************************/
/***********************************************************************************/
/* Fin de las opcines de mensaje MODAL
/***********************************************************************************/
/***********************************************************************************/

//******************************************************************************
//******************************************************************************

function mostrarMensaje(classCss, msg, neg) {
	$("#mesajeResultNeg").html(neg);
    $("#mesajeResultText").html(msg); 
    
    //se le eliminan los estilos al mensaje
    $("#mesajeResult").removeClass();

    //se setean los estilos
    $("#mesajeResult").addClass(classCss);

    
}

function ocultarMensaje() {
    $("#mesajeResultNeg").html("");
    $("#mesajeResultText").html(""); 
    //se le eliminan los estilos al mensaje
    $("#mesajeResult").removeClass();
    //se setean los estilos
    $("#mesajeResult").addClass("hiddenDiv");
	    
}

function dateToString(date){
    var fecha = new Date(date);
    var mes = (fecha.getMonth()+1)<10? '0'+(fecha.getMonth()+1):''+(fecha.getMonth()+1);
    var dia = (fecha.getDate())<10? '0'+(fecha.getDate()):''+(fecha.getDate());
    var fechaTxt = dia +"/" +mes + "/" + fecha.getFullYear();
    return fechaTxt;
}

var dt_lenguaje_espanol = {
    decimal:        "",
    emptyTable:     "No existe información",
    info:           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
    infoEmpty:      "Mostrando 0 a 0 de 0 registros",
    infoFiltered:   "(filtered from _MAX_ total entries)",
    infoPostFix:    "",
    thousands:      ",",
    lengthMenu:     "Mostrar _MENU_ registros por página",
    loadingRecords: "Cargando, por favor espere...",
    processing:     "Procesando...",
    search:         "Buscar ",
    zeroRecords:    "No se encontraron registros que cumplan con el criterio",
    paginate: {
        first:      "Primero",
        last:       "Último",
        next:       "Siguiente",
        previous:   "Anterior"
    }
};