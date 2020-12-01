<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/vuelosBo.php");
require_once ("../domain/vuelos.php");

$obj_vuelo = new Vuelos();
$obj_vuelo->setidvuelos(1);
$obj_vuelo->setfecha_hora("20201130");
$obj_vuelo->setrutas_idrutas(1);
$obj_vuelo->setcatalogo_avion_idcatalogo_avion(1);

$bo_vuelo = new VuelosBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_vuelo->add($obj_vuelo);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_vuelo->update($obj_vuelo);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_vuelo->delete($obj_vuelo);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $vueloConsultado = $bo_vuelo->searchById($obj_vuelo);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($vueloConsultado));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_vuelo->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}


