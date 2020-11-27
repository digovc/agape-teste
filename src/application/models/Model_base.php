<?php
defined('BASEPATH') or exit('No direct script access allowed');

abstract class Model_base extends CI_Model
{
    protected function error($message)
    {
        show_error($message, 400, 'Error');
        exit(1);
    }

    protected function get_json_request()
    {
        $json = $this->input->raw_input_stream;
        return json_decode($json);
    }

    protected function init_email()
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'lo0pf0b5rwwolf4@gmail.com';
        $config['smtp_pass'] = 'mH1yjreasyp2OmK9ZDXPVPR1DtmE5S0hjMRpGZgNgh9RLuNdMT';
        $config['smtp_port'] = '465';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
    }

    protected function send_json_response($response)
    {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
