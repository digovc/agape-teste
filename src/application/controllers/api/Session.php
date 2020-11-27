<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Session extends CI_Controller
{
    public function check()
    {
        $this->load->model('session_model');
        $this->session_model->check();
    }
    
    public function login()
    {
        $this->load->model('session_model');
        $this->session_model->login();
    }
}
