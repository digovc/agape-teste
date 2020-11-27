<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once("Model_base.php");

class Recovery_model extends Model_base
{
    public $accountId;
    public $token;

    public function change_password()
    {
        $request = $this->get_json_request();

        if (is_null($request->token)) {
            $this->error('Invalid token.');
        }

        if (is_null($request->password)) {
            $this->error('Invalid password.');
        }

        $this->load->database();
        $this->db->where('token', $request->token);
        $query = $this->db->get('recovery');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Invalid token.');
        }

        $recoveryRow = $rows[0];
        $this->db->delete('recovery', array('accountId' => $recoveryRow->accountId));

        $this->db->set('password', $request->password);
        $this->db->where('id', $recoveryRow->accountId);
        $this->db->update('account');

        $response = array('ok' => true, 'message' => 'Password changed.');
        $this->send_json_response($response);
    }

    public function recovery()
    {
        $request = $this->get_json_request();

        if (is_null($request->email)) {
            $this->error('Invalid email.');
        }

        $this->load->database();

        $this->db->where('email', strtolower($request->email));
        $query = $this->db->get('account');
        $rows = $query->result();

        if (is_null($rows) || count($rows) < 1) {
            $this->error('Account not found.');
        }

        $accountRow = $rows[0];
        $this->db->delete('recovery', array('accountId' => $accountRow->id));

        $token = bin2hex(random_bytes(32));

        $recovery = new Recovery_model();
        $recovery->accountId = $accountRow->id;
        $recovery->token = $token;

        $this->db->insert('recovery', $recovery);

        $this->init_email();

        $this->email->from('lo0pf0b5rwwolf4@gmail.com', 'Teste Ágape');
        $this->email->to($accountRow->email);

        $line1 = '<div>Seu login é <b>' . $accountRow->login . '</b>.</div>';
        $line2 = '<div>Para recuperar a sua senha <a href="http://agapa_teste.ddns.net/index.php/recovery?token=' . $token . '">clique aqui</a>.</div>';

        $this->email->subject('Recuperação de senha.');
        $this->email->message($line1 . $line2);

        $this->email->send();

        $response = array('ok' => true, 'message' => 'Instructions sended to email.');
        $this->send_json_response($response);
    }
}
