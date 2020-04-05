<?php

abstract class QueryBuilder
{
    private $db;
    private $query = '';
    private $table_name;
    private $stmt;
    private $data = array();

    function __construct($table_name)
    {
        $this->db = (new Database)->get();
        $this->table_name = $table_name;
    }

    public function select(array $columns)
    {
        $this->query = 'SELECT '.implode(',', $columns).' FROM '.$this->table_name;
        return $this;
    }

    public function where(string $column, string $operator, string $value)
    {
        array_push($this->data, $value);

        $this->query .= ' WHERE '.$column.' '.$operator.' ?';
        return $this;
    }

    public function delete(string $column, string $value)
    {
        $this->query = 'DELETE FROM '.$this->table_name;
        $this->where($column, '=', $value);

        return $this->bind();
    }

    public function insert(array $data)
    {
        $this->data = array_merge($this->data, $data);

        $this->query = 'INSERT INTO '.$this->table_name.' VALUES ('.implode(',', array_fill(0, count($data), '?')).')';

        return $this->bind();
    }

    private function bind()
    {
        $this->stmt = $this->db->prepare($this->query);

        if($this->data != null)
        {
            $params = array();
            array_push($params, $this->getTypes());
            $params = array_merge($params, $this->data);
            foreach($params as $key => $value) $params[$key] = &$params[$key];

            call_user_func_array(array($this->stmt, 'bind_param'), $params);   
        }
        
        $this->data = array();
        $this->stmt->execute();
        return $this->stmt;
    }

    public function get()
    {
        return mysqli_fetch_all($this->bind()->get_result(), MYSQLI_ASSOC);
    }

    private function getTypes(): string
    {
        $types = '';

        foreach ($this->data as $key => $value) {
            $types .= $this->getDataType($value);
        }
        
        return $types;
    }

    private function getDataType($data)
    {
        switch(gettype($data))
        {
            case 'string': return 's';
            case 'double': return 'd';
            case 'integer': return 'i';

            default:
                return 's';
        }
    }

};


