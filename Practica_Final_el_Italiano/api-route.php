<?php

require_once 'apiRoute';
require_once 'apiController';

$route=new ApiRoute();

$route->addRoute('/estado','GET','apiController','getEstado');