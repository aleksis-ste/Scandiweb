<?php

class Furniture extends Product implements Validate
{
    protected $inputs;

    function __construct(array $inputs)
    {
        parent::__construct();
        $this->inputs = $inputs;

        $this->sku = $inputs['sku'];
        $this->name = $inputs['name'];
        $this->price = $inputs['price'];
        $this->type = $inputs['type'];
        
    }

    public function validateAttributes()
    {
        if(is_numeric($this->inputs['height']) && is_numeric($this->inputs['width']) && is_numeric($this->inputs['length']))
        {
            $this->attribute = $this->inputs['height'].'x'.$this->inputs['width'].'x'.$this->inputs['length'];
            return true;
        }

        return false;
    }

};