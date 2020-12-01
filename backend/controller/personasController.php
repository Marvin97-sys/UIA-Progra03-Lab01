

<?php

require_once("../bo/personasBo.php");
require_once("../domain/personas.php");


/**
 * This class contain all services methods of the table Personas
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// Personas Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myPersonasBo = new PersonasBo();
        $myPersonas = Personas::createNullPersonas();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_personas" or $action === "update_personas") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idpersonas') != null) && (filter_input(INPUT_POST, 'nombre') != null) && (filter_input(INPUT_POST, 'apellido1') != null) && (filter_input(INPUT_POST, 'apellido2') != null) && (filter_input(INPUT_POST, 'correo_electronico') != null) && (filter_input(INPUT_POST, 'fecha_nacimiento') != null) && (filter_input(INPUT_POST, 'direccion') != null)  && (filter_input(INPUT_POST, 'telefono') != null)) {
                $myPersonas->setidpersonas(filter_input(INPUT_POST, 'idpersonas'));
                $myPersonas->setnombre(filter_input(INPUT_POST, 'nombre'));
                $myPersonas->setapellido1(filter_input(INPUT_POST, 'apellido1'));
                $myPersonas->setapellido2(filter_input(INPUT_POST, 'apellido2'));
                $myPersonas->setcorreo_electronico(filter_input(INPUT_POST, 'correo_electronico'));
                $myPersonas->setfecha_nacimiento(filter_input(INPUT_POST, 'fecha_nacimiento'));
                $myPersonas->setdireccion(filter_input(INPUT_POST, 'direccion'));
                $myPersonas->settelefono(filter_input(INPUT_POST, 'telefono'));
                $myPersonas->setLastUser('112540148');
                
                if ($action == "add_personas") {
                    $myPersonasBo->add($myPersonas);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_personas") {
                    $myPersonasBo->update($myPersonas);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_personas") {//accion de consultar todos los registros
            $resultDB   = $myPersonasBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_personas") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idpersonas') != null) {
                $myPersonas->setidpersonas(filter_input(INPUT_POST, 'idpersonas'));
                $myPersonas = $myPersonasBo->searchById($myPersonas);
                if ($myPersonas != null) {
                    echo json_encode(($myPersonas));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_personas") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idpersonas') != null) {
                $myPersonas->setidpersonas(filter_input(INPUT_POST, 'idpersonas'));
                $myPersonasBo->delete($myPersonas);
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
