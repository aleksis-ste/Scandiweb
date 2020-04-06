<?php

class Product extends QueryBuilder
{
    private $table_name = 'products';

    protected $inputs;

    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $attribute;

    function __construct()
    {
        parent::__construct($this->table_name);
    }

    public function getArray(): array
    {
        return array($this->sku, $this->name, $this->price, $this->type, $this->attribute);
    }

    public function find(string $sku)
    {
        return $this->select(['*'])->where('sku', '=', $sku)->get();   
    }

    public function save()
    {
        return $this->insert(array($this->sku, $this->name, $this->price, $this->type, $this->attribute));
    }

    public function getAll()
    {
        return $this->select(['*'])->get();
    }

    public function validateSKU()
    {
        return (!preg_match('/\s/', $this->inputs['sku']) && !$this->find($this->inputs['sku']) && (strlen($this->inputs['sku']) > 0));
    }

    public function validateName()
    {
        return (strlen($this->inputs['name']) > 0);
    }

    public function validatePrice()
    {
        return !(filter_var($this->inputs['price'], FILTER_VALIDATE_FLOAT) && (strlen($this->inputs['price']) > 0) && floatval($this->inputs['price'] >= 0));
    }

    public function validateType()
    {
        return !(preg_match('/[0-2]/', $this->inputs['type']) && (strlen($this->inputs['type']) > 0));
    }

};

