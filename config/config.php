<?php

class DatabaseConnection
{
    // private $host = 'localhost';
    // private $db_name = 'event_management_system';
    // private $username = 'root';
    // private $password = '';
    // private $conn;

    // private $host = 'sql210.infinityfree.com';
    // private $db_name = 'if0_38189278_event_management_system';
    // private $username = 'if0_38189278';
    // private $password = 'WKKFKt0ai8njlE8';
    // private $conn;

    private $host = 'db';
    private $db_name = 'event_management_system';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}