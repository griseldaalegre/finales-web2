<?php
require_once 'ResenasModel';
require_once 'View';

class ApiController{
    private $model;
    private $data;
    private $view;


    function __construct()
    {
        $this->model=new ResenasModel();
        $this->view=new View();
        $this->data=file_get_contents("php://input");
    }

    function getData(){
        return json_decode($this->data);
    }

    function getRespuesto($param=[]){
        $resultado=$this->model->getRepuestosOrdenados();
        $this->view->show($resultado);
    }



}