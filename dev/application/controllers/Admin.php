<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 27/11/17
 * Time: 15:31
 */


defined('BASEPATH') OR exit('No direct script access allowed');

use Funnlz\Entities\User as UserEntity;
use Funnlz\Services\ServiceException;
use Funnlz\Entities\Paging;
use Funnlz\Entities\PagingResult;

class Admin extends AdminUserController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //$this->data['jsfiles'] = ['dashboard.js'];

        $this->data['v'] = 'admin/index';
        $this->data['meta_title'] = 'Admin Dashboard';
        $this->data['meta_desc'] = 'Admin Dashboard';
        $this->data['slug'] = 'admin-dashboard';
        $this->data['menu'] = array('url' => $this->data['slug'], 'display' => 'Admin Dashboard');

        $this->load->view('template_admin', $this->data);
    }
    public function showcase(){
        //$this->data['jsfiles'] = ['dashboard.js'];
        $this->data['cssfiles'] = ['echad.css'];

        $featured = [];
        $svc = $this->container['productService'];
        try{
            $paging = new Paging();
            $paging->setPageSizeToMax();
            $ret = $svc->searchRecentProducts($paging);
            if($ret){
                if($ret->totalrecords>0){
                    $this->data['featured'] = $ret->data[0];
                    $this->data['products'] = $ret->data;
                }else{
                    $this->data['featured'] = NULL;
                    $this->data['products'] = NULL;
                }


            }else{
                $this->session->set_flashdata('error', 'Failed to reset password');
            }
        }catch(ServiceException $e){
            $this->session->set_flashdata('error', $e->getMessage());
        }


        $this->data['v'] = 'admin/showcase';
        $this->data['meta_title'] = 'Showcase';
        $this->data['meta_desc'] = 'Showcase';
        $this->data['slug'] = 'admin-showcase';
        $this->data['menu'] = array('url' => $this->data['slug'], 'display' => 'Admin Dashboard');

        $this->load->view('template_admin', $this->data);
    }
}