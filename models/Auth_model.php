<?php
class Auth_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUser($login)
    {
        $query = $this->db->select('*')->where('login', $login)->get('users');
        $user = $query->row_array();
        return $user;
    }

    public function insUser($login, $pass)
    {
        $data = ['login' => $login, 'pass' => $pass];
        $query = $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
}