<?php

namespace System\Model;

use PDO;
use PDOStatement;
use System\Database\Database;

abstract class BaseModel implements Model
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
        return self::fetchAll($this->db->query('SELECT * FROM ' . $this->getTable()));
    }

    /**
     * Return a record by its ID
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return self::fetch(
            $this->query('SELECT * FROM ' . $this->getTable() . ' WHERE id = ?', [$id])
        );
    }

    /**
     * Shorter syntax for prepare()/execute() queries
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function query($query, array $params)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    /**
     * @param PDOStatement $query
     * @return mixed
     */
    protected static function fetch(PDOStatement $query)
    {
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param PDOStatement $query
     * @return array
     */
    protected static function fetchAll(PDOStatement $query)
    {
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Run validation against $this->rules
     *
     * @param array $data
     * @return mixed
     */
    public static function validate(array $data)
    {
        // TODO: Implement validate() method.
    }

}