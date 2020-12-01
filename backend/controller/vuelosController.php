<?php

require_once("../bo/vuelosBo.php");
require_once("../domain/vuelos.php");


/**
 * This class contain all services methods of the table vuelos
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// vuelos Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myvuelosBo = new vuelosBo();
        $myvuelos = vuelos::createNullvuelos();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_vuelos" or $action === "update_vuelos") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idvuelos') != null) && (filter_input(INPUT_POST, 'fecha_hora') != null) && (filter_input(INPUT_POST, 'rutas_idrutas') != null)&& (filter_input(INPUT_POST, 'catalogo_avion_idcatalogo_avion') != null)) {
                $myvuelos->setidvuelos(filter_input(INPUT_POST, 'idvuelos'));
                $myvuelos->setfecha_hora(filter_input(INPUT_POST, 'fecha_hora'));
                $myvuelos->setrutas_idrutas(filter_input(INPUT_POST, 'rutas_idrutas'));
                $myvuelos->setcatalogo_avion_idcatalogo_avion(filter_input(INPUT_POST, 'catalogo_avion_idcatalogo_avion'));
                if ($action == "add_vuelos") {
                    $myvuelosBo->add($myvuelos);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_vuelos") {
                    $myvuelosBo->update($myvuelos);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_vuelos") {//accion de consultar todos los registros
            $resultDB   = $myvuelosBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_vuelos") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idvuelos') != null) {
                $myvuelos->setidvuelos(filter_input(INPUT_POST, 'idvuelos'));
                $myvuelos = $myvuelosBo->searchById($myvuelos);
                if ($myvuelos != null) {
                    echo json_encode(($myvuelos));
                } else {
                    echo('E~NO Existe un vuelo con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_vuelos") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idvuelos') != null) {
                $myvuelos->setidvuelos(filter_input(INPUT_POST, 'idvuelos'));
                $myvuelos->delete($myvuelos);
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

