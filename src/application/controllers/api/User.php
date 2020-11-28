<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function retrieve_user()
    {
        $this->load->model('user_model');
        $this->user_model->retrieve_user();
    }

    public function retrieve_users()
    {
        $this->load->model('user_model');
        $this->user_model->retrieve_users();
    }

    public function save()
    {
        $this->load->model('user_model');
        $this->user_model->save();
    }
}
