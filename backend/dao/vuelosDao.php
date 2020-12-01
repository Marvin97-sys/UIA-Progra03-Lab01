<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/vuelos.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class VuelosDao {

    
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
    //agrega a un vuelo a la base de datos
    //***********************************************************

    public function add(Vuelos $vuelos) {
        try {
            $sql = sprintf("insert into mydb.vuelos (idvuelos, fecha_hora, rutas_idrutas, catalogo_avion_idcatalogo_avion) 
                                          values (%s,%s,%s,%s)",
                    $this->labAdodb->Param("idvuelos"),
                    $this->labAdodb->Param("fecha_hora"),
                    $this->labAdodb->Param("rutas_idrutas"),
                    $this->labAdodb->Param("catalogo_avion_idcatalogo_avion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idvuelos"]       = $vuelos->getidvuelos();
            $valores["fecha_hora"]      = $vuelos->getfecha_hora();
            $valores["rutas_idrutas"]    = $vuelos->getrutas_idrutas();
            $valores["catalogo_avion_idcatalogo_avion"]       = $vuelos->getcatalogo_avion_idcatalogo_avion();
            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase VuelosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si un vuelo existe en la base de datos por ID
    //***********************************************************

    public function exist(Vuelos $vuelos) {
        $exist = false;
        try {
            $sql = sprintf("select * from mydb.vuelos where  idvuelos = %s ",
                            $this->labAdodb->Param("idvuelos"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idvuelos"] = $vuelos->getidvuelos();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase VuelosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica un vuelo en la base de datos
    //***********************************************************

    public function update(Vuelos $vuelos) {
        try {
            $sql = sprintf("update vuelos set fecha_hora = %s, 
                                                rutas_idrutas = %s, 
                                                catalogo_avion_idcatalogo_avion = %s,
                            where idvuelos = %s",
                    $this->labAdodb->Param("fecha_hora"),
                    $this->labAdodb->Param("rutas_idrutas"),
                    $this->labAdodb->Param("catalogo_avion_idcatalogo_avion"),
                    $this->labAdodb->Param("idvuelos"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["fecha_hora"]          = $vuelos->getfecha_hora();
            $valores["rutas_idrutas"]       = $vuelos->getrutas_idrutas();
            $valores["catalogo_avion_idcatalogo_avion"]       = $vuelos->getcatalogo_avion_idcatalogo_avion();
            $valores["idvuelos"]       = $vuelos->getidvuelos();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase VuelosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina un vuelo en la base de datos
    //***********************************************************

    public function delete(Vuelos $vuelos) {

        
        try {
            $sql = sprintf("delete from vuelos where  idvuelos = %s",
                            $this->labAdodb->Param("idvuelos"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["idvuelos"] = $vuelos->getidvuelos();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase VuelosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a un vuelo en la base de datos
    //***********************************************************

    public function searchById(Vuelos $vuelos) {
        $returnVuelos = null;
        try {
            $sql = sprintf("select * from vuelos where  idvuelos = %s",
                            $this->labAdodb->Param("idvuelos"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idvuelos"] = $vuelos->getidvuelos();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnVuelos = Vuelos::createNullVuelos();
                $returnVuelos->setidvuelos($resultSql->Fields("idvuelos"));
                $returnVuelos->setfecha_hora($resultSql->Fields("fecha_hora"));
                $returnVuelos->setrutas_idrutas($resultSql->Fields("rutas_idrutas"));
                $returnVuelos->setcatalogo_avion_idcatalogo_avion($resultSql->Fields("catalogo_avion_idcatalogo_avion"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase VuelosDao), error:'.$e->getMessage());
        }
        return $returnVuelos;
    }

    //***********************************************************
    //obtiene la información de los vuelos en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from mydb.vuelos");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase VuelosDao), error:'.$e->getMessage());
        }
    }

}
 