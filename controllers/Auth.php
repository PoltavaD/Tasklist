<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('auth_model');
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        session_name('crud');
        session_start();
    }

    public function index()

    {
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }

    public function login()

    {
        if (!empty($_GET['login']) && !empty($_GET['pass'])) {
            $login = $_GET['login'];
            $pass = $_GET['pass'];
        } else {
            header('location: /auth');
            exit();
        }

        $user = $this->auth_model->getUser($login);

        if(!$user) {
            header('location: /auth');
            exit();
        }

        $pass = password_verify($pass, $user['pass']);

        if ($pass) {
            $_SESSION['auth'] = 'ok';
            $_SESSION['id'] = $user['id'];
            header('location: /my_tasks/createShowTask');
            exit();
        } else {
            header('location: /auth');
            exit();
        }
    }

    public function singup()

    {
        if (!empty($_GET['pass']) && (!empty($_GET['pass2']))){
        $pass = $_GET['pass'];
        $pass2 = $_GET['pass2'];
        } else {
            header('location: /auth');
            exit();
        }

        if ($pass != $pass2) {
            echo '<a href="/auth">Пароли не совпадают!</a>';
            exit();
        }

        if (!empty($_GET['login']) && !empty($_GET['pass'])) {
            $login = $_GET['login'];
            $pass = $_GET['pass'];
        } else {
            header('location: /auth');
            exit();
        }

        $user = $this->auth_model->getUser($login);

        if($user) {
            echo '<a href="/auth">Такой пользователь уже есть</a>';
            exit();
        } else {
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $_SESSION['auth'] = 'ok';
            $_SESSION['id'] = $this->auth_model->insUser($login, $pass);
            header('location: /my_tasks/createShowTask');
            exit();
        }
    }

    public function logout()

    {
        session_destroy();
        header('location: /auth');
    }
}
