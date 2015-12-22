<?php

namespace System\Database;

class Database
{
    /**
     * @var \PDO The PDO instance
     */
    protected $connection;

    /**
     * Connect to the database
     */
    public function __construct()
    {
        $this->conection = (new DatabaseConnection(getenv('DB_HOST'), getenv('DB_USER'),
            getenv('DB_PASSWORD'), getenv('DB_NAME')))->connect();
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->conection;
    }
}