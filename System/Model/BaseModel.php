<?php

namespace System\Model;

use PDO;
use PDOStatement;
use System\Database\Database;
use System\Message\Message;
use Valitron\Validator;

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

    /**
     * @var array Validation rules for the model
     */
    protected static $rules;

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
    public static function fetch(PDOStatement $query)
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
     * Mass assignment
     *
     * @param array $data
     * @return int
     */
    public function create(array $data)
    {
        $cols = implode('`, `', array_keys($data));
        $cols = '`' . $cols . '`';

        $valArgs = implode(', ', array_fill(0, count($data), '?'));

        $this->query('INSERT INTO ' . $this->getTable() . ' (' . $cols . ') VALUES (' .
            $valArgs . ')', array_values($data));

        return (int) $this->db->lastInsertId();
    }

    /**
     * Run validation against $this->rules
     *
     * @param array $data
     * @return Message|bool
     */
    public static function validate(array $data)
    {
        $validator = new Validator($data);
        $validator->rules(static::$rules);

        if ($validator->validate()) {
            return true;
        }
        else {
            return new Message($validator->errors());
        }
    }

    /**
     * @param $column string
     * @param $value string
     * @return bool
     */
    public function isUnique($column, $value)
    {
        $get = $this->query('SELECT id FROM ' . $this->getTable() . ' WHERE `' . $column . '` = ?',
            [$value]);

        return ($get->rowCount() === 0);
    }

    /**
     * @param $id int
     * @return bool
     */
    public function existsById($id)
    {
        return (bool) $this->getById($id);
    }

}