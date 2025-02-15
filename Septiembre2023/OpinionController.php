<?php

require_once 'OpinionView';
require_once 'OpinionModel';
require_once 'ProfesorModel';

class OpinionController
{
    public $opinionView;
    public $opinionModel;
    public $profesorModel;

    function __construct()
    {
        $this->opinionModel = new OpinionModel();
        $this->opinionModel = new OpinionView();
        $this->profesorModel = new ProfesorModel();
    }

    function ingresarRegistro()
    {
        //400 no se pudo procesar 
        //404 no se puede acceder a lapagina

        $dni = $_POST['dni'];
        $fecha = $_POST['fecha'];
        $imagen =  $_POST['imagen'];
        $id_profesor =  $_POST['id_profesor'];

        if (!empty($dni) && !empty($fecha) && !empty($imagen) && empty($id_profesor)) {
            $opinion = $this->opinionModel->cantidadDeOpiniones($dni, $id_profesor);
            if (!empty($opinion)) {
                $this->$opinionModel->insertarOpinion($dni, $fecha, $imagen, $id_profesor);
                $this->opinionView->mensaje("Se agrego correctamente", 200);
            } else {
                $this->opinionView->mensaje("El alumno ya realizo la encuesta", 400);
            }
        } else {
            $this->opinionView->mensaje("Hay campos vacios", 400);
        }
    }

    function obtenerImagen($id)
    {

        $profesor = $this->profesorModel->getProfesorById($id);
        if (!empty($profesor)) {

            $opinion = $this->opinionModel->getOpiniones($id);
            $positiva = $this->opinionModel->calcularImagenPositiva($opinion);
            $negativa = $this->opinionModel->calcularImagennegativa($opinion);

            $datos = [
                'positivo' => $positiva,
                'negativo' => $negativa,
                'profesor' => $profesor
            ];

            $this->opinionView->mensaje($datos, 200);
        } else {
            $this->opinionView->mensaje("No existe el profesor", 400);

        }
    }
}
