<?php

include_once "controlador/CatalogosControlador.php";
include_once "controlador/EmpleadosControlador.php";
include_once "controlador/LoginUserControlador.php";
//obtener los datos de la url GET para los paramentros de la peticion
$parametros_get = $_GET;
$respuesta_backend = array(
    'success' => false,
    'msg' => array(
        'Error, no encontre la peticion solicitada'
    )
);

$parametros_post = $_POST;

//instancia a la clase
$rutas = new Rutas();

if(isset($parametros_get['peticion']) && $parametros_get['peticion'] != ''
    && isset($parametros_get['funcion']) && $parametros_get['funcion'] != ''){
    switch ($parametros_get['peticion']){
        //peticion de catalogos
        case 'catalogos':
            $catControlador = new CatalogosControlador();
            switch ($parametros_get['funcion']){
                case 'tipo_contacto':
                    if($_SERVER['REQUEST_METHOD']==='GET'){
                        $respuesta_controlador = $catControlador->obtenerCatalogoTipoContacto();
                        $rutas->peticion(200,$respuesta_controlador);
                    }else{
                        $rutas->peticion(404,$respuesta_backend);
                    }
                    break;
                default:
                    $rutas->peticion(404,$respuesta_backend);
                    break;
            }
            break;
        case 'empleado':
            $empControlador = new EmpleadosControlador();
            switch ($parametros_get['funcion']){
                case 'listado': //200
                    if($_SERVER['REQUEST_METHOD']==='GET'){
                        $respuesta_controlador = $empControlador->listado();
                        $rutas->peticion(200,$respuesta_controlador);
                    }else{
                        $rutas->peticion(404,$respuesta_backend);
                    }
                    break;
               
                case 'agregar': //201
                    if($_SERVER['REQUEST_METHOD']==='POST'){
                        $respuesta_controlador = $empControlador->agregar($parametros_post);
                        $rutas->peticion($respuesta_controlador['success'] ? 201 : 400,$respuesta_controlador);
                    }else{
                        $rutas->peticion(404,$respuesta_backend);
                    }
                    break;
                case 'actualizar':
                    if($_SERVER['REQUEST_METHOD']==='PUT'){
                        $respuesta_controlador = $empControlador->actualizar($parametros_post);
                        $rutas->peticion($respuesta_controlador['success'] ? 200 : 400,$respuesta_controlador);
                    }else{
                        $rutas->peticion(404,$respuesta_backend);
                    }
                    break;
                case 'eliminar':
                    if($_SERVER['REQUEST_METHOD']==='DELETE'){
                        $respuesta_controlador = $empControlador->eliminar($parametros_post);
                        $rutas->peticion($respuesta_controlador['success'] ? 200 : 400,$respuesta_controlador);
                    }else{
                        $rutas->peticion(404,$respuesta_backend);
                    }
                    break;
                default:
                    $rutas->peticion(404,$respuesta_backend);
                    break;
            }
            break;
        case 'usuarios':
            $userControlador = new LoginUserControlador();
            switch ($parametros_get['funcion']){
                case 'individual': //200
                    if($_SERVER['REQUEST_METHOD']==='GET'){
                        $respuesta_controlador = $userControlador->elemento($parametros_get['usuario'], $parametros_get['password']);
                        $rutas->peticion(200,$respuesta_controlador);
                    }else{
                        $rutas->peticion(404,$respuesta_backend);
                    }
                    break;
                default:
                    $rutas->peticion(404,$respuesta_backend);
                    break;
            }
            break;
        default:
            $rutas->peticion(404,$respuesta_backend);
            break;
    }
}else{
    //$rutas->peticion_no_encontrada($respuesta_backend);
    $rutas->peticion(404,$respuesta_backend);
}

class Rutas {
    public function peticion($codigo,$respuesta){
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($codigo);
        echo json_encode($respuesta);
    }
}