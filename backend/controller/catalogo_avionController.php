<?php

require_once("../bo/CatalogoAvionBo.php");
require_once("../domain/CatalogoAvion.php");


/**
 * This class contain all services methods of the table CatalogoAvion
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// CatalogoAvion Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myCatalogoAvionBo = new CatalogoAvionBo();
        $mycatalogo_avion = CatalogoAvion::createNullCatalogoAvion();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_catalogo_avion" or $action === "update_catalogo_avion") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idcatalogo_avion') != null) && (filter_input(INPUT_POST, 'año') != null) && (filter_input(INPUT_POST, 'marca') != null) && (filter_input(INPUT_POST, 'modelo') != null) && (filter_input(INPUT_POST, 'cantidad_filas') != null) && (filter_input(INPUT_POST, 'asientos_por_fila') != null)) {
                $mycatalogo_avion->setidcatalogo_avion(filter_input(INPUT_POST, 'idcatalogo_avion'));
                $mycatalogo_avion->setaño(filter_input(INPUT_POST, 'año'));
                $mycatalogo_avion->setmarca(filter_input(INPUT_POST, 'marca'));
                $mycatalogo_avion->setmodelo(filter_input(INPUT_POST, 'modelo'));
                $mycatalogo_avion->setcantidad_filas(filter_input(INPUT_POST, 'cantidad_filas'));
                $mycatalogo_avion->setasientos_por_fila(filter_input(INPUT_POST, 'asientos_por_fila'));
                if ($action == "add_catalogo_avion") {
                    $myCatalogoAvionBo->add($mycatalogo_avion);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_catalogo_avion") {
                    $myCatalogoAvionBo->update($mycatalogo_avion);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_catalogo_avion") {//accion de consultar todos los registros
            $resultDB   = $myCatalogoAvionBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_catalogo_avion") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idcatalogo_avion') != null) {
                $mycatalogo_avion->setidcatalogo_avion(filter_input(INPUT_POST, 'idcatalogo_avion'));
                $mycatalogo_avion = $myCatalogoAvionBo->searchById($mycatalogo_avion);
                if ($mycatalogo_avion != null) {
                    echo json_encode(($mycatalogo_avion));
                } else {
                    echo('E~NO Existe un avión con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_catalogo_avion") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idcatalogo_avion') != null) {
                $mycatalogo_avion->setidcatalogo_avion(filter_input(INPUT_POST, 'idcatalogo_avion'));
                $mycatalogo_avion->delete($mycatalogo_avion);
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


