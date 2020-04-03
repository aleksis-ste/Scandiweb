<?php

class ProductList
{

    public static function index(): void
    {        
        include './src/frontend/index.html';
    }

    public static function show(): void
    {
        echo response((new Product)->getAll());
    }

};