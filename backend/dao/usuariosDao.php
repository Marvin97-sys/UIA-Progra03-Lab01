<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/usuarios.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base
//$this->labAdodb->debug=true;

class UsuariosDao {

    private $labAdodb;
    
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
    //agrega una direccion a la base de datos
    //***********************************************************

    public function add(Usuarios $usuarios) {

        
        try {
            $sql = sprintf("insert into mydb.usuarios (idusuarios, contraseña, fecha_registro, fecha_actualizacion,  personas_idpersonas) 
                                          values (%s,%s,%s,%s,%s)",
                    $this->labAdodb->Param("idusuarios"),
                    $this->labAdodb->Param("contraseña"),
                    $this->labAdodb->Param("fecha_registro"),
                    $this->labAdodb->Param("fecha_actualizacion"),
                    $this->labAdodb->Param("personas_idpersonas"));     
            
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idusuarios"]       = $usuarios->getidusuarios();
            $valores["contraseña"]          = $usuarios->getcontraseña();
            $valores["fecha_registro"]       = $usuarios->getfecha_registro();
            $valores["fecha_actualizacion"]       = $usuarios->getfecha_actualizacion();
            $valores["personas_idpersonas"]       = $usuarios->getpersonas_idpersonas();
            

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase usuariosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una direccion existe en la base de datos por ID
    //***********************************************************

    public function exist(Usuarios $usuarios) {

        
        $exist = false;
        try {
            $sql = sprintf("select * from mydb.usuarios where  idusuarios = %s ",
                            $this->labAdodb->Param("idusuarios"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idusuarios"] = $usuarios->getidusuarios();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase UsuariosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una direccion en la base de datos
    //***********************************************************

    public function update(Usuarios $usuarios) {

        
        try {
            $sql = sprintf("update usuarios set contraseña = %s, 
                                                fecha_registro = %s, 
                                                fecha_actualizacion = %s,  
                                                personas_idpersonas = %s, 
                                                 
                            where idusuario = %s",
                    $this->labAdodb->Param("contraseña"),
                    $this->labAdodb->Param("fecha_registro"),
                    $this->labAdodb->Param("fecha_actualizacion"),
                    $this->labAdodb->Param("personas_idpersonas"),
                    $this->labAdodb->Param("idusuarios"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["contraseña"]          = $usuarios->getcontraseña();
            $valores["fecha_registro"]       = $usuarios->getfecha_registro();
            $valores["fecha_actualizacion"]       = $usuarios->getfecha_actualizacion();
            $valores["personas_idpersonas"]       = $usuarios->getpersonas_idpersonas();            
            $valores["idusuarios"]       = $usuarios->getidusuarios();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase UsuariosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una direccion en la base de datos
    //***********************************************************

    public function delete(Usuarios $usuarios) {

        
        try {
            $sql = sprintf("delete from usuarios where  idusuario = %s",
                            $this->labAdodb->Param("idusuario"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idusuarios"] = $usuarios->getidusuarios();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase UsuaiosDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca una direccion en la base de datos
    //***********************************************************

    public function searchById(Usuarios $usuarios) {

        
        $returnUsuarios = null;
        try {
            $sql = sprintf("select * from usuarios where  idusuario = %s",
                            $this->labAdodb->Param("idusuario"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idusuario"] = $usuarios->getidusuario();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnUsuarios = usuarios::createNullusuarios();
                $returnUsuarios->setidusuario($resultSql->Fields("idusuario"));
                $returnUsuarios->setcontraseña($resultSql->Fields("contraseña"));
                $returnUsuarios->setfecha_registro($resultSql->Fields("fecha_registro"));
                $returnUsuarios->setfecha_actualizacion($resultSql->Fields("fecha_actualizacion"));
                $returnUsuarios->setpersonas_idpersonas($resultSql->Fields("personas_idpersonas"));
                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase DireccionesDao), error:'.$e->getMessage());
        }
        return $returnUsuarios;
    }

    //***********************************************************
    //obtiene la información de la direccion en la base de datos
    //***********************************************************
    
    public function getAll() {

        
        try {
            $sql = sprintf("select * from usuarios");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase DireccionesDao), error:'.$e->getMessage());
        }
    }

}

