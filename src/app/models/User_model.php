<?php

class User_model{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllUser(){
        $this->db->query("Select * from " . $this->table);
        return $this->db->resultSet();
    }
    public function getUserPass(){
        $this->db->query("Select username,password from " . $this->table);
        return $this->db->resultSet();
    }
    public function getUserByUsername($username){
        $this->db->query("select * from user where username= '".$username."';");
        return $this->db->single();
    }
    public function insertUser($username, $email, $password){
        $this->db->query("INSERT INTO USER VALUES('".$username."','".$password."','".$password."',0);");
        $this->db->execute();
    }
    public function getUserCount($username){
        $this->db->query("SELECT COUNT(*) as count FROM user WHERE username= '".$username."';");
        $count = $this->db->single();
        return $count;
    }
}