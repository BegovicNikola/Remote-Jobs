<?php

    class Offers extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->offerModel = $this->model('Offer');
        }

        public function index(){
            $offers = $this->offerModel->getOffers();

            $data = [
                'offers' => $offers
            ];

            $this->view('offers/index', $data);
        }

        public function add(){
            $data = [
                'title' => '',
                'description' => '',
                'company' => ''
            ];

            $this->view('offers/add', $data);
        }
    }