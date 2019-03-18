<?php
    class Users extends Controller {
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize inputs even if using prepared statements
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];
                // Validate username
                if(empty($data['name'])){
                    $data['name_error'] = 'Please enter username';
                }
                // Validate email
                if(empty($data['email'])){
                    $data['email_error'] = 'Please enter email';
                }else{
                    // Check email
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_error'] = 'Email is already taken';
                    }
                }
                // Validate password
                if(empty($data['password'])){
                    $data['password_error'] = 'Please enter password';
                }elseif(strlen($data['password'])<6){
                    $data['password_error'] = 'Password must be at least 6 characters';
                }
                // Validate confirm passoword
                if(empty($data['confirm_password'])){
                    $data['confirm_password_error'] = 'Please confirm password';
                }else{
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_error'] = 'Passwords do not match';
                    }
                }
                // Validate if all errors are empty
                if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
                    // Validated

                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->register($data)){
                        redirect('users/login');
                    }else{
                        die('Something went wrong!');
                    }
                }else{
                    // Load view with errors
                    $this->view('users/register', $data);
                }
            }else{
                // Init data and persist
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];

                // Load View
                $this->view('users/register', $data);
            }
        }

        public function login(){
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize inputs even if using prepared statements
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_error' => '',
                    'password_error' => ''
                ];
                // Validate username
                if(empty($data['email'])){
                    $data['email_error'] = 'Please enter email';
                }
                // Validate email
                if(empty($data['password'])){
                    $data['password_error'] = 'Please enter password';
                }
                // Validate if all errors are empty
                if(empty($data['email_error']) && empty($data['password_error'])){
                    die('Success');
                }else{
                    // Load view with errors
                    $this->view('users/login', $data);
                }
            }else{
                // Init data and persist
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => ''
                ];

                // Load View
                $this->view('users/login', $data);
            }
        }
    }
    