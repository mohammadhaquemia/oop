<?php

namespace App\Models;

use PDO;

class User
{
        private $conn;
        private $table = "user";
    
        public $id;
        public $name;
        public $email;
    
        public function __construct($db)
        {
            $this->conn = $db;
        }
    
        public function loginCheck($email, $password)
        {
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // If user found and password is correct
            if ($user && password_verify($password, $user['password'])) {
                return $user; // Return user data for session handling
            }
    
            return false; // Login failed
        }
    
}



?>