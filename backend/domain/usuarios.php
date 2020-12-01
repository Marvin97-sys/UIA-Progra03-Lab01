<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Usuarios extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idusuarios;
    private $contraseña;
    private $fecha_registro;
    private $fecha_actualizacion;
    private $personas_idpersonas;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullUsuarios() {
        $instance = new self();
        return $instance;
    }

    public static function createUsuarios($idusuarios, $contraseña, $fecha_registro, $fecha_actualizacion, $personas_idpersonas) {
        $instance = new self();
        $instance->idusuarios        = $idusuarios;
        $instance->contraseña          = $contraseña;
        $instance->fecha_registro       = $fecha_registro;
        $instance->fecha_actualizacion        = $fecha_actualizacion;
        $instance->personas_idpersonas        = $personas_idpersonas;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getIdusuarios() {
        return $this->idusuarios;
    }

    public function setIdusuario($idusuarios) {
        $this->idusuarios = $idusuarios;
    }

    /****************************************************************************/

    public function getContraseña() {
        return $this->contraseña;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    /****************************************************************************/

    public function getFecha_registro() {
        return $this->fecha_registro;
    }

    public function setFecha_registro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }

    /****************************************************************************/

    public function getFecha_actualizacion() {
        return $this->fecha_actualizacion;
    }

    public function setFecha_actualizacion($fecha_actualizacion) {
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    /****************************************************************************/
    public function getPersonas_idpersonas() {
        return $this->personas_idpersonas;
    }

    public function setPersonas_idpersonas($personas_idpersonas) {
        $this->personas_idpersonas = $personas_idpersonas;
    }
    

    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}



