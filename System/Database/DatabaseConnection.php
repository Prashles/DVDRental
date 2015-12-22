<?php

namespace System\Database;

use \PDO;

/**
 * Class for database connection
 * (MySQL only)
 */

class DatabaseConnection
{
    /**
     * @var PDO The PDO instance
     */
    protected $db;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $databaseName;

    /**
     * Set properties from env or value
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $databaseName
     */
    public function __construct($host = null, $username = null, $password = null, $databaseName = null)
    {
        $this->host = ($host !== null) ? $host : getenv('DB_HOST');
        $this->username = ($username !== null) ? $username : getenv('DB_USERNAME');
        $this->password = ($password !== null) ? $password : getenv('DB_PASSWORD');
        $this->databaseName = ($databaseName !== null) ? $databaseName : getenv('DB_NAME');

        $this->db = $this->connect();
    }

    /**
     * Connect to the database
     *
     * @return PDO
     * @throws \Exception
     */
    public function connect()
    {
        try {
            return new PDO("mysql:host={$this->host};dbname={$this->databaseName};charset=utf8",
                $this->username, $this->password, [PDO::ATTR_EMULATE_PREPARES => false,
                                                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            throw new \Exception('Could not connect to database: ' . $e->getMessage());
        }
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->db;
    }
}