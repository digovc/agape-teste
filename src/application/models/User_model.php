<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once("Model_base.php");

class User_model extends Model_base
{
    public $name;
    public $email;
    public $login;
    public $password;
    public $isEnabled;
    public $isAdmin;

    public function retrieve_user()
    {
        $request = $this->get_json_request();

        if (is_null($request->token)) {
            $this->error('Token inválido.');
        }

        if ($request->accountId < 1) {
            $this->error('Usuário inválido.');
        }

        $this->load->database();
        $this->db->where('token', $request->token);
        $query = $this->db->get('session');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Token inválido.');
        }

        $sessionRow = $rows[0];

        if ($sessionRow->isAdmin || $sessionRow->accountId == $request->accountId) {
            $this->db->where('id', $request->accountId);
            $query = $this->db->get('account');
            $rows = $query->result();

            if (is_null($rows) || count($rows) < 1) {
                $this->error('Usuário inválido.');
            }

            $accountRow = $rows[0];
            $response = array('ok' => true, 'account' => $accountRow);
            $this->send_json_response($response);
        }
    }

    public function retrieve_users()
    {
        $request = $this->get_json_request();

        if (is_null($request->token)) {
            $this->error('Token inválido.');
        }

        if (is_null($request->index)) {
            $request->index = 0;
        }

        $this->load->database();
        $this->db->where('token', $request->token);
        $query = $this->db->get('session');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Token inválido.');
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
        $query = $this->db->get('account', $limit, $offset);
        $rows = $query->result();
        $response = array('ok' => true, 'users' => $rows);
        $this->send_json_response($response);
    }

    private function retrieve_only_self_user($sessionRow)
    {
        $this->db->where('id', $sessionRow->accountId);
        $query = $this->db->get('account');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Usuário inválido.');
        }

        $accountRow = $rows[0];
        $response = array('ok' => true, 'users' => [$accountRow]);
        $this->send_json_response($response);
    }

    public function save()
    {
        $request = $this->get_json_request();

        $this->load->database();
        $this->db->where('token', $request->token);
        $query = $this->db->get('session');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Token inválido.');
        }

        if (is_null($request->token)) {
            $this->error('Token inválido.');
        }

        if (is_null($request->user)) {
            $this->error('Solicitação inválida.');
        }

        if (is_null($request->user->name)) {
            $this->error('Nome inválido.');
        }

        if (is_null($request->user->login)) {
            $this->error('Login inválido.');
        }

        if (is_null($request->user->email)) {
            $this->error('Email inválido.');
        }

        if (is_null($request->user->password)) {
            $this->error('Senha inválida.');
        }

        $sessionRow = $rows[0];

        if (!$sessionRow->isAdmin && $request->user->id != $sessionRow->accountId) {
            $this->error('Usuários não administradores podem alterar apenas sua própria conta.');
        }

        if (!$sessionRow->isAdmin && $request->user->isAdmin) {
            $this->error('Usuários não administradores não podem criar/alterar usuários administradores.');
        }

        if ($request->user->id > 0) {
            $this->db->replace('account', $request->user);
        } else {
            $this->db->insert('account', $request->user);
        }

        $response = array('ok' => true, 'message' => 'User salved.');
        $this->send_json_response($response);
    }
}
