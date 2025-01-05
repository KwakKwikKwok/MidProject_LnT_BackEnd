<?php
require_once '../database/Dbh.php';

class Users extends Dbh {
    protected function getAllUsers(){
        $sql = "SELECT * FROM users WHERE id !=1"; //Sql Query (mau add, delete ato apa)
        $stmt = $this->connect()->query($sql); //Connect and setting db
        $results = $stmt->fetchAll(); //Fetching semua Users dr db;
        $this->close();
        
        return $results; //returning the All of the Users
    }
    
    protected function getUser($id) {
        $sql = "SELECT * FROM users WHERE id = ?"; //Sql Query (mau add, delete ato apa)
        $stmt = $this->connect()->prepare($sql); //Connect and setting db
        $stmt->execute([$id]);
        $results = $stmt->fetch(); //Fetching semua Users dr db;
        $this->close(); //Don't Forget to Close the Database 
        
        return $results; //returning the All of the Users
    }
    
    protected function getUserEmail($email){
        $sql = "SELECT * FROM users WHERE email = ?"; //Sql Query (mau add, delete ato apa)
        $stmt = $this->connect()->prepare($sql); //Connect and setting db
        $stmt->execute([$email]);
        $results = $stmt->fetchAll(); //Fetching semua Users dr db;
        $this->close(); //Don't Forget to Close the Database 
        
        return $results; //returning the All of the Users
    }

    protected function getPhoto($photo){
        $sql = "SELECT * FROM users WHERE photo = ?"; //Sql Query (mau add, delete ato apa)
        $stmt = $this->connect()->prepare($sql); //Connect and setting db
        $stmt->execute([$photo]);
        $results = $stmt->fetchAll(); //Fetching semua Users dr db;
        $this->close();
        
        return $results; 
    }
    
    protected function setUser($first_name, $last_name, $email, $password,$photo, $bio) {
        $sql = "INSERT INTO users(first_Name, last_name, email, pass, photo, bio) VALUES (?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql); //preparing SQL Query

        $stmt->execute([ // Running Query yg udh disiapin
            $first_name,
            $last_name,
            $email,
            $password,
            $photo,
            $bio
        ]);

        $this-> close();

    }
    
    protected function delete($userID) {
        $sql = "DELETE FROM users WHERE id =?" ;
        $stmt = $this->connect()->prepare($sql); //preparing SQL Query

        $stmt->execute([$userID]);

        $this-> close();
    }

    protected function update($id, $first_name, $last_name, $email, $photo, $bio){
        $sql = "UPDATE users set first_Name = ?, last_name = ?, email = ?, photo = ?, bio =? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql); //preparing SQL Query

        $stmt->execute([ // Running Query yg udh disiapin
            $id,
            $first_name,
            $last_name,
            $email,
            $photo,
            $bio
        ]);

        $this-> close();
    }
}