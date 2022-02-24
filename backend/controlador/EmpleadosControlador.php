<?php

include_once "modelo/EmpleadoModelo.php";
include_once "modelo/ContactoEmpleadoModelo.php";

class EmpleadosControlador
{

    private $empleadoModelo;
    private $contactoEmpleadoModelo;

    function __construct()
    {
        $this->empleadoModelo = new EmpleadoModelo();
        $this->contactoEmpleadoModelo = new ContactoEmpleadoModelo();
    }

    public function listado(){
        $empleadoDatos = $this->empleadoModelo->obtenerListado();
        $empleadoRespuesta = array();
        foreach ($empleadoDatos as $index => $empleado){
            $condicionesWhere = array(
                'empleado_id' => $empleado['id']
            );
            $contactoEmpleado = $this->contactoEmpleadoModelo->obtenerListado($condicionesWhere);
            $empleado['datos_contacto'] = $contactoEmpleado;
            $empleadoRespuesta[$index] = $empleado;
        }
        //var_dump($empleadoDatos,$empleadoRespuesta);exit;
        return array(
            'success' => true,
            'msg' => array('Se obtuvo el listado de empleados correctamente'),
            'data' => array(
                'empleados' => $empleadoRespuesta
            )
        );
    }

    public function agregar(){
        $empleadoDatos = array('nombre' => 'Miguel', 'paterno' => 'Gonzalez');
        $empleadoRespuesta=$this->empleadoModelo->registroEmpleado( $empleadoDatos);
        return array(
            'success' => true,
            'msg' => array('Se registro correctamente el empleado'),
            'data' => array(
                'empleados' => $empleadoRespuesta
            )
        );
    }

    public function actualizar(){
        $empleadoDatos = array('nombre' => 'gato', 'paterno' => 'perez');
        $condiciones = array('id' => 5);
        $this->empleadoModelo->update( $empleadoDatos,  $condiciones);
        return array(
            'success' => true,
            'msg' => array('Se actualizo correctamente el empleado'),
            'data' => array(
                'empleados' => $empleadoDatos
            )
        );

    }

    public function eliminar($id){
       $this->empleadoModelo->eliminar($id);
        return array(
            'success' => true,
            'msg' => array('Se elimino correctamente el empleado')
        );
    }

}