<?php

namespace System\Model;

use System\Database\Database;

abstract class BaseModel
{
    /**
     * @var \PDO
     */
    public $db;

    /**
     * @var string Name of the table
     */
    protected $table;

    public function __construct()
    {
        $this->db = (new Database)->getConnection();
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * Return all records in table
     *
     * @return \PDOStatement
     */
    public function all()
    {
        $get = $this->db->prepare('SELECT * FROM ?');
        return $get->execute([$this->getTable()]);
    }
}