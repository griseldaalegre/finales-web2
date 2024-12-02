<?php
    require_once 'config.php';
    require_once './libs/router.php';
    require_once 'controllers/ValoracionController.php';

    $router = new Router();

    $router->add('/reseña','PUT','ValoracionController','nuevaValoracion');
    $router->add('/verResena','GET','ValoracionController','getResena');