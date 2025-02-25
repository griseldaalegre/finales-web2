<?php

require_once './ProfesorModel';
require_once './ProfesorView';

class ApiProfesorController
{
    public $profesorModel;
    public $profesorView;

    public function __construct()
    {
        $this->profesorModel = new ProfesorModel();
        $this->profesorView = new ProfesorView();
    }

    function getProfesores()
    {
        $listaProfesores = $this->profesorModel->getProfesores();

        if ($listaProfesores) {
            $this->profesorView->mensaje($listaProfesores, 200);
        } else {
            $this->profesorView->mensaje("No hay profesores", 200);
        }
    }

    function getProfesor()
    {
        $profesor = $this->profesorModel->getProfesor($id);

        if (!empty($profesor)) {
            $this->profesorView->mensaje($profesor, 200);
        } else {
            $this->profesorView->mensaje("No hay profesores", 200);
        }
    }
}
