<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once("Model_base.php");

class Session_model extends Model_base
{
    public $accountId;
    public $token;
    public $isAdmin;

    public function login()
    {
        $request = $this->get_json_request();

        if (is_null($request->login)) {
            $this->error('Invalid login or password.');
        }

        if (is_null($request->login)) {
            $this->error('Invalid login.');
        }

        if (is_null($request->password)) {
            $this->error('Invalid password.');
        }

        $this->load->database();

        $this->db->where('login', $request->login);
        $this->db->where('password', $request->password);
        $query = $this->db->get('account');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Account not found.');
        }

        $accountRow = $rows[0];
        $this->db->delete('session', array('accountId' => $accountRow->id));

        $token = bin2hex(random_bytes(32));

        $session = new Session_model();
        $session->accountId = $accountRow->id;
        $session->token = $token;
        $session->isAdmin = $accountRow->isAdmin;

        $this->db->insert('session', $session);

        $response = array('ok' => true, 'token' => $token);
        $this->send_json_response($response);
    }
}
