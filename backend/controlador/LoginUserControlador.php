<?php

include_once "modelo/UserModelo.php";
include_once "helper/ValidacionFormulario.php";

class LoginUserControlador
{

    private $usuarioModelo;

    function __construct()
    {
        $this->usuarioModelo = new UserModelo();
    }

    public function elemento($usuario, $password){
        $condicionesWhere = array(
            'email' => $usuario,
            'password' => $password
        );
        $empleadoDatos = $this->usuarioModelo->obtenerElemento($condicionesWhere);
        if(count($empleadoDatos) > 0){
            return array(
                'success' => true,
                'msg' => 'Datos obtenidos correctamente',
                'data' => $empleadoDatos
            );
        }else{
            return array(
                'success' => false,
                'msg' => array('Se no obtuvo elemento correctamente'),
                'data' => array(
                    'empleados' => $empleadoDatos
                )
            );
        }
    }
}