<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AdminUserController extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->check_role('ADMIN_USER')){
            return redirect('/user/logout','refresh');
        }
    }

}
