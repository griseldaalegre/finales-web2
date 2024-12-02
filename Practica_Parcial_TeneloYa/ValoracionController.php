<?php

require_once 'valoracionModel.php';
require_once 'valoracionView.php';

class ValoracionController
{

    private $model;
    private $view;
    function __construct()
    {
        $this->model = new ValoracionModel();
        $this->view = new View();
    }

    function nuevaValoracion($params = [])
    {
        $idUser = $_POST['id_user'];
        $idEmpresa = $_POST['id_empresa'];
        $valoracion = $_POST['valoracion'];
        $resena = $_POST['reseña'];

        $user = $this->model->usuario($idUser);
        /*$empresa=$this->model->empresa($idEmpresa); */
        /*if(!empty($user) && !empty($empresa) && !empty($valoracion) && !empty($resena) ){

        }*/
        if ($user) {
            $empresa = $this->model->empresa($idEmpresa);
            if ($empresa) {
                if ($valoracion && $valoracion >= 1 && $valoracion <= 5) {
                    if ($resena) {
                        $valoracionUsuario = $this->model->comprobacionUsuario($user, $empresa);
                        if ($valoracionUsuario) {
                            $flag = $this->model->agregarResena($user, $empresa, $valoracion, $resena, false);
                            if ($flag) {
                                $this->view->mensaje("se agrego correctamente");
                            } else {
                                $this->view->error("error al agregar valoracion");
                            }
                        } else {
                            $this->view->error("El usuario no relizo ningun pedio y/o ya valoro la empreza ");
                        }
                    } else {
                        $this->view->error("error reseña nesesaria");
                    }
                } else {
                    $this->view->error("valoracion nesesaria");
                }
            } else {
                $this->view->error("no se encontro la empresa con id=$idEmpresa");
            }
        } else {
            $this->view->error("error el usuario no existe");
        }
    }

    function marcarPremiun($params = [])
    {
        $valor = $_POST['valor'];
        $this->auth->session_start(); 
        if ($this->auth->isAdmin()) {
            $empresas = $this->model->getEmpresasPromedio();
            if ($valor && $valor >= 1) {
                if ($empresas) {
                    foreach ($empresas as $emp) {
                        $promedio = $emp->promedio;
                        if ($promedio > $valor) {
                            $this->model->premiun($emp->id);
                        }
                    }
                } else {
                    $this->view->error("Error empresas vacias");
                }
            } else {
                $this->view->error("no se permite valor vacio o negativo");
            }
        } else {
            $this->view->error("No tiene permisos");
        }
    }

    function  getResena()
    {
        $contador = 0;
        $resenas = $this->model->getResena();
        $resenasUsuarios = [];
        if ($resenas) {
            foreach ($resenas as $re) {
                if ($re->total_resenas >= 1) {
                    $resenasNegativas = $this->model->negativas($re->id);
                    if ($resenasNegativas) {
                        $resenasNegUsuarios = [];
                        foreach ($resenasNegativas as $neg) {
                            $resenasNegUsuarios[] = [
                                "nombre" => $neg->nombre,
                                "total" => $neg->valoracion . "/5",
                                "resena" => $neg->resena
                            ];
                            $contador++;
                        }
                        $resenasUsuarios[] = [
                            "nombre" => $re->nombre,
                            "total_resenas" => $re->total_resenas,
                            "resenas" => $resenasNegUsuarios,
                            "total_negativas" => $contador,
                        ];
                        $contador = 0;
                    }
                }
            }
        }
        return $resenasUsuarios;
    }
}
/*
Nos solicitan además, crear una API REST para poder acceder a los siguientes
servicios
I. Como usuario quiero poder ver la lista de reseñas para una empresa
II. Como usuario quiero poder editar una reseña realizada por mi
III. Como usuario quiero agregar una reseña a una empresa
IV. Como administrador quiero poder eliminar una reseña

$router->add('api/resena/:ID','GET','ApiController',getResena);
$router->add('api/edit/:ID','PUT','ApiController',edit);
$router->add('api/agregar','POST','ApiController',addResena);
$router->add('api/resena/:ID','DELETE','ApiController',getResena);

*/
