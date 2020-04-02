<?php
include 'src/backend/autoload.php';
include 'src/backend/core/Helper.php';
include 'config.php';

$router = new Router();

$router->get('', 'ProductList::index');

$router->get('/products/get', 'ProductList::show');

$router->check();


