<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function change_password()
    {
        $this->load->model('recovery_model');
        $this->recovery_model->change_password();
    }

    public function recovery()
    {
        $this->load->model('recovery_model');
        $this->recovery_model->recovery();
    }
}
