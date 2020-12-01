<?php


require_once("../domain/rutas.php");
require_once("../dao/rutasDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class RutasBo {

    private $RutasDao;

    public function __construct() {
        $this->rutasDao = new RutasDao();
    }

    public function getRutasDao() {
        return $this->rutasDao;
    }

    public function setRutasDao(RutasDao $rutasDao) {
        $this->rutasDao = $rutasDao;
    }

    //***********************************************************
    //agrega a una ruta a la base de datos
    //***********************************************************

    public function add(Rutas $rutas) {
        try {
            if (!$this->rutasDao->exist($rutas)) {
                $this->rutasDao->add($rutas);
            } else {
                throw new Exception("La ruta ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a una ruta a la base de datos
    //***********************************************************

    public function update(Rutas $rutas) {
        try {
            $this->rutasDao->update($rutas);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una ruta a la base de datos
    //***********************************************************

    public function delete(Rutas $rutas) {
        try {
            $this->rutasDao->delete($rutas);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una ruta a la base de datos
    //***********************************************************

    public function searchById(Rutas $rutas) {
        try {
            return $this->rutasDao->searchById($rutas);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las rutas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->rutasDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class RutasBo
?>



