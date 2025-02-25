<?php
require_once 'ValoracionModel.php';
class ApiController
{
    private $model;
    private $view;
    private $data;
    function __construct()
    {
        $this->model = new ValoracionModel();
        $this->data = file_get_contents("php://input");
    }
    function getData()
    {
        return json_decode($this->data);
    }
    function getResena($param = [])
    {
        $id = $param[':ID'];
        $empresa = $this->model->empresa($id);
        if ($empresa) {
            $resultado = $this->model->getResenas($id);
            if ($resultado) {
                return $this->view->response($resultado,200);
            }else{
                return $this->view->response("no se encontraron resultados",404);
            }
        }else{
            return $this->view->respose("no existe la empresa",404);
        }
    }

    function editar($param=[]){
        $id=$param[':ID'];
        $resena = $this->model->resena($id);
        $body=$this->getData();
        if ($resena) {
            $resultado = $this->model->edit($id,$body->resena);
            if ($resultado) {
                return $this->view->response("se edito la resena con exito",200);
            }else{
                return $this->view->response("no se encontraron resena",404);
            }
        }else{
            return $this->view->respose("no existe la resena",404);
        }
    }
}
<<<<<<< HEAD
/*  $router->add('api/resena/:ID','GET','ApiController',getResena);
    $router->add('api/edit/:ID','PUT','ApiController',edit);
    $router->add('api/agregar','POST','ApiController',addResena);
    $router->add('api/resena/:ID','DELETE','ApiController',getResena);
 */
=======
>>>>>>> 2f329eb1df07f02ae78847242175b09022e3c366
