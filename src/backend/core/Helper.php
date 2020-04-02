<?php

function response($response)
{
    header("Content-Type: application/json");
    echo json_encode($response);
}