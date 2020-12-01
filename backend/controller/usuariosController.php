<?php

require_once("../bo/usuariosBo.php");
require_once("../domain/usuarios.php");


/**
 * This class contain all services methods of the table Usuarios
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// Usuarios Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myUsuariosBo = new UsuariosBo();
        $myUsuarios = Usuarios::createNullUsuarios();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_usuarios" or $action === "update_usuarios") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idusuario') != null) && (filter_input(INPUT_POST, 'contraseña') != null) && (filter_input(INPUT_POST, 'fecha_registro') != null) && (filter_input(INPUT_POST, 'fecha_actualizacion') != null) && (filter_input(INPUT_POST, 'personas_idpersonas') != null)) {
                $myUsuarios->setidusuario(filter_input(INPUT_POST, 'idusuario'));
                $myUsuarios->setcontraseña(filter_input(INPUT_POST, 'contraseña'));
                $myUsuarios->setfecha_registro(filter_input(INPUT_POST, 'fecha_registro'));
                $myUsuarios->setfecha_actualizacion(filter_input(INPUT_POST, 'fecha_actualizacion'));
                $myUsuarios->setpersonas_idpersonas(filter_input(INPUT_POST, 'personas_idpersonas'));
                $myUsuarios->setLastUser('112540148');
                $myUsuarios->setLastUser('112540148');
                if ($action == "add_usuarios") {
                    $myUsuariosBo->add($myUsuarios);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_usuarios") {
                    $myUsuariosBo->update($myUsuarios);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_usuarios") {//accion de consultar todos los registros
            $resultDB   = $myUsuariosBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_usuarios") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idusuario') != null) {
                $myUsuarios->setidusuarios(filter_input(INPUT_POST, 'idusuario'));
                $myUsuarios = $myUsuariosBo->searchById($myUsuarios);
                if ($myUsuarios != null) {
                    echo json_encode(($myUsuarios));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_usuarios") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idusuario') != null) {
                $myUsuarios->setidusuarios(filter_input(INPUT_POST, 'idusuario'));
                $myUsuariosBo->delete($myUsuarios);
                echo('M~Registro Fue Eliminado Correctamente');
            }
        }

        //***********************************************************
        //se captura cualquier error generado
        //***********************************************************
    } catch (Exception $e) { //exception generated in the business object..
        echo("E~" . $e->getMessage());
    }
} else {
    echo('M~Parametros no enviados desde el formulario'); //se codifica un mensaje para enviar
}
?>
