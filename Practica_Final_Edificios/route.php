<?php

require_once '/Router';
require_once 'controll';

$router = new Router();


$router->addRoute('/addPago','POST','controll','addPago');