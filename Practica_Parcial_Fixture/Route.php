<?php

require_once '/Route.php';
require_once '/FixtureController.php';


$router=new Router();


$router->add('/addFecha','POST','FixtureController','addFecha');