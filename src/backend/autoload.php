<?php
spl_autoload_register(function ($class_name) {
    include 'core/'.$class_name.'.php';
});