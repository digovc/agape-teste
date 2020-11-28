<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('View_Controler_Base.php');

class Recovery1 extends View_Controler_Base
{
    protected function get_view_content()
    {
        return 'recovery_step_1';
    }
}
