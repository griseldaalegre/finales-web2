<?php
<<<<<<< HEAD

=======
// Logica
>>>>>>> 2f329eb1df07f02ae78847242175b09022e3c366

class ResenasModel{

    private $db;

    function __construct()
    {
        $this->db =new PDO('mysql:host=localhost;'.'dbname=blogserie;charset=utf8','root','');
    }

    public function getPromocion(){
        $query=$this->db->prepare("SELECT r.nombre,c.nombre FROM REPUESTO as r
                                    JOIN CATEGORIA as c ON repuesto.id_categoria=categoria.id
                                    WHERE en_promocion=1");
        $query->execute();
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function getStockRespuesto($id){
        $query=$this->db->prepare("SELECT r.stock FROM RESPUESTOS as r 
                                    WHERE id=?");
        $query->execute($id);
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function addCategoria($nombre){
        $query=$this->db->prepare("INSERT INTO categoria(nombre_categoria) values(?)");
        $query->execute(array($nombre));
    }

    public function getCategoria($id){
        $query=$this->db->prepare("SELECT id FROM CATEGORIA WHERE id=?");
        $query->execute(array($id));
        $resultado=$query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function addRespuesto($respuesto,$precio,$stock,$idCategoria,$proveedor,$promocion){
       $query=$this->db->prepare("INSERT INTO respuesto(nombre_respuesto,precio,stock,id_categoria,en_promocion,proveedor) values(?,?,?,?,?,?)");
       $query->execute(array($respuesto,$precio,$stock,$idCategoria,$promocion,$proveedor));
       $resultado=$this->db->lastInsertId();
       return $resultado;
    }

    public function venderRespuesto($id,$newStock){
        $query=$this->db->prepare("UPDATE RESPUESTO SET stock =? WHERE id=?");
        $query->execute(array($newStock,$id));
    }

    public function getPromocionPorCategoria(){
        $query=$this->db->prepare("SELECT c.nombre_categoria,count(r.id_categoria) FROM RESPUESTO as r
                                    JOIN CATEGORIA as c on r.id_categoria=c.id
                                    where r.en_promocion=1 and stock>=0
                                    Group by(c.nombre_categoria)");
        $query->execute();
        $respuesta=$query->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }
    public function getRepuestosOrdenados(){
        $query=$this->db->prepare("SELECT * FROM RESENAS as r
                                   WHERE stock>=0
                                   ORDER BY nombre_respuesto ASC");
        $query->execute();
        $resultado=$query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
}