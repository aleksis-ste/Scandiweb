<?php

class ProductList
{

    public static function index(): void
    {        
        include './src/frontend/index.html';
    }

    public static function show()
    {
        return response((new Product)->getAll());
    }

    public static function add(array $inputs): void 
    {
        $validator = new Validator($inputs);
    }

    public static function delete(array $data)
    {
        foreach ($data as $value) {
            (new Product)->delete('sku', $value);
        }

        return response(array('status' => 'success', 'message' => 'Deleted count of products: '.count($data)));
    }

};