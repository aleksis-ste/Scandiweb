<?php

abstract class QueryBuilder
{
    private $db;
    private $query = '';
    private $table_name;

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
        $this->query .= ' WHERE '.$column.' '.$operator.' "'.$value.'"';
        return $this;
    }

    public function get()
    {
        return $this->db->query($this->query)->fetch_all(MYSQLI_ASSOC);
    }

};


