<?php

require_once 'model';
require_once 'view';
require_once 'auth';
class controller{
    private $m;
    private $v;
    private $auth;

    function __construct(){
        $this->m=new Model();
        $this->v=new View();
    }

    function addPago(){
        $this->auth->session_start();
        $unidad=$_POST['unidad'];
        $edificio=$_POST['edificio'];
        $existe=$this->m->existeUnidad($unidad,$edificio);
        if(!empty($existe)){
            $idUnidad=$existe['id'];
            $fecha=$_POST['fecha'];
            $date = new DateTime($fecha);
            $mes = $date->format('m');
            $anio=$date->format('Y');
            $comprobantes=$this->m->comprobantes($unidad,$edificio);
            $flag=false;
             $comprobantePago=$_POST['comprobante'];
           if(!empty($comprobantePago)){
            foreach($comprobantes as $c){
                if($c['mes']== $mes && $c['year']==$anio){
                    $flag=true;
                }
            }
            if($flag==false){
                $monto=$_POST['monto'];
                $exito=$this->m->addPago($idUnidad,$fecha,$monto,$comprobantePago);
                if(!empty($exito)){
                    $this->v->mensaje('Pago realizado con exito');
                }else{
                    $this->v->error('error al realizar pago');
                }
            }else{
                $this->v->mensaje('la unidad ya se pago este mes');
            }
           }else{
            $this->v->error('el comprobante no puede estar vacio');
           }
        }else{
            $this->v->error('La unidad no existe');
        }
    }

}