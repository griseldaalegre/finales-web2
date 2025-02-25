<?php

require_once 'MascotaModel';
require_once 'ApiMascotaView';
require_once 'HistoriaClinicaModel';
class apiMascotas{
    private $data;
    private $MascotaModel;
    private $viewApi;
    private $historia;
    public function __construct() {
        $this->data = file_get_contents("php://input");
        $this->MascotaModel=new MascotasModel();
        $this->viewApi=new ApiMascotaView();
        $this->historia=new HistoriaClinicaModel();
    }

    public function getData(){
        return json_decode($this->data);
    }

    //url = api/mascotas con metodo POST
    public function addMascota($params=null){
        session_start();
        $cliente = $_SESSION['id'];
        $nombre=$_POST['nombre'];
        $peso=$_POST['peso'];
    
        $mascota = $this->MascotaModel->addMascota($nombre,$peso,$cliente);//se obtiene el id con lastInsertId
        if(!empty($mascota)){
            $this->viewApi->response("se agrego correctamente",200);
        }else{
            $this->viewApi->response("error al agregar ",400);
        }
    }

    //url = api/mascotas/:ID con metodo GET
    public function listarMascotas($id){
        session_start();
        $cliente = $_SESSION['id'];
        if($cliente){
            $order=$_POST['order'];
            $listado=$this->historia->getListadoByOrder($id,$order);
            $this->viewApi->response($listado,200);
        }else{
            $this->viewApi->response("el usuario no se encuentra logueado",400);
        }
    }

    //url = api/mascotas/:ID
    public function updatePesoMascota($id){
        $body=$this->getData();
        $this->MascotaModel->updatePeso($id,$body->peso);
        $this->viewApi->response("peso actualizado",200);
    }


}