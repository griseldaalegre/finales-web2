<?php

require_once 'ResenasModel';
require_once 'ResenasView';

class ResenasController{
    public $model;
    public $view;
    function __construct()
    {
        $this->model=new ResenasModel();
        $this->view=new ResenasView();
    }

    public function getPromocion(){
        $respuesta=$this->model->getPromocion();
        $this->view->show($respuesta);
    }

    public function getStockRespuesto(){
        $id=$_POST['id'];
        $respuesta=$this->model->getStockRespuesto($id);
        $this->view->show($respuesta);
    }

    public function addCategoria(){
        $nombre=$_POST['nombre'];
        if(!empty($nombre)){
            $this->model->addCategoria($nombre);
            $this->view->message("se agrego correctamente");
        }else{
            $this->view->message("error al agregar categoria");
        }
    }

    public function addRespuesto(){
        $respuesto=$_POST['nombre_respuesto'];
        $precio=$_POST['precio'];
        $stock=$_POST['stock'];
        $idCategoria=$_POST['idCategoria'];
        $proveedor=$_POST['proveedor'];
        $existe=$this->model->getCategoria($idCategoria);
        if($existe>=0){
            if(!empty($proveedor) &&!empty($respuesto) && $precio>=0 && $stock>=0){
                $respuesta=$this
                            ->model
                            ->addRespuesto($respuesto,$precio,$stock,$idCategoria,$proveedor,false);
                if($respuesta>=0){
                    $this->view->message("se agrego correctamente");
                }
            } 
        }else{
            $this->view->message("error no existe la categoria");
        }
        
    }

    public function venderRespuesto(){
        $respuesto=$_POST['idRespuesto'];
        $cantidad=$_POST['cantidad'];
        $existe=$this->model->getCategoria($respuesto);

        if(!empty($existe) && $existe != null){
            $stock=$this->model->getStockRespuesto($respuesto);
            if($stock>0){
                $restante=$stock-$cantidad;
                if($restante>=0){
                    $this->model->venderRespuesto($respuesto,$restante);
                }else{
                    $this->view->message("no hay stock suficiente");
                }
            }else{
                $this->view->message("no hay stock disponible");
            }
        }else{
            $this->view->message("error al verificar respuesto");
        }
    }

    public function getStockRepuesto(){
        $respuesta=$this->model->getPromocionPorCategoria();
        $this->view->show($respuesta);
    }

    
}
