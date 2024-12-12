<?php


    class model{
        private $db;

        function __construct()
        {
            $this->db =new PDO('mysql:host=localhost;'.'dbname=blogserie;charset=utf8','root','');
        }

        function comprobarEquipo($id,$nombre){
            $query=$this->db->prepare("SELECT id from equipo where id=? and nombre=?");
            $query->execute(array($id,$nombre));
            $resultado=$query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }
        function getCancha($cancha){
            $query=$this->db->prepare("SELECT id from Cancha where id=?");
            $query->execute(array($cancha));
            $resultado=$query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }
        function verificarCancha($id_cancha,$hora){
            $query=$this->db->prepare("SELECT id from Fixture where id_cancha =? and hora=?");
            $query->execute(array($id_cancha,$hora));
            $resultado=$query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }
        function verificarFechaLocal($fecha,$equipo){
            $query=$this->db->prepare("SELECT id from Fixture where  equipo_local=? and fecha=?");
            $query->execute(array($equipo,$fecha));
            $resultado=$query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }
        function verificarFechaVisitante($fecha,$equipo){
            $query=$this->db->prepare("SELECT id from Fixture where  equipo_visitante=? and fecha=?");
            $query->execute(array($equipo,$fecha));
            $resultado=$query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }
        function addFecha($local,$visitanten,$hora,$fecha,$cancha,$gol_local,$gol_visitante,$jugado){
            $query=$this->db->prepare("INSERT into Fixture(nro_fecha,equipo_local,equipo_visitante,hora,id_cancha,goles_local,goles_visitantes,jugado) VALUES(?,?,?,?,?,?,?,?)");
            $query->execute(array($fecha,$local,$visitanten,$hora,$cancha,$gol_local,$gol_visitante,$jugado));
            return $this->db->lastInsertId();
        }

        function getEquipos(){
            $query=$this->db->prepare("SELECT * from equipo");
            $query->execute();
            $resultado=$query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        function getGanadosV($id) {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM Fixture WHERE equipo_visitante = ? AND goles_visitante > goles_local");
            $query->execute(array($id));
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado->total;
        }
        
        function getGanadosL($id) {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM Fixture WHERE equipo_local = ? AND goles_local > goles_visitante");
            $query->execute(array($id));
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado->total;
        }
        
        function empatados($id) {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM Fixture WHERE (equipo_local = ? OR equipo_visitante = ?) AND goles_local = goles_visitante");
            $query->execute(array($id,$id));
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado->total;
        }
        
        function getPerdidosL($id) {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM Fixture WHERE equipo_local = ? AND goles_local < goles_visitante");
            $query->execute(array($id));
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado->total;
        }
        
        function getPerdidosV($id) {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM Fixture WHERE equipo_visitante = ? AND goles_local > goles_visitante");
            $query->execute(array($id));
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado->total;
        }

    }