//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************



$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#enviar").click(function () {
        addOrUpdatevuelos(false);
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormvuelos();
        $("#typeAction").val("add_vuelos");
        $("#myModalFormulario").modal();
    });
});

//*********************************************************************
//cuando el documento esta cargado se procede a cargar la información
//*********************************************************************

$(document).ready(function () {
    showALLvuelos(true);
    
});

//*********************************************************************
//Agregar o modificar la información
//*********************************************************************

function addOrUpdatevuelos(ocultarModalBool) {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../backend/controller/vuelosController.php',
            data: {
                action:     $("#typeAction").val(),
                idvuelos:    $("#txtidvuelos").val(),
                fecha_hora:   $("#txtfecha_hora").val(),
                rutas_idrutas:   $("#txtrutas_idrutas").val(),
                catalogo_avion_idcatalogo_avion:   $("#txtcatalogo_avion_idcatalogo_avion").val(),
                                              
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
                    clearFormvuelos();
                    showALLvuelos();
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
    if ($("#txtidvuelos").val() === "") {
        validacion = false;
    }

    if ($("#txtfecha_hora").val() === "") {
        validacion = false;
    }

    if ($("#txtrutas_idrutas").val() === "") {
        validacion = false;
    }
     if ($("#txtcatalogo_avion_idcatalogo_avion").val() === "") {
        validacion = false;
    }

    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormvuelos() {
    $('#formvuelos').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormvuelos();
    $("#typeAction").val("add_vuelos");
    $("#myModalFormvuelos").modal("hide");
}

//*****************************************************************
//*****************************************************************

function showALLvuelos(ocultarModalBool) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/vuelosController.php',
        data: {
            action: "showAll_vuelos"
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de vuelos en la base de datos");
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

function showvuelosByID(idvuelos) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/vuelosController.php',
        data: {
            action: "show_vuelos",
            idvuelos: idvuelos
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de vuelos en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objvuelosJSon = JSON.parse(data);
            $("#txtidvuelos").val(objvuelosJSon.idvuelos);
            $("#txtfecha_hora").val(objvuelosJSon.fecha_hora);
            $("#txtrutas_idrutas").val(objvuelosJSon.rutas_idrutas);
            $("#txtcatalogo_avion_idcatalogo_avion").val(objvuelosJSon.catalogo_avion_idcatalogo_avion);
            $("#typeAction").val("update_vuelos");
            $("#myModalFormulario").modal();
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deletevuelosByID(idvuelos) {
    //Se envia la información por ajax
    $.ajax({
        url: 'admin/vuelosController.php',
        data: {
            action: "delete_vuelos",
            idvuelos: idvuelos
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Se presento un error a la hora de cargar la información de vuelos en la base de datos");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.substring(2);
            var typeOfMessage = data.substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                mostrarModal("myModal", "Resultado de la acción", responseText);
                showALLvuelos(false);
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


