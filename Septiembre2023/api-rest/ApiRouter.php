<?php
require_once 'ApiProfesorController';
require_once 'config.php';
require_once './libs/router.php';

//resourse= parametro + verbo;
//Creo el router;
$router = new Router();

//Defino mi tabla de ruteo;

//Endpoints
//endponit para traer mi listado de categorias
//                 endpoint     verbo       desde donde llamo   motodo

//Listo mis categorias
$router->addRoute('profesores', 'GET', 'ApiProfesorController', 'getProfesores');

$router->addRoute('profesores/:ID', 'GET', 'ApiProfesorController', 'getProfesor');
