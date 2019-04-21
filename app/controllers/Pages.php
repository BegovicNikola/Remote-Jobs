<?php
    class Pages extends Controller {
        public function __construct(){
           
        }

        public function index(){
            if(isLoggedIn()){
                redirect('offers');
            }

            $data = [
                'title' => 'RemoteJobs',
                'description' => 'Find remote jobs online'
            ];

            $this->view('pages/index', $data);
        }
    }