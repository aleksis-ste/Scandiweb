<?php

class Router 
{
    private $path = array();

    public function get(string $path, string $controller): void
    {
        array_push($this->path, array($path, $controller));
    }

    public function check()
    {
        foreach ($this->path as $key => $value) {
            if($_SERVER['PATH_INFO'] == $value[0])
                return call_user_func($value[1]);
        }

    }
};