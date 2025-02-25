<?php

require_once '/Router';
require_once 'ApiController';

$route=new Route();

$route->addRoute('auditoria','GET','ApiController','auditoria');