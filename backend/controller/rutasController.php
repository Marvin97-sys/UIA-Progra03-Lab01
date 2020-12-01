<?php

require_once("../bo/rutasBo.php");
require_once("../domain/rutas.php");


/**
 * This class contain all services methods of the table rutas
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// rutas Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myrutasBo = new rutasBo();
        $myrutas = rutas::createNullrutas();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_rutas" or $action === "update_rutas") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idrutas') != null) && (filter_input(INPUT_POST, 'trayecto') != null) && (filter_input(INPUT_POST, 'duracion') != null)) {
                $myrutas->setidrutas(filter_input(INPUT_POST, 'idrutas'));
                $myrutas->settrayecto(filter_input(INPUT_POST, 'trayecto'));
                $myrutas->setduracion(filter_input(INPUT_POST, 'duracion'));
                if ($action == "add_rutas") {
                    $myrutasBo->add($myrutas);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_rutas") {
                    $myrutasBo->update($myrutas);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_rutas") {//accion de consultar todos los registros
            $resultDB   = $myrutasBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_rutas") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idrutas') != null) {
                $myrutas->setidrutas(filter_input(INPUT_POST, 'idrutas'));
                $myrutas = $myrutasBo->searchById($myrutas);
                if ($myrutas != null) {
                    echo json_encode(($myrutas));
                } else {
                    echo('E~NO Existe una ruta con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_rutas") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idrutas') != null) {
                $myrutas->setidrutas(filter_input(INPUT_POST, 'idrutas'));
                $myrutas->delete($myrutas);
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


