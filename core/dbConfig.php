<?php
class DBConfig {
    private $host = 'localhost'; // Database host
    private $dbname = 'job_application_system'; // Database name
    private $username = 'root'; // Database username
    private $password = ''; // Database password
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
}
