<?php
defined('BASEPATH') or exit('No direct script access allowed');

abstract class View_Controler_Base extends CI_Controller
{
    public function index()
    {
        $view = $this->get_view_content();

        $this->load->view('header');
        $this->load->view($view);
        $this->load->view('footer');
    }

    protected abstract function get_view_content();
}
