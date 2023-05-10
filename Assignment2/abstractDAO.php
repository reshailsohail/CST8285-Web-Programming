<?php

abstract class AbstractDAO {
    private $connection; // private instance variable to hold the database connection

    public function __construct() {
        // Create a database connection using PDO
        $dsn = 'mysql:host=localhost;dbname=demo'; // database connection details
        $username = 'root'; 
        $password = ''; 
        try {
            // Create a new PDO object with the connection details
            $this->connection = new PDO($dsn, $username, $password);
            // Set error mode to exceptions for better error handling
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage(); // Display error message if connection fails
        }
    }

    public function getConnection() {
        return $this->connection; // Getter method to access the database connection
    }

    public function getMysqli(){
        return $this->mysqli;
    }
}

?>
