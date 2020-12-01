<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/reservaciones.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base


class ReservacionesDao {

    
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
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Reservaciones $reservaciones) {
        try {
            $sql = sprintf("insert into mydb.reservaciones (idreservaciones, usuario_idusuario, vuelos_idvuelos, fecha_reservacion, numero_fila, numero_asiento) 
                                          values (%s,%s,%s,%s,%s,%s)",
                    $this->labAdodb->Param("idreservaciones"),
                    $this->labAdodb->Param("usuario_idusuario"),
                    $this->labAdodb->Param("vuelos_idvuelos"),
                    $this->labAdodb->Param("fecha_reservacion"),
                    $this->labAdodb->Param("numero_fila"),
                    $this->labAdodb->Param("numero_asiento"));
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idreservaciones"]       = $reservaciones->getidreservaciones();
            $valores["usuario_idusuario"]          = $reservaciones->getusuario_idusuario();
            $valores["vuelos_idvuelos"]       = $reservaciones->getvuelos_idvuelos();
            $valores["fecha_reservacion"]       = $reservaciones->getfecha_reservacion();
            $valores["numero_fila"]       = $reservaciones->getnumero_fila();
            $valores["numero_asiento"]   = $reservaciones->getnumero_asiento();
            

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Reservaciones $reservaciones) {
        $exist = false;
        try {
            $sql = sprintf("select * from mydb.reservaciones where  idreservaciones = %s ",
                            $this->labAdodb->Param("idreservaciones"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idreservaciones"] = $reservaciones->getidreservaciones();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Reservaciones $reservaciones) {
        try {
            $sql = sprintf("update reservaciones set usuario_idusuario = %s, 
                                                vuelos_idvuelos = %s, 
                                                fecha_reservacion = %s, 
                                                numero_fila = %s, 
                                                numero_asiento = %s, 
                                                
                            where idreservaciones = %s",
                    $this->labAdodb->Param("usuario_idusuario"),
                    $this->labAdodb->Param("vuelos_idvuelos"),
                    $this->labAdodb->Param("fecha_reservacion"),
                    $this->labAdodb->Param("numero_fila"),
                    $this->labAdodb->Param("numero_asiento"),
                    
                    $this->labAdodb->Param("idreservaciones"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["usuario_idusuario"]          = $reservaciones->getusuario_idusuario();
            $valores["vuelos_idvuelos"]       = $reservaciones->getvuelos_idvuelos();
            $valores["fecha_reservacion"]       = $reservaciones->getfecha_reservacion();
            $valores["numero_fila"]   = $reservaciones->getnumero_fila();
            $valores["numero_asiento"]            = $reservaciones->getnumero_asiento();
            
            $valores["idreservaciones"]       = $reservaciones->getidreservaciones();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Reservaciones $reservaciones) {

        
        try {
            $sql = sprintf("delete from reservaciones where  idreservaciones = %s",
                            $this->labAdodb->Param("idreservaciones"));
            $sqlParam = $this->labAdodb->Prepare($sql);
            $valores = array();
            $valores["idreservaciones"] = $reservaciones->getidreservaciones();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Reservaciones $reservaciones) {
        $returnReservaciones = null;
        try {
            $sql = sprintf("select * from reservaciones where  idreservaciones = %s",
                            $this->labAdodb->Param("idreservaciones"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idreservaciones"] = $reservaciones->getidreservaciones();
            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnReservaciones = Reservaciones::createNullReservaciones();
                $returnReservaciones->setidreservaciones($resultSql->Fields("idreservaciones"));
                $returnReservaciones->setusuario_idusuario($resultSql->Fields("usuario_idusuario"));
                $returnReservaciones->setavuelos_idvuelos($resultSql->Fields("vuelos_idvuelos"));
                $returnReservaciones->setfecha_reservacion($resultSql->Fields("fecha_reservacion"));
                $returnReservaciones->setnumero_fila($resultSql->Fields("numero_fila"));
                $returnReservaciones->setnumero_asiento($resultSql->Fields("numero_asiento"));
                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase PersonasDao), error:'.$e->getMessage());
        }
        return $returnReservaciones;
    }

    //***********************************************************
    //obtiene la información de las personas en la base de datos
    //***********************************************************
    
    public function getAll() {
        try {
            $sql = sprintf("select * from mydb.reservaciones");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

}


