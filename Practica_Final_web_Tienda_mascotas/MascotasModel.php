<?php



class MascotasModel{
    private $db;
    function __construct()
    {
       $this->db=new PDO('mysql:host=localhost;'.'dbname=data;charset=utf8','root','');
    }

    public function getMascotaByClient($id){
        $query=$this->db->prepare("SELECT count(*) FROM Mascota where id_Cliente=?");
        $query->execute(array($id));
        $respuesta=$query->fetchColumn(PDO::FETCH_OBJ);//se recomienda usar fetchColumn
        return $respuesta;
    }

    public function delete($id){
        $query=$this->db->prepare("DELETE FROM Mascotas WHERE id=?");
        $query->execute(array($id));
    }

    public function getMascota($id){
        $query=$this->db->prepare("SELECT * FROM Mascotas WHERE id=?");
        $query->execute(array($id));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
}