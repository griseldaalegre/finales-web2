<?php
require_once 'libroModel';
require_once './app/views/json.view.php';
class apiController{
    private $libroModel;
    private $apiView;

    function __construct($res)
    {
        $this->libroModel=new libroModel();
        $this->apiView=new ApiView();
        $this->view = new JSONView($res);
    }


    // GET api/libro?titulo=:titulo&genero=:genero&OrderBy=:orderby&order=[asc|desc]
    function getLibros($req, $res)
    {
        // Definir los valores por defecto de orden
        $orderBy = 'id'; // Ordenar por id por defecto
        if(!empty($req->query['OrderBy']) && in_array($req->query['OrderBy'], ['titulo', 'genero', 'fecha'])) {
            $orderBy = $req->query['OrderBy'];
        }

        $order = 'asc'; // Orden ascendente por defecto
        if(!empty($req->query['order']) && strtolower($req->query['order']) == 'desc') {
            $order = 'desc';
        }

        $titulo = isset($req->query['titulo']) ? $req->query['titulo'] : null;
        $genero = isset($req->query['genero']) ? $req->query['genero'] : null;

        // Consultar los libros
        $libros = $this->libroModel->getLibros($titulo, $genero, $orderBy, $order);
        
        return $this->view->response($libros, 200);
    }
}