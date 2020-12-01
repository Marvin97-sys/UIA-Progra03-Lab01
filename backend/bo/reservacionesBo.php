<?php


require_once("../domain/reservaciones.php");
require_once("../dao/reservacionesDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class ReservacionesBo {

    private $reservacionesDao;

    public function __construct() {
        $this->reservacionesDao = new ReservacionesDao();
    }

    public function getReservacionesDao() {
        return $this->reservacionesDao;
    }

    public function setReservacionesDao(ReservacionesDao $reservacionesDao) {
        $this->reservacionesDao = $reservacionesDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Reservaciones $reservaciones) {
        try {
            if (!$this->reservacionesDao->exist($reservaciones)) {
                $this->reservacionesDao->add($reservaciones);
            } else {
                throw new Exception("El Personas ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a una persona a la base de datos
    //***********************************************************

    public function update(Reservaciones $reservaciones) {
        try {
            $this->reservacionesDao->update($reservaciones);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Reservaciones $reservaciones) {
        try {
            $this->reservacionesDao->delete($reservaciones);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Reservaciones $reservaciones) {
        try {
            return $this->reservacionesDao->searchById($reservaciones);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las personas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->reservacionesDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class PersonasBo
?>

