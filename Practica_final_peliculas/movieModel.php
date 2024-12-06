<?php


class movieModel{
    private $db;

    function __construct()
    {
       $this->db=new PDO('mysql:host=localhost;'.'dbname=blogserie;charset=utf8','root','');
    }

    public function existe($id){
        $query=$this->db->prepare("SELECT * FROM Pelicula where id=?");
        $query->execute(array($id));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function valoro($user,$movie){
        $query=$this->db->prepare("SELECT * FROM Voto where id_pelicula =? and id_usuario =?");
        $query->execute(array($movie,$user));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function addCalificacion($user,$movie,$calificacion){
        $query=$this->db->prepare("INSERT into voto(id_pelicula,id_usuario,calificacion)values(?,?,?)");
        $query->execute(array($movie,$user,$calificacion));
    }

    public function cantValoracionUser($id){
        $query=$this->db->prepare("SELECT COUNT(id) FROM voto where id_usuario=? ");
        $query->execute(array($id));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
    public function getPeliculas(){
        $query=$this->db->prepare("SELECT * FROM Pelicula");
        $query->execute();
        $resultado=$query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getGeneroDirector($genero,$director){
        $query=$this->db->prepare("SELECT * FROM pelicula where genero =? and director=?");
        $query->execute(array($genero,$director));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
    public function getGenero($genero){
        $query=$this->db->prepare("SELECT * FROM pelicula where genero =?");
        $query->execute(array($genero));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
    public function getDirector($director){
        $query=$this->db->prepare("SELECT * FROM pelicula where and director=?");
        $query->execute(array($director));
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
    public function getValoracionPeliculas(){
        $query=$this->db->prepare("SELECT p.nombre,SUM(v.calificacion) FROM pelicula as p 
                                    join voto as v on p.id=v.id_pelicula 
                                    GROUP BY p.nombre");
        $query->execute();
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
}






