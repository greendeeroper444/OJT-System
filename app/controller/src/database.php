<?php

class Database{
    private $host = DB_HOST;
    private $database  = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $port = DB_PORT;
    private $charset = 'utf8';
    private $conn;

    public function __construct() {
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset};}";
        $this->conn = new \PDO($dsn, $this->user, $this->pass, $options);
    }   

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function lastInsertId(){
        return $this->conn->lastInsertId();
    }

}