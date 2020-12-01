<?php


require_once("../domain/CatalogoAvion.php");
require_once("../dao/CatalogoAvionDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class CatalogoAvionBo {

    private $CatalogoAvionDao;

    public function __construct() {
        $this->CatalogoAvionDao = new CatalogoAvionDao();
    }

    public function getCatalogoAvion() {
        return $this->CatalogoAvionDao;
    }

    public function setCatalogoAvionDao(CatalogoAvionDao $CatalogoAvionDao) {
        $this->CatalogoAvionDao = $CatalogoAvionDao;
    }

    //***********************************************************
    //agrega a un avion a la base de datos
    //***********************************************************

    public function add(CatalogoAvion $CatalogoAvion) {
        try {
            if (!$this->CatalogoAvionDao->exist($CatalogoAvion)) {
                $this->CatalogoAvionDao->add($CatalogoAvion);
            } else {
                throw new Exception("El Catalogo ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a un avión a la base de datos
    //***********************************************************

    public function update(CatalogoAvion $CatalogoAvion) {
        try {
            $this->CatalogoAvionDao->update($CatalogoAvion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a un avion a la base de datos
    //***********************************************************

    public function delete(CatalogoAvion $CatalogoAvion) {
        try {
            $this->CatalogoAvionDao->delete($CatalogoAvion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a un avion a la base de datos
    //***********************************************************

    public function searchById(CatalogoAvion $CatalogoAvion) {
        try {
            return $this->CatalogoAvionDao->searchById($CatalogoAvion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todos los catologos de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->CatalogoAvionDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class CatalogoAvionBo
?>


