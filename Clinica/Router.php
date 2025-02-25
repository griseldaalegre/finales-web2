<?php

require_once 'controllerTurnos';
$router = new Router();

$router->add('/listaTurnos','GET', 'TurnosController', 'getTurnos');

$router->add('/addProfesional','POST', 'TurnosController', 'addProfesional');
