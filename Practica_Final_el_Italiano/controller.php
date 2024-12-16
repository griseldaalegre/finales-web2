<?php

require_once 'model';
require_once 'view';
require_once 'auth';

class Controller{
    private $v;
    private $m;
    private $a;

    function __construct()
    {
        $this->m=new Model();
        $this->v=new View();
        $this->a=new Auth();

    }

    function addEncomienda(){
        $this->a->session_start();

        $id_comisionista=$_POST['id'];
        $fecha=$_POST['fecha'];
        $comisionista=$this->m->getComisionista($id_comisionista);
        if(!empty($comisionista)){
            $peso=$_POST['peso'];
            $pesoActual=$this->m->pesoActual($id_comisionista,$fecha);
            $pesoTotal=$pesoActual+$peso;
            if($pesoTotal<=$comisionista['capacidad_vehiculo']){
                $idTracking='en casa matriz';
                $destinatario=$_POST['destino'];
                $id=$this->m->addEncomienda($id_comisionista,$peso,$fecha,$destinatario,$idTracking);
                $this->v->mensaje("encomienda con id ".$id."en casa matriz");
            }else{
                $this->v->error("supera el peso maximo");
            }
        }else{
            $this->v->error("el comisionista no existe");
        }
    }

    function getCantidad(){
        $ciudad=$_POST['ciudad'];
        $fecha=$_POST['fecha'];
        $total=$this->m->getCantidad($ciudad,$fecha);
        if(!empty($total)){
            $this->v->mensaje("el total de encomiendas envias fue de ".$total);
        }else{
            $this->v->mensaje("no se encontraron encomiendas para la ciudad".$ciudad);
        }
    }

    







}