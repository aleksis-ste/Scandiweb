<?php

interface Validate
{
    public function validateSKU();
    public function validateType();
    public function validatePrice();
    public function validateAttributes();
};