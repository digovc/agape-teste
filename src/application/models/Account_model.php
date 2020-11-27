<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once("Model_base.php");

class Account_model extends Model_base
{
    public $name;
    public $email;
    public $login;
    public $password;
    public $isEnabled;
    public $isAdmin;

    public function retrieve_users()
    {
        $request = $this->get_json_request();

        if (is_null($request->token)) {
            $this->error('Invalid token.');
        }

        if (is_null($request->index)) {
            $request->index = 0;
        }

        $this->load->database();
        $this->db->where('token', $request->token);
        $query = $this->db->get('session');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Invalid token.');
        }

        $sessionRow = $rows[0];

        if ($sessionRow->isAdmin) {
            $this->retrieve_users_with_admin($request);
        } else {
            $this->retrieve_only_self_user($sessionRow);
        }
    }

    private function retrieve_users_with_admin($request)
    {
        $limit = 10;
        $offset = $request->index * $limit;
        $query = $this->db->get('account', $offset, $limit);
        $rows = $query->result();
        $response = array('ok' => true, 'accounts' => $rows);
        $this->send_json_response($response);
    }

    private function retrieve_only_self_user($sessionRow)
    {
        $this->db->where('id', $sessionRow->adminId);
        $query = $this->db->get('account');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Invalid account.');
        }

        $accountRow = $rows[0];
        $response = array('ok' => true, 'accounts' => [$accountRow]);
        $this->send_json_response($response);
    }
}
