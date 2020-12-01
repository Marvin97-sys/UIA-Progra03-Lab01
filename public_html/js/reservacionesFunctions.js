//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************



$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#enviar").click(function () {
        addOrUpdateReservaciones(false);
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormReservaciones();
        $("#typeAction").val("add_reservaciones");
        $("#myModalFormulario").modal();
    });
});

//*********************************************************************
//cuando el documento esta cargado se procede a cargar la información
//*********************************************************************

$(document).ready(function () {
    showALLReservaciones(true);
    
});

//*********************************************************************
//Agregar o modificar la información
//*********************************************************************

function addOrUpdateReservaciones(ocultarModalBool) {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../backend/controller/reservacionesController.php',
            data: {
                action:         $("#typeAction").val(),
                idreservaciones:      $("#txtidreservaciones").val(),
                usuario_idusuario:         $("#txtusuario_idusuario").val(),
                vuelos_idvuelos:      $("#txtvuelos_idvuelos").val(),
                fecha_reservacion:      $("#txtfecha_reservacion").val(),
                numero_fila:  $("#txtnumero_fila").val(),
                numero_asiento:  $("#txtnumero_asiento").val()
                
                
            },
            error: function () { //si existe un error en la respuesta del ajax
                swal("Error", "Se presento un error al enviar la informacion", "error");
            },
            success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
                var messageComplete = data.trim();
                var responseText = messageComplete.substring(2);
                var typeOfMessage = messageComplete.substring(0, 2);
                if (typeOfMessage === "M~") { //si todo esta corecto
                    swal("Confirmacion", responseText, "success");
                    clearFormReservaciones();
                    showALLReservaciones();
                } else {//existe un error
                    swal("Error", responseText, "error");
                }
            },
            type: 'POST'
        });
    }else{
        swal("Error de validación", "Los datos del formulario no fueron digitados, por favor verificar", "error");
    }
}

//*****************************************************************
//*****************************************************************
function validar() {
    var validacion = true;

    
    //valida cada uno de los campos del formulario
    //Nota: Solo si fueron digitados
    if ($("#txtidreservaciones").val() === "") {
        validacion = false;
    }

    if ($("#txtusuario_idusuario").val() === "") {
        validacion = false;
    }

    if ($("#txtvuelos_idvuelos").val() === "") {
        validacion = false;
    }

    if ($("#txtfecha_reservacion").val() === "") {
        validacion = false;
    }

    if ($("#txtnumero_fila").val() === "") {
        validacion = false;
    }
    
    if ($("#txtnumero_asiento").val() === "") {
        validacion = false;
    }



    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormReservaciones() {
    $('#formReservaciones').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormUusarios();
    $("#typeAction").val("add_reservaciones");
    $("#myModalFormulario").modal("hide");
}

//*****************************************************************
//*****************************************************************

function showALLReservaciones(ocultarModalBool) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/reservacionesController.php',
        data: {
            action: "showAll_reservaciones"
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de las reservaciones en la base de datos");
            if (ocultarModalBool) {
                ocultarModal("myModal");
            }
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            $("#divResult").html(data);
            // se oculta el modal esta funcion se encuentra en el utils.js
            
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function showReservacionesByID(idusuario) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/reservacionesController.php',
        data: {
            action: "show_reservaciones",
            idusuario: idusuario
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de las reservaciones en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objReservacionesJSon = JSON.parse(data);
            $("#txtidreservaciones").val(objReservacionesJSon.idreservaciones);
            $("#txtusuario_idusuario").val(objReservacionesJSon.usuario_idusuario);
            $("#txtvuelos_idvuelos").val(objReservacionesJSon.vuelos_idvuelos);
            $("#txtfecha_reservacion").val(objReservacionesJSon.fecha_reservacion);
            $("#txtnumero_fila").val(objReservacionesJSon.numero_fila);
            $("#txtnumero_asiento").val(objReservacionesJSon.numero_asiento);            
            $("#typeAction").val("update_reservaciones");
            $("#myModalFormulario").modal();
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deleteReservacionesByID(idusuario) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/reservacionesController.php',
        data: {
            action: "delete_reservaciones",
            idusuario: idusuario
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de las reservaciones en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.substring(2);
            var typeOfMessage = data.substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                mostrarModal("myModal", "Resultado de la acción", responseText);
                showALLReservaciones(false);
            } else {//existe un error
                mostrarModal("myModal", "Error", responseText);
            }
        },
        type: 'POST'
    });
}

function mostrarModal(idDiv, titulo, mensaje) {
    $("#" + idDiv + "Title").html(titulo);
    $("#" + idDiv + "Message").html(mensaje);
    $("#" + idDiv).modal();
}

function ocultarModal(idDiv) {
    $("#" + idDiv).modal("hide");
}


