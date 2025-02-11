<?php



class ClienteModel{
    private $db;


    function __construct()
    {
       $this->db=new PDO('mysql:host=localhost;'.'dbname=blogserie;charset=utf8','root','');
    }


    function deleteById($id){
        $query=$this->db->prepare("DELETE  FROM Cliente WHERE id = ?");
        $query->execute(array($id));
    }
}