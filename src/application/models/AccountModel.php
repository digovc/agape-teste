<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountModel extends CI_Model
{
    public $name;
    public $email;
    public $login;
    public $password;
    public $isEnabled;
    public $isAdmin;
}
