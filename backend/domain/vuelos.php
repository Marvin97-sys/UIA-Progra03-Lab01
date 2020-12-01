<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Vuelos extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idvuelos;
    private $fecha_hora;
    private $rutas_idrutas;
    private $catalogo_avion_idcatalogo_avion;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullVuelos() {
        $instance = new self();
        return $instance;
    }

    public static function createVuelos($idvuelos, $fecha_hora, $rutas_idrutas, $catalogo_avion_idcatalogo_avion) {
        $instance = new self();
        $instance->idvuelos       = $idvuelos;
        $instance->fecha_hora           = $fecha_hora;
        $instance->rutas_idrutas        = $rutas_idrutas;
        $instance->catalogo_avion_idcatalogo_avion        = $catalogo_avion_idcatalogo_avion;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getIdvuelos() {
        return $this->idvuelos;
    }

    public function setIdvuelos($idvuelos) {
        $this->idvuelos = $idvuelos;
    }

    /****************************************************************************/

    public function getFecha_hora() {
        return $this->fecha_hora;
    }

    public function setFecha_hora($fecha_hora) {
        $this->fecha_hora = $fecha_hora;
    }

    /****************************************************************************/

    public function getRutas_idrutas() {
        return $this->rutas_idrutas;
    }

    public function setRutas_idrutas($rutas_idrutas) {
        $this->rutas_idrutas = $rutas_idrutas;
    }

    /****************************************************************************/

    public function getCatalogo_avion_idcatalogo_avion() {
        return $this->catalogo_avion_idcatalogo_avion;
    }

    public function setCatalogo_avion_idcatalogo_avion($catalogo_avion_idcatalogo_avion) {
        $this->catalogo_avion_idcatalogo_avion = $catalogo_avion_idcatalogo_avion;
    }

    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

