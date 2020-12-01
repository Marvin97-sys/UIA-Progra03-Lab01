<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Reservaciones extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idreservaciones;
    private $usuario_idusuario;
    private $vuelos_idvuelos;
    private $fecha_reservacion;
    private $numero_fila;
    private $numero_asiento;
    

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullReservaciones() {
        $instance = new self();
        return $instance;
    }

    public static function createReservaciones($idreservaciones, $usuario_idusuario, $vuelos_idvuelos, $fecha_reservacion, $numero_fila, $numero_asiento) {
        $instance = new self();
        $instance->idreservaciones       = $idreservaciones;
        $instance->usuario_idusuario          = $usuario_idusuario;
        $instance->vuelos_idvuelos       = $vuelos_idvuelos;
        $instance->fecha_reservacion        = $fecha_reservacion;
        $instance->numero_fila    = $numero_fila;
        $instance->numero_asiento             = $numero_asiento;
       
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getIdreservaciones() {
        return $this->idreservaciones;
    }

    public function setIdreservaciones($idreservaciones) {
        $this->idreservaciones = $idreservaciones;
    }

    /****************************************************************************/

    public function getUsuario_idusuario() {
        return $this->usuario_idusuario;
    }

    public function setUsuario_idusuario($usuario_idusuario) {
        $this->usuario_idusuario = $usuario_idusuario;
    }

    /****************************************************************************/

    public function getVuelos_idvuelos() {
        return $this->vuelos_idvuelos;
    }

    public function setVuelos_idvuelos($vuelos_idvuelos) {
        $this->vuelos_idvuelos = $vuelos_idvuelos;
    }

    /****************************************************************************/

    public function getfecha_reservacion() {
        return $this->fecha_reservacion;
    }

    public function setfecha_reservacion($fecha_reservacion) {
        $this->fecha_reservacion = $fecha_reservacion;
    }

    
    /****************************************************************************/

    public function getNumero_fila() {
        return $this->numero_fila;
    }

    public function setNumero_fila($numero_fila) {
        $this->numero_fila = $numero_fila;
    }
    /****************************************************************************/

    public function getNumero_asiento() {
        return $this->numero_asiento;
    }

    public function setNumero_asiento($numero_asiento) {
        $this->numero_asiento = $numero_asiento;
    }

    /****************************************************************************/

    
    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}