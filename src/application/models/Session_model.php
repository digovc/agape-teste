<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once("Model_base.php");

class Session_model extends Model_base
{
    public $accountId;
    public $token;
    public $isAdmin;

    public function check()
    {
        $request = $this->get_json_request();

        if (is_null($request->token)) {
            $this->error('Token inválido.');
        }

        $this->load->database();
        $this->db->where('token', $request->token);
        $query = $this->db->get('session');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Token inválido.');
        }

        $sessionRow = $rows[0];

        $response = array('ok' => true, 'isAdmin' => $sessionRow->isAdmin, 'accountId' => $sessionRow->accountId);
        $this->send_json_response($response);
    }

    public function login()
    {
        $request = $this->get_json_request();

        if (is_null($request->login)) {
            $this->error('Login inválido.');
        }

        if (is_null($request->password)) {
            $this->error('Senha inválida.');
        }

        $this->load->database();

        $this->db->where('login', $request->login);
        $this->db->where('password', $request->password);
        $query = $this->db->get('account');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Usuário não encontrado.');
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
