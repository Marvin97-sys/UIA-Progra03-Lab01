<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class CatalogoAvion extends BaseDomain implements \JsonSerializable{

    //attributes
    private $idcatalogo_avion;
    private $año;
    private $modelo;
    private $marca;
    private $cantidad_filas;
    private $asientos_por_fila;

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullCatalogoAvion() {
        $instance = new self();
        return $instance;
    }

    public static function createCatalogoAvion($idcatalogo_avion, $año, $modelo, $marca, $cantidad_filas, $asientos_por_fila) {
        $instance = new self();
        $instance->idcatalogo_avion       = $idcatalogo_avion;
        $instance->año                   = $año;
        $instance->modelo                = $modelo;
        $instance->marca                 = $marca;
        $instance->cantidad_filas        = $cantidad_filas;
        $instance->asientos_por_fila     = $asientos_por_fila;
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getidcatalogo_avion() {
        return $this->idcatalogo_avion;
    }

    public function setidcatalogo_avion($idcatalogo_avion) {
        $this->idcatalogo_avion = $idcatalogo_avion;
    }

    /****************************************************************************/

    public function getaño() {
        return $this->año;
    }

    public function setaño($año) {
        $this->año = $año;
    }

    /****************************************************************************/

    public function getmodelo() {
        return $this->modelo;
    }

    public function setmodelo($modelo) {
        $this->modelo = $modelo;
    }
    /****************************************************************************/

    public function getmarca() {
        return $this->marca;
    }

    public function setmarca($marca) {
        $this->marca = $marca;
    }
    /****************************************************************************/

    public function getcantidad_filas() {
        return $this->cantidad_filas;
    }

    public function setcantidad_filas($cantidad_filas) {
        $this->cantidad_filas = $cantidad_filas;
    }
    /****************************************************************************/

    public function getasientos_por_fila() {
        return $this->asientos_por_fila;
    }

    public function setasientos_por_fila($asientos_por_fila) {
        $this->asientos_por_fila = $asientos_por_fila;
    }

    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
