<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Funnlz\Entities\User as UserEntity;
use Funnlz\Entities\LoginForm;
use Funnlz\Entities\ForgotForm;
use Funnlz\Entities\ResetPasswordForm;
//use Hybrid_Endpoint;
use Funnlz\Services\ServiceException;

class Welcome extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    private function redirectIfLoggedIn(){
        if($this->check_role('USER')){
            $this->session->set_flashdata('success','Welcome');
            redirect('/dashboard/','refresh');
            exit(0);
        }
    }
    public function index(){
        $this->redirectIfLoggedIn();
        $this->data['v'] = 'user/index';
        $this->data['meta_title'] = 'Funnlz.io';
        $this->data['meta_desc'] = 'Funnlz.io';
        $this->data['slug'] = 'home';

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Funnlz.io');
        $this->load->view('home',  $this->data);
    }
}