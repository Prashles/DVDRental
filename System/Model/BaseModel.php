<?php

namespace System\Model;

abstract class BaseModel implements ModelInterface
{
    /**
     * @var string Name of the table
     */
    protected $table;

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
}