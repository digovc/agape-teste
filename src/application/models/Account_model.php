<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_model extends Model_base
{
    public $name;
    public $email;
    public $login;
    public $password;
    public $isEnabled;
    public $isAdmin;
}
