<?php


class Model
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost' . 'dbname=pago', 'root', '');
    }

    function addPago($idUnidad, $fecha, $monto, $comprobantePago)
    {
        $query = $this->db->prepare("INSERT INTO Pago(id_unidad,fecha,monto,comprobante) VALUES(?,?,?,?,?)");
        $query->execute(array($idUnidad, $fecha, $monto, $comprobantePago, $idEdificio));
        return $this->db->lastInsertId();
    }
    function existeUnidad($idU, $idE)
    {
        $query = $this->db->prepare("SELECT * FROM Unidad as u
                                    left join Edificio as e on u.id_Edificio=e.ud
                                    where id_unidad=? and e.id=? ");
        $query->execute(array($idU, $idE));
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    function comprobantes($idU, $idE)
    {
        $query = $this->db->prepare("SELECT MONTH(fecha) as mes,YEAR(fecha) as year
                                    from Pago as p 
                                    left join Unidad as u on p.id_unidad = u.id
                                    left join Edificio as e on e.id=u.id_edificio
                                    where u.id =? and e.id=? ");
        $query->execute($idU, $idE);
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    function auditoriaCant($cantidad)
    {
        $query = $this->db->prepare("SELECT e.nombre,SUM(p.monto) FROM Pago as p
                                    left join Unidad as u on p.id_unidad = u.id
                                    left join Edificio as e on u.id_edificio=e.id
                                    Group By e.nombre
                                    Limit ?");
        $query->execute(array($cantidad));
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    function auditoria()
    {
        $query = $this->db->prepare("SELECT e.nombre,SUM(p.monto) FROM Pago as p
                                    left join Unidad as u on p.id_unidad = u.id
                                    left join Edificio as e on u.id_edificio=e.id
                                    Group By e.nombre");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
}
