<?php
    class Polls extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->pollModel = $this->model('Poll');
        }

        public function index(){
            $poll = $this->pollModel->getPollResult();

            $positive = $this->pollModel->countPositiveResult();
            $negative = $this->pollModel->countNegativeResult();

            $liked = false;
            foreach($poll as $result){
                if($result->user_id == $_SESSION['user_id']){
                    $liked = true;
                    break;
                }
            }

            $data = [
                'poll' => $poll,
                'liked' => $liked,
                'positive' => $positive,
                'negative' => $negative
            ];
                
            $this->view('polls/index', $data);
        }

        public function add(){
            $data = [
                'liked' => (int)$_POST['liked']
            ];

            $this->pollModel->addPollResult($data);

            redirect('polls/index');
        }
    }