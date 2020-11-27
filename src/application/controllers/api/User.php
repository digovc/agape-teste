<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function retrieve_users()
    {
        $this->load->model('account_model');
        $this->account_model->retrieve_users();
    }
    
    public function save()
    {
        $this->load->model('account_model');
        $this->account_model->save();
    }
}
