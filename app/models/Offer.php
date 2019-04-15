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
    }