<?php
class My_tasks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('task_model');
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        session_name('crud');
        session_start();
    }

    public function createShowTask()
    {
        {
            $this->load->view('header');
            $this->load->view('tasks');
            $this->load->view('footer');
        }

        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
        }

        if (!empty($_GET['comments'])) {
            $comments = $_GET['comments'];
        } else {
            $comments = 'comments';
        }

        if (isset($_GET['deadline']) && $_GET['deadline'] != '') {
            $deadline = $_GET['deadline'];
        } else {
            $deadline = date('Y-m-d', time() + 2592000);
        }

        if (empty($_GET['task'])) {
            echo "Введите задачу" . '<br><br><br>';
        } else {
            $task = $_GET['task'];
            $this->task_model->insertNewTask($task, $comments, $deadline);
        }

        $tasks = $this->task_model->showTasks();

        foreach ($tasks as $task) {
            echo ($task['task']) . ' ' . ($task['comments']) . ' ' . ($task['deadline']) . ' ' . "<a href='/my_tasks/delTask?id={$task['id']}'>del</a>" . ' ' . "<a href='/my_tasks/modifyTask?id={$task['id']}'>modify</a>" . '<br>';
        }
    }

    public function modifyTask()
    {
        if (!isset($_GET['id'])) {
            header('location: /my_tasks/createShowTask');
            exit();
        } else {
            $id = $_GET['id'];
        }

        $row = $this->task_model->getTaskById($id);

        $this->load->view('header');
        $this->load->view('modify', [
            'task' => $row
        ]);
        $this->load->view('footer');
    }

    public function saveTask()
    {
        if(isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        } else {
            header('location: /my_tasks/createShowTask');
            exit();
        }

        if (empty($_GET['comments'])) {
            $comments = 'comments';
        } else {
            $comments = $_GET['comments'];
        }

        if(!empty($_GET['deadline'])) {
            $deadline = $_GET['deadline'];
        } else {
            $deadline = date('Y-m-d', time() + 2592000);
        }

        $this->task_model->updateTask($id, $task, $comments, $deadline);
        header('location: /my_tasks/createShowTask');
        exit();
    }

    public function delTask()
    {
        if (!isset($_GET['id'])) {
            header('location: /my_tasks/createShowTask');
            exit();
        } else {
            $id = $_GET['id'];
        }
        $del = $this->task_model->deleteTask($id);
        header('location: /my_tasks/createShowTask');
        exit();
    }
}