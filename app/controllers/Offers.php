<?php

    class Offers extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }
            
            $this->offerModel = $this->model('Offer');
            $this->userModel = $this->model('User');
        }

        public function index(){
            $offers = $this->offerModel->getOffers();

            $data = [
                'offers' => $offers
            ];
                
            $this->view('offers/index', $data);
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data=[
                    'title' => trim($_POST['title']),
                    'description' => trim($_POST['description']),
                    'company' => trim($_POST['company']),
                    'title_error' => '',
                    'description_error' => '',
                    'company_error' => ''
                ];
                
                if(empty($data['title'])){
                    $data['title_error'] = 'Please enter the title';
                }

                if(empty($data['description'])){
                    $data['description_error'] = 'Please enter the description';
                }

                if(empty($data['company'])){
                    $data['company_error'] = 'Please enter the company';
                }

                if(empty($data['title_error']) && empty($data['description_error']) && empty($data['company_error'])){
                   if($this->offerModel->addOffer($data)){
                       flashMessage('offer_message', 'Offer successfuly added');
                       redirect('offers');
                   } else {
                       die('Something went wrong');
                   }
                } else {
                    $this->view('offers/add', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'description' => '',
                    'company' => ''
                ];

                $this->view('offers/add', $data);
            }
        }

        public function edit($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data=[
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'description' => trim($_POST['description']),
                    'company' => trim($_POST['company']),
                    'title_error' => '',
                    'description_error' => '',
                    'company_error' => ''
                ];
                
                if(empty($data['title'])){
                    $data['title_error'] = 'Please enter the title';
                }

                if(empty($data['description'])){
                    $data['description_error'] = 'Please enter the description';
                }

                if(empty($data['company'])){
                    $data['company_error'] = 'Please enter the company';
                }

                if(empty($data['title_error']) && empty($data['description_error']) && empty($data['company_error'])){
                   if($this->offerModel->updateOffer($data)){
                       flashMessage('offer_message', 'Offer successfuly updated');
                       redirect('offers');
                   } else {
                       die('Something went wrong');
                   }
                } else {
                    $this->view('offers/edit', $data);
                }

            } else {
                $offer = $this->offerModel->getSingleOffer($id);

                if($offer->user_id != $_SESSION['user_id']){
                    redirect('offers');
                }

                $data = [
                    'id' => $id,
                    'title' => $offer->title,
                    'description' => $offer->description,
                    'company' => $offer->company
                ];

                $this->view('offers/edit', $data);
            }
        }

        public function job($id){
            $offer = $this->offerModel->getSingleOffer($id);
            
            $user = $this->userModel->findUserById($offer->user_id);

            $data = [
                'offer' => $offer,
                'user' => $user
            ];

            $this->view('offers/job', $data);
        }

        public function delete($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($this->offerModel->deleteOffer($id)){
                    flashMessage('offer_message', 'Offer successfully removed');
                    redirect('offers');
                } else {
                    die('Something went wrong');
                }
            } else {
                redirect('offers');
            }
        }
    }