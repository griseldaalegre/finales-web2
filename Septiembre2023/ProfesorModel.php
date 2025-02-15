<?php


class ProfesorModel
{
    public $db;

    public function __construct()
    {
        $this->db = new PDO(...);
    }


    function getProfesorById($id)
    {
        $query = $this->db->prepare('SELECT p.nombre AS nombre_profesor, edad, id_materia, m.nombre AS materia_nombre FROM Profesor as p 
            LEFT JOIN Materia as m ON p.id_materia = m.id WHERE p.id = ? ');
        $query->execute(array($id));
        $respuesta = $query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
}
