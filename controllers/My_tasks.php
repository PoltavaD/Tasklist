<?php
class My_tasks extends CI_Controller
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

    public function create_task()
    {
        $this->load->view('header');
        $this->load->view('tasks');
        $this->load->view('footer');
    }

}
