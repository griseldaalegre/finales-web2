<?php
require_once 'Route';
require_once 'Controller';

$route=new Route();


$route->add('/addEncomienda','POST','controller','addEncomienda');
$route->add('/getCantidad','GET','controller','getCantidad');