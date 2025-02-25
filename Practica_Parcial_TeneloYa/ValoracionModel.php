<?php

class ValoracionModel{

 private $db;

 function __construct()
 {
    $this->db=new PDO('mysql:host=localhost;'.'dbname=blogserie;charset=utf8','root','');
 }

 function usuario($id){
    $query=$this->db->prepare('SELECT id FROM USUARIO  WHERE id=?');
    $query->execute([$id]);
    $usuario=$query->fetch(PDO::FETCH_OBJ);
    return $usuario;
 }
 function empresa($id){
    $query=$this->db->prepare('SELECT id FROM EMPRESA WHERE id=?');
    $query->execute($id);
    $empresa=$query->fetch(PDO::FETCH_OBJ);
    return $empresa;
 }
 function agregarResena($user,$empresa,$valoracion,$resena,$inadecuado){
    $query=$this->db->prepare('INSERT INTO valoracion (id_usuario,id_empresa,valoracion,resena,inadecuado) values(?,?,?,?,?)');
    $query->execute(array($user,$empresa,$valoracion,$resena,$inadecuado));
    return $this->db->lastInsertId();
 }

 function comprobacionUsuario($iduser,$idempresa){
    $query=$this->db->prepare("SELECT 1 from usuario as u
                                left Join valoracion as v on u.id=v.id_usuario
                                left join pedido as p on u.id=p.id_usuario
                                where u.id=? and p.id_empresa=? and p.pedido IS NOT NULL and v.valoracion is Null ");
    $query->execute(array($iduser,$idempresa));
    $resultado=$query->fetch(PDO::FETCH_OBJ);
    return $resultado;
 }

 function getEmpresasPromedio(){
    $query=$this->db->prepare("SELECT id , AVG(valoracion) as promedio from valoracion ");
    $query->execute();
    $resultado=$query->fetchAll(PDO::FETCH_OBJ);
    return $resultado;
 }

 function premiun($id){
    $query=$this->db->prepare("UPDATE EMPRESA set premiun =? where id=?");
    $query->execute(array(true,$id));
 }

 function getResena(){
    $query=$this->db->prepare("SELECT u.id ,u.nombre, COUNT(v.id) as total_resenas 
                                FROM usuario as u left join valoracion as v on v.id_user=u.id");
    $query->execute();
    $resultado=$query->fetchAll(PDO::FETCH_OBJ);
    return $resultado;
 }
 function negativas($id){
    $query =$this->db->prepare("SELECT v.valoracion,v.resena,e.nombre,
                                FROM valoracion as v left join empresa as e on e.id=v.id_empresa
                                where v.id_usuario=?");
    $query->execute(array($id));
    $resultado=$query->fetchAll(PDO::FETCH_OBJ);
    return $resultado;
 }
}