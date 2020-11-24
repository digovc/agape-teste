<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Splash extends CI_Controller
{
    public function index()
    {
        $this->load->view('header');
        $this->load->view('splash');
        $this->load->view('footer');
    }
}
