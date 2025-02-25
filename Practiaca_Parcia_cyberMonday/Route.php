<?php
 require_once 'config.php';
 require_once './libs/router.php';

<<<<<<< HEAD
    $Route = new Router();
=======
    $Route = new Route();
>>>>>>> 2f329eb1df07f02ae78847242175b09022e3c366

    $Route->add('/getResenas','GET','ResenasController','getPromocion');
    $Route->add('/getStock/{id}','GET','ResenasController','getStockRespuesto' );
    $Route->add('/addCategoria','POST','ResenasController','addCategoria');
    $Route->add('/addRespuesto','POST','ResenasController','addRespuesto');
    $Route->add('/venderRespuesto','POST','ResenasController','venderRespuesto');//REVISAR metodo 
    $Route->add('/getStockRespuesto','GET','ResenasController','getStockRepuesto');