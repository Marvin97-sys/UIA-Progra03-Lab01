<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/personasBo.php");
require_once ("../domain/personas.php");

$obj_persona = new Personas();
$obj_persona->setIdpersonas(100010001);
$obj_persona->setNombre("Francisco");
$obj_persona->setApellido1("Alfaro");
$obj_persona->setApellido2("Calderón");
$obj_persona->setCorreo_Electronico("franalfa16@gmail.com");
$obj_persona->setFecha_nacimiento("19951216");
$obj_persona->setDireccion("grecia");
$obj_persona->setTelefono("70572625");
$obj_persona->setLastUser("chgari");

$bo_persona = new PersonasBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_persona->add($obj_persona);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_persona->update($obj_persona);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_persona->delete($obj_persona);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $personaConsultada = $bo_persona->searchById($obj_persona);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($personaConsultada));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_persona->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}
