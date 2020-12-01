<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/rutas.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class RutasDao {

    
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
    //agrega a una ruta a la base de datos
    //***********************************************************

    public function add(Rutas $rutas) {
        try {
            $sql = sprintf("insert into mydb.rutas (idrutas, trayecto, duracion) 
                                          values (%s,%s,%s)",
                    $this->labAdodb->Param("idrutas"),
                    $this->labAdodb->Param("trayecto"),
                    $this->labAdodb->Param("duracion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idrutas"]     = $rutas->getidrutas();
            $valores["trayecto"]    = $rutas->gettrayecto();
            $valores["duracion"]    = $rutas->getduracion();            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase RutasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una ruta existe en la base de datos por ID
    //***********************************************************

    public function exist(Rutas $rutas) {
        $exist = false;
        try {
            $sql = sprintf("select * from mydb.rutas where  idrutas = %s ",
                            $this->labAdodb->Param("idrutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idrutas"] = $rutas->getidrutas();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase RutasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una ruta en la base de datos
    //***********************************************************

    public function update(Rutas $rutas) {
        try {
            $sql = sprintf("update rutas set trayecto = %s, 
                                                duracion = %s, 
                            where idrutas = %s",
                    $this->labAdodb->Param("trayecto"),
                    $this->labAdodb->Param("duracion"),
                    $this->labAdodb->Param("idrutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["trayecto"]      = $rutas->gettrayecto();
            $valores["duracion"]      = $rutas->getduracion();
            $valores["idrutas"]       = $rutas->getidrutas();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase RutasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una ruta en la base de datos
    //***********************************************************

    public function delete(Rutas $rutas) {

        
        try {
            $sql = sprintf("delete from rutas where  idrutas = %s",
                            $this->labAdodb->Param("idrutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["idrutas"] = $rutas->getidrutas();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase RutasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una ruta en la base de datos
    //***********************************************************

    public function searchById(Rutas $rutas) {
        $returnRutas = null;
        try {
            $sql = sprintf("select * from rutas where  idrutas = %s",
                            $this->labAdodb->Param("idrutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idrutas"] = $rutas->getidrutas();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnRutas = Rutas::createNullRutas();
                $returnRutas->setidvuelos($resultSql->Fields("idrutas"));
                $returnRutas->setfecha_hora($resultSql->Fields("trayecto"));
                $returnRutas->setrutas_idrutas($resultSql->Fields("duracion"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase RutasDao), error:'.$e->getMessage());
        }
        return $returnRutas;
    }

    //***********************************************************
    //obtiene la información de las rutas en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from mydb.rutas");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase RutasDao), error:'.$e->getMessage());
        }
    }

}

