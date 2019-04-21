<?php
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function register($data){
           $this->db->query('INSERT INTO users (name, email, password, role) VALUES(:name, :email, :password, 1)');

            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function login($email, $password){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            }else{
                return false;
            }
        }

        public function findAllUsers(){
            $this->db->query('SELECT * FROM users');

            $allUsers = $this->db->resultSet();

            return $allUsers;
        }

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function findUserById($id){
            $this->db->query('SELECT * FROM users WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function deleteUser($id){
            $this->db->query('DELETE FROM users WHERE id = :id');

            $this->db->bind(':id', $id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }    