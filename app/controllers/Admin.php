 <?php

    class Admin extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            if(isLoggedIn() && !isAdmin()){
                redirect('offers');
            }
            
            $this->offerModel = $this->model('Offer');
            $this->userModel = $this->model('User');
        }

        public function index(){
            // vraca html stranu
            $this->view('admin/index');
        }

        public function users(){
            // vraca json sa userima
            $users = $this->userModel->findAllUsers();

            json($users);
        }

        public function offers(){
            // vraca json sa oferima usera po id-ju
            $offers = $this->offerModel->getOffers();

            json($offers);
        }
    }