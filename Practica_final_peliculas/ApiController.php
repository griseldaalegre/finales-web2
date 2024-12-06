<?php
require_once 'movieModel';
require_once 'View';

class ApiController{


    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model =new movieModel();
        $this->view=new View();
        $this->data=file_get_contents("php//:imput");
    }

    public function getData(){
        return json_decode($this->data);
    }

    public function getPeliculas($param = null){
        $peliculas=$this->model->getPeliculas();
        if(!empty($peliculas)){
            return $this->view->respuesta($peliculas,200);
        }else{
            return $this->view->respuesta("error ",500);
        }
    }
    public function getPeliculasFiltro($param=null){
        $body=$this->getData();
        if(!empty($body->genero) && !empty( $body->director)){
            $peliculas=$this->model->getGeneroDirector($body->genero,$body->director);
            if(!empty($peliculas)){
                return $this->view->respuesta($peliculas,200);
            }else{
                return $this->view->respuesta("error",200);
            }
        }
        if(!empty($body->genero)){
            $peliculas=$this->model->getGenero($body->genero);
            if(!empty($peliculas)){
                return $this->view->respuesta($peliculas,200);
            }else{
                return $this->view->respuesta("error sin genero",200);
            }
        }
        if(!empty( $body->director)){
            $peliculas=$this->model->getDirector($body->director);
            if(!empty($peliculas)){
                return $this->view->respuesta($peliculas,200);
            }else{
                return $this->view->respuesta("error sin director",200);
            }
        }
        return $this->view->respuesta("busqueda vacia",200);
    }

    public function valoracionPeliculas($params=null){
        $peliculas=$this->model->getValoracionPeliculas();
        if(!empty($peliculas)){
            return $this->view->respuesta($peliculas,200);
        }else{
            return $this->view->respuesta("no se obtuvieron peliculas",200);
        }

    }

}