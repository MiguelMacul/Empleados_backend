<?php

/**
 * realizar las operaciones basicas de la base de datos
 * CRUD: select, update, delete, insert
 * dinamicamente es el nombre de la tabla
 */

include_once "BaseDeDatos.php";

class ModeloBase extends BaseDeDatos
{

    private $tabla;

    function __construct($nombreTabla)
    {
        parent::__construct();
        $this->tabla = $nombreTabla;
    }

    public function obtenerListado($condiciones = array()){
        return $this->consultaRegistros($this->tabla,$condiciones);
    }

    public function registroEmpleado($valores = array()){
        return $this->insertarRegistro($this->tabla, $valores);
    }

    public function eliminar($valores = array()){
        return $this->eliminarRegistro($this->tabla, $valores);
    }
    public function update($valores = array(), $condiciones = array()){
        return $this->actualizarRegistro($this->tabla, $valores, $condiciones);
    }
}