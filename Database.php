<?php

class Database {
    public $pdo;

    // Constructor to create the database connection
    public function __construct($config) {
        // Define the DSN with the charset and other configurations
        $dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=utf8";

        // Check if password exists and set the connection
        $this->pdo = new PDO($dsn, $config['user'], $config['pass']);
        
        // Set default fetch mode to associative array
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    // Function to run SQL queries
    public function query($sql) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement;
    }
}

?>
