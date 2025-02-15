<?php


class libroModel{
 private $db;
 public function __construct(){
    $this->db=new PDO(.....);
 }

 public function getLibroById($id){
    $query=$this->db->prepare("SELECT * FROM Libro where id=?");
    $query->execute(array($id));
    $respuesta = $query->fetchAll(PDO::FETCH_OBJ);
    return $respuesta;
 }

 public function verificarDisponibilidad($id){
    $query=$this->db->prepare("SELECT * FROM Prestamo where id_libro=?
                                ORDER BY id DESC
                                LIMIT 1;");
    $query->execute(array($id));
    $resultado =$query->fetchAll(PDO::FETCH_OBJ);
    return $resultado;

 }

 public function comprobarPrestamos($id){
    $query=$this->db->prepare("SELECT count(id) as cantidad FROM Prestamo where id_usuario=?");
    $query->execute(array($id));
    $resultado=$query->fetchColumn(PDO::FETCH_OBJ);
    return $resultado;
 }


 public function addPrestamo($usuario,$id_libro,$fechaPrestamo,$fechaDevolucion,$devuelto){
    $query=$this->db->prepare("INSERT INTO Prestamo(id_usuario,id_libro,fecha_prestamo,fecha_devolucion,dedvuelto)
                                 Values(?,?,?,?,?)");
    $query->execute(array($usuario,$id_prestamo,$fechaPrestamo,$fechaDevolucion,$devuelto));
    
 }

}