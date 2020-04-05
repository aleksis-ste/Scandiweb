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

    public function update(array $columns, array $data)
    {
        $update = "";
        foreach ($columns as $key => $value)
            $update .= $value.' = '.' "'.$data[$key].'" , ';

        $update = substr($update, 0, -2);

        $this->query = 'UPDATE '.$this->table_name.' SET '.$update;
        $this->where('sku', '=', $this->sku);

        return $this->db->query($this->query);
    }

    public function delete(string $column, string $value)
    {
        $this->query = 'DELETE FROM '.$this->table_name;
        $this->where($column, '=', $value);

        return $this->db->query($this->query);
    }

    public function insert(array $data)
    {
        $this->query = 'INSERT INTO '.$this->table_name." VALUES('".implode("','", $data)."')";
        return $this->db->query($this->query);
    }

    public function get()
    {
        return $this->db->query($this->query)->fetch_all(MYSQLI_ASSOC);
    }

};


