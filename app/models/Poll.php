<?php
    class Poll {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPollResult(){
            
            $this->db->query('SELECT * FROM poll');

            $results = $this->db->resultSet();

            return $results;
        }

        public function addPollResult($data){
            $this->db->query('INSERT INTO poll (user_id, liked) VALUES(:user_id, :liked)');

            // Bind params and values
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':liked', $data['liked']);

            // Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function countPositiveResult(){
            $this->db->query('SELECT COUNT(*) as counted FROM poll WHERE liked = 1');

            $result = $this->db->single();

            return $result->counted;
        }

        public function countNegativeResult(){
            $this->db->query('SELECT COUNT(*) as counted FROM poll WHERE liked = 0');

            $result = $this->db->single();

            return $result->counted;
        }
    }
