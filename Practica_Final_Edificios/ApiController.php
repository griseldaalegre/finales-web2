<?php
require_once 'model';
require_once 'apiView';
class ApiController{
    private $m;
    private $data;
    private $v;
    function __construct()
    {
        $this->m=new Model();
        $this->v=new apiView();
        $this->data=file_get_contents("php//:imput");
    }
    function getData(){
        return json_decode($this->data);
    }

    function auditoria(){
        $cant_edificio=$_GET['cantidad'];
        if(!empty($cant_edificio)){
            $resultados=$this->m->auditoriaCant($cant_edificio);
            $this->v->response($resultados,200);
        }else{
            $resultados=$this->m->auditoria();
            $this->v->response($resultados,200);
        }
    }
}