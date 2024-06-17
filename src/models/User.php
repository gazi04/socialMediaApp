<?php
require_once BASE_PATH . "/src/Database.php";

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($username, $email, $password) {
        $this->db->query('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        return $this->db->execute();
    }

    public function findByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }
}
?>
