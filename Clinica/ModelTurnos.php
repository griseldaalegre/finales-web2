<?php

class ModelTurnos{
    private $db;

    function __construct()
    {
       $this->db=new PDO('mysql:host=localhost;'.'dbname=blogserie;charset=utf8','root','');
    }

    public comprobarFecha($fecha){
        $query=$this->db->prepare('SELECT 1 FROM  TURNO WHERE fecha=?');
        $query->execute(array($fecha));
        $resultado=$query->fetch(PDO::FETCH_OBJ);
        return $resultado;    
    }
   
    public getTurnos($fecha){
        $query=$this->db->prepare("SELECT t.fecha, p.nombre as nombre profesional, e.nombre as nombre especialidad,
                 t.dni_paciente FROM TURNOS as t
                LEFT JOIN PROFESIONAL as p ON t.id_profesional = p.id 
                LEFT JOIN  ESPECIALIDAD as e ON p.id_especialidad = e.id
                WHERE t.fecha LIKE ?");
                $query->execute(array($fecha));
                $resutado = $query->fetchAll(PDO::FETCH_OBJ);
                return $resultado;
    }

    public getProfesion($id_profesion){
        $query= $this->db->prepare("SELECT id FROM ESPECIALIDAD WHERE id = ?");
        $query->execute(array($id_profesion)); // buscar cuando y para que se usa array
        $resultado=$query->fetch(PDO::FETCH_OBJ);
        return $resultado;    
    }

    public getProfesional($nombreProfesional, $id);{
        
        $query= $this->db->prepare("SELECT 1 FROM ESPECIALIDAD AS e LEFT JOIN PROFESIONAL as p ON p.id = p.id_especialidad WHERE p.nombre = ? 
                                    AND e.especialidad = ? ");
        $query->execute(array($nombreProfesional, $id)); // buscar cuando y para que se usa array
        $resultado=$query->fetch(PDO::FETCH_OBJ);
        return $resultado;    
    }

    public addProfesional($nombreProfesional, $id_profesional){
        $query=$this->db->prepare("INSERT INTO PROFESIONAL (nombre, id_especialidad) VALUES(?,?)");
        $query->execute(array($nombreProfesional, $id_profesional));
        return $this->db->lastInsertId();
    }

}