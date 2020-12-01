<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/CatalogoAvionBo.php");
require_once ("../domain/CatalogoAvion.php");

$obj_avion = new CatalogoAvion();
$obj_avion->setidcatalogo_avion(1);
$obj_avion->setaño("2015");
$obj_avion->setmodelo("Boeing 747-400");
$obj_avion->setmarca("British Airways");
$obj_avion->setcantidad_filas(5);
$obj_avion->setasientos_por_fila(100);

$bo_avion = new CatalogoAvionBo();

$operacion = 1; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_avion->add($obj_avion);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_avion->update($obj_avion);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_avion->delete($obj_avion);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $avionConsultado = $bo_avion->searchById($obj_avion);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($avionConsultado));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_avion->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}

