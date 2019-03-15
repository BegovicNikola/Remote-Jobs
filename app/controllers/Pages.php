<?php
    class Pages extends Controller {
        public function __construct(){
           
        }

        public function index(){
            $data = [
                'title' => 'RemoteJobs',
                'description' => 'Find fully remote jobs online with many benefits'
            ];
            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About'
            ];
            $this->view('pages/about', $data);
        }
    }