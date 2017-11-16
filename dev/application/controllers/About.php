<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(){                
        $this->data['meta_title'] = 'Funnlz.io';
        $this->data['meta_desc'] = 'Funnlz.io';
        $this->data['slug'] = 'about';
        $this->data['jsfiles'] = array('home.js');

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Funnlz.io');
        $this->load->view('about',  $this->data);
    }
}
