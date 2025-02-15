<?php

require_once 'libroModel';
require_once 'view';
class libroController{
    private $libroModel;
    private $view;

    public function __construct(){
        $this->libroModel=new libroModel();

        $this->view =new view();

    }

    public function prestamo(){
        session_start();
        $id=$_SESSION['id'];
        $rol=$_SESSION['rol'];
        $libro=$this->libroModel->getLibroById($_POST['id']);
        if(!empty($id) && $rol=='admin' ){
            if(!empty($libro)){
                
                $disponible=$this->libroModel->verificarDisponibilidad($libro['id']);
                if($disponible==true){
                    $prestamos=$this->libroModel->comprobarPrestamos($id);
                    if($prestamos<3){
                        $this->libroModel->addPrestamo($id,$libro['id'],$_POST['fecha_prestamo'],$_POST['fecha_devolucion'],false);
                        $this->view->mesaje("prestamo registrado con exito",200);
                    }else{
                        $this->view->mesaje("el usuario tiene 3 prestamos",200);
                    }
                }else{
                    $this->view->mesaje("el libro no se encuentra disponible",200);
                }
            }else{
                $this->view->mesaje("el libro requerido no existe",200);
            }
        }else{
            $this->view->mesaje("no se esta logeado y/o no es admin",200);
        }
    }




}