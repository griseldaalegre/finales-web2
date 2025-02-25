<?php 

require_once 'modelTurnos';

class ControllerTurnos{

    private $model;
    private $view;
    private $auth;

    public __construct(){
        $this->model = new ValoracionModel();
        $this->view = new View();
        $this->auth = new Auth();
    }

    public getTurnos($params=[]){
        $fecha = $_POST['fecha'];
        $this->auth->session_start(); // verifico que este logeado

        if($this->auth->isAdmin()){
            $existeFecha = $this->model->comprobarFecha($fecha);
        
            if($existeFecha){
                $datoTurno = $this->model->getTurnos($fecha);
                if(isEmpty($datoTurno)){
                    $this->view->dato($datoTurno);
                }
            } else {
                $this->view->mensaje("No hay tunos para esta fecha");
            }
        } else {
            $this->view->mensaje("No es admin");
        }

    }

    public addProfesional(){
        $nombreProfesional= $_POST['nombre'];
        $idProfesion = $_POST['id'];
        
        $existe = $this->model->getProfesion($idProfesion);

        if(!empty($existe)){
            $existeProfesional = $this->model->getProfesional($nombreProfesional, $id_profesional);
            if(!empty($existeProfesional)){
                $agrego= $this->model->addProfesional($nombreProfesional, $id_profesional);
                if(empty($agrego)){
                    $this->view->mensaje("Se agrego correctamente");
                } else {
                    $this->view->mensaje("Error al agregar");
                }
            } else {
                $this->view->mensaje("El profesional ya existe");
            }
        } else {
            $this->view->mensaje("No existe la profesion");
        }
    }

    // MVC: Codigo legible y separado.
    //PDO : Facilita la conexion con la base de datos;
    //Sesiones PHP: Facilita el uso de apis, tiene seguridad y persistencia de datos;

    //CSR
    //

}