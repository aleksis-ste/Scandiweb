<?php

class Router 
{
    private $path = array();

    public function get(string $path, string $controller): void
    {
        array_push($this->path, array($path, $controller, 'get'));
    }

    public function post(string $path, string $controller): void
    {
        array_push($this->path, array($path, $controller, 'post'));
    }

    public function check()
    {

        foreach ($this->path as $key => $value) {
            if($_SERVER['PATH_INFO'] == $value[0] && $value[2] == 'get')
                return call_user_func($value[1]);
            else if($_SERVER['PATH_INFO'] == $value[0] && $value[2] == 'post')
                return call_user_func($value[1], $_POST);
        }

    }
};