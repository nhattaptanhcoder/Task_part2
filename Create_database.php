<?php


require_once './config,php';

class Database
{

    private $conn;
    // $instance chua ket noi
    private static $instance = null;
    //ham tao ket noi
    public function __construct()
    {
        $this->conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS,DATABASE_NAME);
        if ($this->conn->connect_error) {
            die("Something wrong :{$this->conn->connect_error}");
        }
        $this->conn->query("CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME);
        $this->conn->select_db(DATABASE_NAME);
        $this->conn->set_charset('utf8');
    }
    //design pattern- single ton de goi database 1 lan va ko can khoi tao ke noi lai khi thuc hien truy van 
    public static function getInstance(){
    if(self::$instance == null){
        self::$instance = new Database();
    }
    return self::$instance;
    }



    //ham tra ve ket noi
    public function getConnection(){
        return $this->conn;
    }
    // ham huy ket noi
    public function __destruct()
    {
     if($this->conn){
        $this->conn->close();
     }
    }
}
