<?php

include_once "ConfigDB.php";

class BaseDeDatos{

    private $dbConfig;
    private $mysqli;

    function __construct()
    {
        try{
            $this->dbConfig = ConfigDB::getConfig();
            $this->mysqli = new mysqli(
                $this->dbConfig['hostname'],
                $this->dbConfig['usuario'],
                $this->dbConfig['password'],
                $this->dbConfig['base_datos'],
                $this->dbConfig['puerto']
            );
            if (!$this->mysqli->set_charset("utf8")) {// Condicional para asignar utf-8
                echo 'Error en codificacion';die;
         }
            if($this->mysqli->connect_errno){
                echo 'Error en la conexion base de datos';die;
            }
        }catch (Exception $ex){
            echo 'Error en la conexion de BD';die;
        }
    }

    public function consultaRegistros($tabla,$condicionales = array()){
        $condiciones = $this->obtenerCondicionalesWhereAnd($condicionales);
        $query = $this->mysqli->query("select * from ".$tabla.$condiciones);
        $datos = array();
        while($registro = $query->fetch_assoc()){
            $datos[] = $registro;
        }
        return $datos;
    }

    /**
     * @param $tabla
     * @param $valoresInsert
     * los valores insert es un array con los datos
     * array('nombre_columna1' => valor, 'nombre_columna' => valor)
     */
    public function insertarRegistro($tabla,$valoresInsert){
        $campos=$this->obtenerColumnasInsert($valoresInsert);
        $valores=$this->obtenerValuesInsert($valoresInsert);
        $query="INSERT INTO $tabla $campos VALUES $valores";
        $this->mysqli->query($query);
        return $valoresInsert;
    
    }

    public function actualizarRegistro($tabla,$valoresUpdate,$condicionales){
        $campos=$this->obtenerCamporvalores($valoresUpdate);
        $condiciones = $this->obtenerCondicionalesWhereAnd($condicionales);
        $query="UPDATE $tabla SET $campos $condiciones";
        $this->mysqli->query( $query);
    }

    public function eliminarRegistro($tabla,$id){
        $query="DELETE FROM $tabla WHERE id=$id";
        $this->mysqli->query($query);
    }

    /**  functiones privadas
     * */

    /**
     * @param $condicionales
     * @return string
     * funcion que recibe un arragle de condiciones para los SQL where
     * array(array('nombre_columna1'=> valor1), array('nombre_columna2'=> valor2),...)
     */
    private function obtenerCondicionalesWhereAnd($condicionales){
        $condiciones = " WHERE 1=1";
        foreach ($condicionales as $columna => $valor){
            $condiciones .= " AND $columna = '$valor'";
        }
        return $condiciones;
    }

    private function obtenerCamporvalores($condicionales){
        $condiciones='';
        foreach ($condicionales as $columna => $valor){
            $condiciones .= " $columna = '$valor',";
        }
        $condiciones= substr($condiciones,0,strlen($condiciones)-1);
        return $condiciones;
    }

    /**
     * @param $tabla
     * @param $condicionales
     * @return string
     * funcion que recibe un arragle de condiciones para los SQL where
     * array(array('nombre_columna1'=> valor1), array('nombre_columna2'=> valor2),...)
     */
    private function obtenerColumnasInsert($valores = array()){
        $campos = "(";
        foreach ($valores as $columna => $valor){
            $campos .= "".$columna.",";
        }
        $campos= substr($campos,0,strlen($campos)-1);
        $campos .= ")";
        return $campos;
    }


    private function obtenerValuesInsert($valores  = array()){
        $campos = "(";
        foreach ($valores as $columna => $valor){
            $campos .= "'".$valor."',";
        }
        $campos= substr($campos,0,strlen($campos)-1);
        $campos .= ")";
        return $campos;
    }
}