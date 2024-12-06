<?php
    require_once './libs/router.php';
    require_once 'ApiController';

    $route=new Router();

    $route->add('api/getPeliculas','GET','ApiController','getPeliculas');

    $route->add('api/getFiltroPeliculas','GET','ApiController','getPeliculasFiltro');

    $route->add('api/valoracionPeliculas','GET','ApiController','valoracionPeliculas');
