<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Personas extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idpersonas;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $correo_electronico;
    private $fecha_nacimiento;
    private $direccion;
    private $telefono;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullPersonas() {
        $instance = new self();
        return $instance;
    }

    public static function createPersonas($idpersonas, $nombre, $apellido1, $apellido2, $correo_electronico, $fecha_nacimiento, $direccion, $telefono, $ultUsuario, $ultModificacion, $lastUser, $lastModification) {
        $instance = new self();
        $instance->idpersonas       = $idpersonas;
        $instance->nombre           = $nombre;
        $instance->apellido1        = $apellido1;
        $instance->apellido2        = $apellido2;
        $instance->correo_electronico    = $correo_electronico;
        $instance->fecha_nacimiento             = $fecha_nacimiento;
        $instance->direccion    = $direccion;
        $instance->telefono    = $telefono;
        $instance->setLastUser($ultUsuario);
        $instance->setLastModification($ultModificacion);
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getIdpersonas() {
        return $this->idpersonas;
    }

    public function setIdpersonas($idpersonas) {
        $this->idpersonas = $idpersonas;
    }

    /****************************************************************************/

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /****************************************************************************/

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    /****************************************************************************/

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    
    /****************************************************************************/

    public function getCorreo_Electronico() {
        return $this->correo_electronico;
    }

    public function setCorreo_Electronico($correo_electronico) {
        $this->correo_electronico = $correo_electronico;
    }
    /****************************************************************************/

    public function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    public function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /****************************************************************************/

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    /****************************************************************************/

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    /****************************************************************************/

    public function getUltUsuario() {
        return $this->ultUsuario;
    }

    public function setUltUsuario($ultUsuario) {
        $this->ultUsuario = $ultUsuario;
    }

    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}