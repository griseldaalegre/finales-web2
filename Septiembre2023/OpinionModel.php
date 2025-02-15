<?php


class OpinionModel
{

    public $db;

    public function __construct()
    {
        $this->db = new PDO(...);
    }


    function cantidadOpiniones($dni, $id)
    {
        $query = $this->db->prepare('SELECT * FROM opinion WHERE dni = ?  AND  id_profesor = ?');
        $query->execute(array($dni, $id));
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    function insertarOpinion($dni, $fecha, $imagen, $id_profesor)
    {
        $query = $this->db->prepare('INSERT INTO Opinion(dni, fecha, imagen, id_profesor) VALUES(?,?,?,?)');
        $query->execute(array($dni, $fecha, $imagen, $id_profesor));
    }

    function getOpiniones($id)
    {
        $query = $this->db->prepare('SELECT * FROM opinion WHERE id_profesor = ? ');
        $query->execute(array($id));
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
}
