<?php

class Disk extends Product implements Validate
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
        if(is_numeric($this->inputs['size']) && floatval($this->inputs['size'] >= 0))
        {
            $this->attribute = $this->inputs['size'].' MB';
            return true;
        }

        return false;
    }
};