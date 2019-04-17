<?php
    class Offer {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getOffers(){
            // Zasto ovde staviti alias
            $this->db->query('SELECT *,
                            offers.id as o_id,
                            users.id as u_id,
                            offers.created as o_created,
                            users.created as u_created 
                            FROM offers
                            INNER JOIN users
                            ON offers.user_id = users.id
                            ORDER BY offers.created DESC');

            $results = $this->db->resultSet();

            return $results;
        }

        public function addOffer($data){
            $this->db->query('INSERT INTO offers (user_id, title, description, company) VALUES(:user_id, :title, :description, :company)');

            // Bind params and values
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':company', $data['company']);

            // Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getSingleOffer($id){
            $this->db->query('SELECT * FROM offers WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }
    }