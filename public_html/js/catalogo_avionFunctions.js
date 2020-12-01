//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************



$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#enviar").click(function () {
        addOrUpdatecatalogo_avion(false);
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormcatalogo_avion();
        $("#typeAction").val("add_catalogo_avion");
        $("#myModalFormulario").modal();
    });
});

//*********************************************************************
//cuando el documento esta cargado se procede a cargar la información
//*********************************************************************

$(document).ready(function () {
    showALLcatalogo_avion(true);
    
});

//*********************************************************************
//Agregar o modificar la información
//*********************************************************************

function addOrUpdatecatalogo_avion(ocultarModalBool) {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../backend/controller/catalogo_avionController.php',
            data: {
                action:              $("#typeAction").val(),
                idcatalogo_avion:    $("#txtidcatalogo_avion").val(),
                año:                 $("#txtaño").val(),
                modelo:              $("#txtmodelo").val(),
                marca:               $("#txtmarca").val(),
                cantidad_filas:      $("#txtcantidad_filas").val(),
                asientos_por_fila:   $("#txtasientos_por_fila").val(),
                               
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
                    clearFormcatalogo_avion();
                    showALLcatalogo_avion();
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
    if ($("#txtidcatalogo_avion").val() === "") {
        validacion = false;
    }

    if ($("#txtaño").val() === "") {
        validacion = false;
    }

    if ($("#txtmodelo").val() === "") {
        validacion = false;
    }

    if ($("#txtmarca").val() === "") {
        validacion = false;
    }

    if ($("#txtcantidad_filas").val() === "") {
        validacion = false;
    }

    if ($("#txtasientos_por_fila").val() === "") {
        validacion = false;
    }


    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormcatalogo_avion() {
    $('#formcatalogo_avion').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormcatalogo_avion();
    $("#typeAction").val("add_catalogo_avion");
    $("#myModalFormulario").modal("hide");
}

//*****************************************************************
//*****************************************************************

function showALLcatalogo_avion(ocultarModalBool) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/catalogo_avionController.php',
        data: {
            action: "showAll_catalogo_avion"
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de catalogo_avion en la base de datos");
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

function showcatalogo_avionByID(idcatalogo_avion) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/catalogo_avionController.php',
        data: {
            action: "show_catalogo_avion",
            idcatalogo_avion: idcatalogo_avion
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de catalogo_avion en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objcatalogo_avionJSon = JSON.parse(data);
            $("#txtidcatalogo_avion").val(objcatalogo_avionJSon.idcatalogo_avion);
            $("#txtaño").val(objcatalogo_avionJSon.año);
            $("#txtmodelo").val(objcatalogo_avionJSon.modelo);
            $("#txtmarca").val(objcatalogo_avionJSon.marca);
            $("#txtcantidad_filas").val(objcatalogo_avionJSon.cantidad_filas);
            $("#txtasientos_por_fila").val(objcatalogo_avionJSon.asientos_por_fila);
            $("#typeAction").val("update_catalogo_avion");
            $("#myModalFormulario").modal();
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deletecatalogo_avionByID(idcatalogo_avion) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/catalogo_avionController.php',
        data: {
            action: "delete_catalogo_avion",
            idcatalogo_avion: idcatalogo_avion
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de catalogo_avion en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.substring(2);
            var typeOfMessage = data.substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                mostrarModal("myModal", "Resultado de la acción", responseText);
                showALLcatalogo_avion(false);
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



