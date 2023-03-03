<?php 
require('app/models/UserModel.php');

class Auth extends BaseController 
{
    private $user;
    
    public function __construct()
    {
        if(Helper::is_login()) {
            $this->redirect();
        }
        
        $this->user = new UserModel();
    }
    
    public function index() 
    {
        return $this->view('auth/login');
    }

    public function proses_login()
    {
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $data       = $this->user->getUserByUsername($username);

        if(!isset($data)) {
            Helper::flash_message('flash', 'Username salah', 'alert-danger');
            $this->redirect('auth');
        } else {
            if($data['password'] != $password) {
                Helper::flash_message('flash', 'Password salah', 'alert-danger');
                $this->redirect('auth');
            } else {
                $_SESSION['username']   = $data['username'];
                $_SESSION['name']       = $data['name'];
                
                $this->redirect();
            }
        }

    }

    public function logout()
    {
        session_destroy();
        session_unset();
        $this->redirect('auth');
    }
}