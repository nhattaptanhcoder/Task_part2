<?php
//tao table
require_once './Create_database.php' ;

class User{

   private $db;
   //tao ket noi voi database
   public function __construct()
   {
    $this->db = Database::getInstance();
    $this->createTables();
   }

   public function create($username,$password,$email,$phone,$gender,$address){
    $sql = "INSERT INTO users (username,password,email,phone,gender,address) VALUES (?,?,?,?,?,?)";
    $stmt = $this->db->getConnection()->prepare($sql);
    $stmt->bind_param("ssssss",$username,$password,$email,$phone,$gender,$address);
    $stmt->execute();
    $stmt->close();
   }
   public function createTables(){
    $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(50) NOT NULL UNIQUE,
    gender ENUM('Male','Female') default 'Male',
    address VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = ' TABLE USER_PASS' ";
    $this->db->getConnection()->query($sql);
   }
   public function login($username, $password) {
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $this->db->getConnection()->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);

    if ($stmt->fetch()) {
        $stmt->close();
        return ($password === $hashedPassword); // Nếu dùng password_hash thì dùng password_verify()
    } else {
        $stmt->close();
        return null; // username không tồn tại
    }
}

}
