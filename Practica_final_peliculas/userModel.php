<?php

class userModel{
    private $db;
    public function __construct()
    {
        $this->db=new PDO('mysql:host=localhost;'.'dbname=blogserie;charset=utf8','root','');
    }

    public function destacado($id,$destacado){
        $query=$this->db->prepare("UPDATE Usuario set destacado =? where id=?");
        $query->execute(array($destacado,$id));
    }
}