<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Rutas extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idrutas;
    private $trayecto;
    private $duracion;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullRutas() {
        $instance = new self();
        return $instance;
    }

    public static function createRutas($idrutas, $trayecto, $duracion) {
        $instance = new self();
        $instance->idrutas       = $idrutas;
        $instance->trayecto      = $trayecto;
        $instance->duracion      = $duracion;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getIdRutas() {
        return $this->idrutas;
    }

    public function setIdRutas($idrutas) {
        $this->idrutas = $idrutas;
    }

    /****************************************************************************/

    public function getTrayecto() {
        return $this->trayecto;
    }

    public function setTrayecto($trayecto) {
        $this->trayecto = $trayecto;
    }

    /****************************************************************************/

    public function getDuracion() {
        return $this->duracion;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

