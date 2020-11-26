<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Session_model extends CI_Model
{
    public $accountId;
    public $token;
    public $isAdmin;

    public function login()
    {
        $json = $this->input->raw_input_stream;
        $data = json_decode($json);
        $this->load->database();
        $this->db->where('login', $data->login);
        $this->db->where('password', $data->password);
        $query = $this->db->get('account');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            show_error('Invalid login information.', 400, 'Error');
            exit(1);
        }

        $accountRow = $query->result()[0];
        $this->db->delete('session', array('accountId' => $accountRow->id));

        $token = bin2hex(random_bytes(64));

        $session = array(
            'accountId' => $accountRow->id,
            'token' => $token,
            'isAdmin' => $accountRow->isAdmin,
        );

        $this->db->insert('session', $session);

        header('Content-Type: application/json');
        $data = array('ok' => true, 'token' => $token);
        echo json_encode($data);
    }
}
