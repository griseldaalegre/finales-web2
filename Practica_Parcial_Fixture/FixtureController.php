<?php

require_once '/views';
require_once '/model';
require_once '/auth';

class FixtureController{
    private $model;
    private $view;
    private $auth;
    function __construct() {
        $this->model = new model();
        $this->view= new view();
        $this->auth=new auth();
    }

    function addFecha(){
        $this->auth->session_start();
        $capitan=$_POST['email_capitan_local'];
        $nombre_equipo=$_POST['nombre_equipo_local'];
        $capitan=$_POST['email_capitan_visitante'];
        $nombre_equipo=$_POST['nombre_equipo_visitante'];
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
        $id_equipo_local=$this->model->comprobarEquipo($capitan,$nombre_equipo);
        $id_equipo_visitante=$this->model->comprobarEquipo($capitan,$nombre_equipo);
        if(!empty($id_equipo_local) && !empty($id_equipo_visitante)){
            $cancha=$_POST['cancha'];
            $id_cancha=$this->model->getCancha($cancha);
            if(!empty($id_cancha)){
                $jugaVisitante=$this->model->verificarFechaLocal($fecha,$id_equipo_visitante);
                $juegaLocal=$this->model->verificarFechaVisitante($fecha,$id_equipo_local);
               if(empty($juegaLocal) && empty($jugaVisitante)){
                    $canchaLibre=$this->model->verificarCancha($id_cancha,$hora);
                    if(empty($canchaLibre)){
                        $id=$this->model->addFecha($id_equipo_local,$id_equipo_visitante,$hora,$fecha,$cancha,0,0,false);
                        if(!empty($id)){
                            $this->view->mensaje("fecha agregada con exito");
                        }else{
                            $this->view->error("error al agregar fecha");
                        }
                    }else{
                        $this->view->error("error la cancha se utiliza a :".$hora);
                    }
               }else{
                $this->view->error("uno de los equipos juega la fecha".$fecha);
               }
            }else{
                $this->view->error("la cancha seleccionada no existe");
            }
        }else{
            $this->view->error("no se encontraron los equipos seleccionados");   
        }

    }

    function tablaPartidos(){
        $equipos=$this->model->getEquipos();
        $lista=[];
        foreach($equipos as $equipo){
            $V_ganados=$this->model->getGanadosV($equipo->id);
            $L_ganados=$this->model->getGanadosL($equipo->id);
            $Empatados=$this->model->empatados($equipo->id);
            $V_Perdidos=$this->model->getPerdidosV($equipo->id);
            $L_Perdidos=$this->model->getPerdidosL($equipo->id);
            $lista[]=[
                'equipo'=>$equipo->nombre,
                'ganados'=>$V_ganados+$L_ganados,
                'perdidos'=>$V_Perdidos+$L_Perdidos,
                'empatados'=>$Empatados
            ];
        }

        $this->view->tabla_partidos($lista);
    }



}