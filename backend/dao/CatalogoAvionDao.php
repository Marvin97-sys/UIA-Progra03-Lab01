<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/CatalogoAvion.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class CatalogoAvionDao {

    
    private $labAdodb;//objeto de conexion con la base de datos    
    
    public function __construct() {
        //se crea el objeto con la conexión de la base de datos
        //según los datos del servidor de mysql
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        $this->labAdodb->setCharset('utf8');
        $this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        //los cados de conexión   host,       user,   pass,   basedatos
        $this->labAdodb->Connect("127.0.0.1", "root", "root", "mydb");   
        
        //si se desea hacer debug del SQL que se genera en la base de datos
        //dependiendo del error es necesario ver si es un error directamente
        //en la base de datos
        $this->labAdodb->debug=false;
    }

    //***********************************************************
    //agrega a un avion a la base de datos
    //***********************************************************

    public function add(CatalogoAvion $CatalogoAvion) {
        try {
            $sql = sprintf("insert into mydb.catalogo_avion (idcatalogo_avion, año, modelo, marca, cantidad_filas, asientos_por_fila) 
                                          values (%s,%s,%s,%s,%s,%s)",
                    $this->labAdodb->Param("idcatalogo_avion"),
                    $this->labAdodb->Param("año"),
                    $this->labAdodb->Param("modelo"),
                    $this->labAdodb->Param("marca"),
                    $this->labAdodb->Param("cantidad_filas"),
                    $this->labAdodb->Param("asientos_por_fila"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idcatalogo_avion"]    = $CatalogoAvion->getidcatalogo_avion();
            $valores["año"]                 = $CatalogoAvion->getaño();
            $valores["modelo"]              = $CatalogoAvion->getmodelo();    
            $valores["marca"]               = $CatalogoAvion->getmarca();
            $valores["cantidad_filas"]      = $CatalogoAvion->getcantidad_filas();
            $valores["asientos_por_fila"]   = $CatalogoAvion->getasientos_por_fila();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase CatalogoAvionDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si un avion existe en la base de datos por ID
    //***********************************************************

    public function exist(CatalogoAvion $CatalogoAvion) {
        $exist = false;
        try {
            $sql = sprintf("select * from mydb.catalogo_avion where  idcatalogo_avion = %s ",
                            $this->labAdodb->Param("idcatalogo_avion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idcatalogo_avion"] = $CatalogoAvion->getidcatalogo_avion();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase CatalogoAvionDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica un avion en la base de datos
    //***********************************************************

    public function update(CatalogoAvion $CatalogoAvion) {
        try {
            $sql = sprintf("update catalogo_avion set año = %s, 
                                                modelo = %s, 
                                                marca = %s,
                                                cantidad_filas = %s,
                                                asientos_por_fila = %s,
                            where idcatalogo_avion = %s",
                    $this->labAdodb->Param("año"),
                    $this->labAdodb->Param("modelo"),
                    $this->labAdodb->Param("marca"),
                    $this->labAdodb->Param("cantidad_filas"),
                    $this->labAdodb->Param("asientos_por_fila"),
                    $this->labAdodb->Param("idcatalogo_avion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["año"]               = $CatalogoAvion->getaño();
            $valores["modelo"]            = $CatalogoAvion->getmodelo();
            $valores["marca"]             = $CatalogoAvion->getmarca();
            $valores["cantidad_filas"]    = $CatalogoAvion->getcantidad_filas();
            $valores["asientos_por_fila"] = $CatalogoAvion->getasientos_por_fila();
            $valores["idcatalogo_avion"]  = $CatalogoAvion->getidcatalogo_avion();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase CatalogoAvionDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina un avion en la base de datos
    //***********************************************************

    public function delete(CatalogoAvion $CatalogoAvion) {

        
        try {
            $sql = sprintf("delete from catalogo_avion where  idcatalogo_avion = %s",
                            $this->labAdodb->Param("idcatalogo_avion"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["idcatalogo_avion"] = $CatalogoAvion->getidcatalogo_avion();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase CatalogoAvionDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a un avion en la base de datos
    //***********************************************************

    public function searchById(CatalogoAvion $CatalogoAvion) {
        $returnCatalogoAvion = null;
        try {
            $sql = sprintf("select * from catalogo_avion where  idcatalogo_avion = %s",
                            $this->labAdodb->Param("idcatalogo_avion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idcatalogo_avion"] = $CatalogoAvion->getidcatalogo_avion();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnCatalogoAvion = Rutas::createNullCatalogoAvion();
                $returnCatalogoAvion->setidcatalogo_avion($resultSql->Fields("idcatalogo_avion"));
                $returnCatalogoAvion->setaño($resultSql->Fields("año"));
                $returnCatalogoAvion->setmodelo($resultSql->Fields("modelo"));
                $returnCatalogoAvion->setmarca($resultSql->Fields("marca"));
                $returnCatalogoAvion->setcantidad_filas($resultSql->Fields("cantidad_filas"));
                $returnCatalogoAvion->setasientos_por_fila($resultSql->Fields("asientos_por_fila"));
                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase CatalogoAvionDao), error:'.$e->getMessage());
        }
        return $returnCatalogoAvion;
    }

    //***********************************************************
    //obtiene la información de los catologos en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from mydb.catalogo_avion");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase CatalogoAvionDao), error:'.$e->getMessage());
        }
    }
}

