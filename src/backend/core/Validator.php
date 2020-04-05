<?php

class Validator
{
    private $inputs;
    private $message = null;

    function __construct(array $inputs)
    {
        $this->inputs = $inputs;

        switch ($this->inputs['type']) {
            case "0":
                $this->validate(new  Disk($this->inputs));
                break;
            case "1":
                $this->validate(new  Book($this->inputs));
                break;
            case "2":
                $this->validate(new  Furniture($this->inputs));
                break;
        }

    }

    public function validate(Validate $validate)
    {
        if(!$validate->validateSKU())
            $this->message .= 'Invalid SKU or already exists <br>';
        if(!$validate->validateName())
            $this->message .= 'Invalid name <br>';
        if($validate->validatePrice())
            $this->message .= 'Invalid price <br>';
        if($validate->validateType())
            $this->message .= 'Invalid type <br>';
        if(!$validate->validateAttributes())
            $this->message .= 'Invalid attributes <br>';

        if($this->message == null)
        {
            $validate->save();
            return response(array('status' => 'success', 'message' => 'Product added to the database'));
        }   

        return response(array('status' => 'danger', 'message' => $this->message));
    }
};
