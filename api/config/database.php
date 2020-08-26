<?php
class Database
{
    private $host = "localhost";
    private $port = 3306;
    private $DB_Name = "employees_api";
    private $DB_Username = "root";
    private $DB_Password = "noursql";
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . "; port=" . $this->port . "; dbname=" . $this->DB_Name, $this->DB_Username, $this->DB_Password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error" . $e->getMessage();
        }

        return $this->conn;
    }
}
