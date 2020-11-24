<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Health extends CI_Controller
{
    public function index()
    {
        header('Content-Type: application/json');
        $data = array('ok' => true, 'message' => 'Estou funcionando normalmente.');
        echo json_encode($data);
    }
}
