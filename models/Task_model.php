<?php
class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function showTasks()
    {
        $query = $this->db->select('*')->where('user_id', $_SESSION['id'])->get('tasks');
        $row = $query->result_array();
        return $row;
    }

    public function getTaskById($id)
    {
        $query = $this->db->select('*')->where('id',$id)->where('user_id',$_SESSION['id'])->get('tasks');
        $task = $query->row_array();
        return $task;
    }

    public function insertNewTask($task, $comments, $deadline)
    {
        $data = [
            'task' => $task,
            'comments' => $comments,
            'deadline' => $deadline,
            'user_id' => $_SESSION['id']
        ];
        $query = $this->db->insert('tasks', $data);
    }

    public function deleteTaskById($num_string)
    {
        $query = $this->db->delete('tasks',['user_id' => $_SESSION['id'], 'id' => $num_string]);
    }
    public function updateTask($id, $task, $comments, $deadline)
    {
        $data = [
            'id' => $id,
            'task' => $task,
            'comments' => $comments,
            'deadline' => $deadline,
            'user_id' => $_SESSION['id']
        ];
        $query = $this->db->replace('tasks', $data);
    }

    public function deleteTask($id)
    {
        $del = $this->db->delete('tasks',['user_id' => $_SESSION['id'], 'id' => $id]);
    }
}