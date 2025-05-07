<?php
class DBController {
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpassword = "";
    private $dbname = "profile";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
            
            if ($this->conn->connect_error) {
                error_log("Database connection failed: " . $this->conn->connect_error);
                throw new Exception("Database connection failed: " . $this->conn->connect_error);
            }

        } catch (Exception $e) {
            error_log("Error in DBController: " . $e->getMessage());
            throw $e;
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>