<?php

class HistoriaClinicaModel{
    private $db;

    function __construct()
    {
       $this->db=new PDO('mysql:host=localhost;'.'dbname=data;charset=utf8','root','');
    }
    public function getHistorial($id){
        $query=$this->db->prepare("SELECT * FROM Historia Where id_mascota=?");
        $query->execute(array($id));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

}