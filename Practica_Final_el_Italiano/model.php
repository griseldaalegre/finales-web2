<?php

class Model{
    private $db;


    function __construct()
    {
        $this->db=new PDO('localhost=host:localhost'.'dbname=final'.'root','');

    }

    function getComisionista($id){
        $query=$this->db->prepare("SELECT * FROM COMISIONISTA WHERE id_comisionista=?");
        $query->execute(array($id));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    function pesoActual($id,$fecha){
        $query=$this->db->prepare("SELECT capacidad_vehiculo FROM comisionista as c
                                left join ENCOMIENDA as e on c.id_comicionista = e.id_comisionista
                                where c.fecha=? and c.id_comisionista =?");
        $query->execute(array($id));
        $respuesta = $query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    function addEncomienda($id_comisionista,$peso,$fecha,$destinatario,$idTracking){
        $query = $this->db->prepare("INSERT INTO ENCOMIENDA(peso,destinatario,id_comisionista,idTracking,fecha) VALUES(?,?,?,?,?)");
        $query->execute(array($peso,$destinatario,$id_comisionista,$idTracking,$fecha));
        return $this->db->lastInsertId();
    }

    function getCantidad($ciudad,$fecha){
        $query=$this->db->prepare("SELECT count(id_encomienda) FROM ENCOMIENDA as e 
                                    LEFT JOIN COMICIONISTA as c where e.id_comicionista = c.id_comicionista
                                    WHERE ciudad_destino=? and e.fecha=?");
        $query->execute(array($ciudad,$fecha));
        $resultado=$query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    function getEstado($id){
        $query=$this->db->prepare("SELECT * FROM  ENCOMIENDA where idTracking =?");
    $query->execute(array($id));
    $respuesta = $query->fetchAll(PDO::FETCH_OBJ);
    return $respuesta;
    }

}