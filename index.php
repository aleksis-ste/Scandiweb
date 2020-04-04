<?php
include 'src/backend/autoload.php';
include 'config.php';

$router = new Router();

$router->get('', 'ProductList::index');
$router->get('/products/get', 'ProductList::show');

$router->post('/products/add', 'ProductList::add');
$router->post('/products/delete', 'ProductList::delete');

$router->check();


