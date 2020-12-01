//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************



$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#enviar").click(function () {
        addOrUpdateUsuarios(false);
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormUsuarios();
        $("#typeAction").val("add_usuarios");
        $("#myModalFormulario").modal();
    });
});

//*********************************************************************
//cuando el documento esta cargado se procede a cargar la información
//*********************************************************************

$(document).ready(function () {
    showALLUsuarios(true);
    
});

//*********************************************************************
//Agregar o modificar la información
//*********************************************************************

function addOrUpdateUsuarios(ocultarModalBool) {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../backend/controller/usuariosController.php',
            data: {
                action:         $("#typeAction").val(),
                idusuario:      $("#txtidusuario").val(),
                contraseña:         $("#txtcontraseña").val(),
                fecha_registro:      $("#txtfecha_registro").val(),
                fecha_actualizacion:      $("#txtfecha_actualizacion").val(),
                personas_idpersonas:  $("#txtpersonas_idpersonas").val()
                
                
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
                    clearFormUsuarios();
                    showALLUsuarios();
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
    if ($("#txtidusuario").val() === "") {
        validacion = false;
    }

    if ($("#txtcontraseña").val() === "") {
        validacion = false;
    }

    if ($("#txtfecha_registro").val() === "") {
        validacion = false;
    }

    if ($("#txtfecha_actualizacion").val() === "") {
        validacion = false;
    }

    if ($("#txtpersonas_idpersonas").val() === "") {
        validacion = false;
    }



    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormUsuarios() {
    $('#formUsuarios').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormUusarios();
    $("#typeAction").val("add_usuarios");
    $("#myModalFormulario").modal("hide");
}

//*****************************************************************
//*****************************************************************

function showALLUsuarios(ocultarModalBool) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/usuariosController.php',
        data: {
            action: "showAll_usuarios"
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de los usuarios en la base de datos");
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

function showUsuariosByID(idusuario) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/usuariosController.php',
        data: {
            action: "show_usuarios",
            idusuario: idusuario
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de los usuarios en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objUsuariosJSon = JSON.parse(data);
            $("#txtidusuario").val(objUsuariosJSon.idusuario);
            $("#txtcontraseña").val(objUsuariosJSon.contraseña);
            $("#txtfecha_registro").val(objUsuariosJSon.fecha_registro);
            $("#txtfecha_actualizacion").val(objUsuariosJSon.fecha_actualizacion);
            $("#txtpersonas_idpersonas").val(objUsuariosJSon.personas_idpersonas);            
            $("#typeAction").val("update_usuarios");
            $("#myModalFormulario").modal();
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deleteUsuariosByID(idusuario) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/usuariosController.php',
        data: {
            action: "delete_usuarios",
            idusuario: idusuario
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de los usuarios en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.substring(2);
            var typeOfMessage = data.substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                mostrarModal("myModal", "Resultado de la acción", responseText);
                showALLUsuarios(false);
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


