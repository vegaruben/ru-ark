<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RegisteredUserController extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->check_role('USER')){
            return redirect('/user/','refresh');
        }
    }

}
