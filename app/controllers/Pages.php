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
                'description' => 'Find fully remote jobs online with many benefits'
            ];

            $this->view('pages/index', $data);
        }
    }