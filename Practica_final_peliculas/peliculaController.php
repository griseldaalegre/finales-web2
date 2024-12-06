<?php
require_once 'AuthHelper';
require_once 'movieModel';
require_once 'userModel';
require_once 'view';
class peliculaController{
    private $auth;
    private $movie;
    private $user;
    private $view;
    function __construct()
    {
        $this->auth=new AuthHelper();
        $this->movie=new movieModel();
        $this->user=new userModel();
        $this->view=new view();
    }

    function addCalificacion(){
        $this->auth->session_start();
        $id_movie=$_POST['id_movie'];
        $id_user=$_POST['id_user'];
        $calificacion=$_POST['calificacion'];
        $existe=$this->movie->existe($id_movie);
        if(!empty($existe)){
            $valoro=$this->movie->valoro($id_user,$id_movie);
            if(empty($valoro)){
                $this->movie->addCalificacion($id_movie,$id_user,$calificacion);
                $total=$this->movie->cantValoracionUser($id_user);
                if($total >=100){
                    $this->user->destacado($id_user,true);
                    $this->view->mensaje("Felicidades es un usuario destacado");
                }else{
                    $this->view->mensaje("Calificacion exitosa");
                }
            }else{
                $this->view->mensaje("ya se valoro la pelicula anteriormente");
            }
        }else{
            $this->view->mensaje("error la pelicula no existe");
        }
    }







}