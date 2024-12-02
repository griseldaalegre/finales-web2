<?php
 require_once 'config.php';
 require_once './libs/router.php';

    $Route = new Route();

    $Route->add('/getResenas','GET','ResenasController','getPromocion');
    $Route->add('/getStock/{id}','GET','ResenasController','getStockRespuesto' );
    $Route->add('/addCategoria','POST','ResenasController','addCategoria');
    $Route->add('/addRespuesto','POST','ResenasController','addRespuesto');
    $Route->add('/venderRespuesto','POST','ResenasController','venderRespuesto');//REVISAR metodo 
    $Route->add('/getStockRespuesto','GET','ResenasController','getStockRepuesto');