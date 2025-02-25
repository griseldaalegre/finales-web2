<?php
require_once 'model';
require_once 'view';
class apiController{
    private $m;
    private $v;
    private $data;

    function __construct()
    {
        $this->m=new Model();
        $this->v=new view();
        $this->data=file_get_contents("php://input");
    }

    function getData(){
        return json_decode($this->data);
    }

    function getEstado($params =[]){
        $body=$this->getData();
        $estado=$this->m->getEstado($body->id);
        if(!empty($estado)){
            $this->v->mensaje("datos de la encomienda".$estado." con estado ".$estado['idTracking'] ,200);
        }else{
            $this->v->error("no se encontraron datos",200);
        }
    }
}
