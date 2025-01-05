<?php

class Dbh { //DatabaseHandler
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = 'midproject_bncc';
    private $pdo; //Php Data Object
    
    protected function connect(){
        $dsn = "mysql:host={$this->host};dbname={$this->dbName}"; //DataSourceName

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Default manggil array associative
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }

        return $this->pdo;
    }

    protected function close() {
        $this->pdo = null;
    }    
}


