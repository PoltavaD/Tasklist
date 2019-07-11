<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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
        if (!empty($_GET['login']) && (!empty($_GET['login']))) {
            $login = $_GET['login'];
        } else {
            header('location: /auth');
            exit();
        }

        if (!empty($_GET['pass']) && (!empty($_GET['pass']))) {
            $pass = $_GET['pass'];
        } else {
            header('location: /auth');
            exit();
        }

        $this->db->select('*')->where('login', $login);
        $query = $this->db->get('users');
        $user = $query->row_array();

        if(!$user) {
            header('location: /auth');
            exit();
        }

        if (isset($user['pass']) && $user['pass'] != '') {
            $pass = password_verify($pass, $user['pass']);
        } else {
            header('location: /auth/logout');
            exit();
        }

        if ($pass) {
            $_SESSION['auth'] = 'ok';
            $_SESSION['id'] = $user['id'];
            header('location: /my_tasks/create_task');
            exit();
        }

    }

    public function singup()

    {
        if (!empty($_GET['pass']) && (!empty($_GET['pass2']))){
        $pass = $_GET['pass'];
        $pass2 = $_GET['pass2'];
        }

        if ($pass != $pass2) {
            echo '<a href="/auth">Пароли не совпадают!</a>';
            exit();
        }

        if (!empty($_GET['login']) && (!empty($_GET['pass']))) {
            $login = $_GET['login'];
            $pass = $_GET['pass'];
        } else {
            header('location: /auth');
            exit();
        }

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $this->db->select('*')->where('login', $login);
        $query = $this->db->get('users');
        $user = $query->row_array();

        $data = [
            'login' => $login,
            'pass' => $pass
        ];

        if($user) {
            echo '<a href="/auth">Такой пользователь уже есть</a>';
            exit();
        } else {
            $this->db->insert('users', $data);
            $_SESSION['auth'] = 'ok';
            $_SESSION['id'] = $this->db->insert_id();
            header('location: /my_tasks/create_task');
            exit();
        }
    }

    public function logout()

    {
        session_destroy();
        header('location: /auth');
    }
}
