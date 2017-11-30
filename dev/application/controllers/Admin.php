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
use Funnlz\Entities\DataTablesPaging;

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
                    $this->data['featured'] = $ret->data[1];
                    array_shift($ret->data);
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

    public function users(){
        $this->data['v'] = 'admin/users';
        $this->data['meta_title'] = 'Users';
        $this->data['meta_desc'] = 'Users';
        $this->data['slug'] = 'users';
        $this->data['jsfiles'] = array('admin/users.js');

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Users');
        $this->load->view('template_admin',  $this->data);
    }
    public function delete_user(){
        $svc = $this->container['userService'];
        try{
            $ret = $svc->delete($_POST['id']);
            if($ret){
                $this->session->set_flashdata('success', 'User deleted');
            }else{
                $this->session->set_flashdata('error', 'Failed to delete user');
            }
        }catch(ServiceException $e){
            $this->session->set_flashdata('error', $e->getMessage());
        }
        return redirect('/admin/users/','refresh');
    }
    //ajax
    public function search_users(){
        $form = new DataTablesPaging();
        $cols = array('firstName','lastName','email', 'provider','id', 'isActive');
        $form->setValidColumns($cols);

        $form->bind($_POST);
        if(!$form->validate()){
            echo 'error bind paging'.$form->error_messages();
        }else{

            $this->load->helper('datatables');

            $svc = $this->container['userService'];
            $result = $svc->search( $form);
            //echo json_encode($result);
            datatables_json($result,$cols);
        }
    }


    public function products(){
        $this->data['v'] = 'admin/products';
        $this->data['meta_title'] = 'Products';
        $this->data['meta_desc'] = 'Products';
        $this->data['slug'] = 'products';
        $this->data['jsfiles'] = array('admin/products.js');

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Products');
        $this->load->view('template_admin',  $this->data);
    }
    //ajax
    public function search_products(){
        $form = new DataTablesPaging();
        $cols = array('SKU','name','description', 'urlToBuy','salePrice', 'regularPrice','id');
        $form->setValidColumns($cols);

        $form->bind($_POST);
        if(!$form->validate()){
            echo 'error bind paging'.$form->error_messages();
        }else{

            $this->load->helper('datatables');

            $svc = $this->container['productService'];
            $result = $svc->search( $form);
            //echo json_encode($result);
            datatables_json($result,$cols);
        }
    }
    public function delete_product(){
        $svc = $this->container['productService'];
        try{
            $ret = $svc->deleteByID($_POST['id']);
            if($ret){
                $this->session->set_flashdata('success', 'Product deleted');
            }else{
                $this->session->set_flashdata('error', 'Failed to delete product');
            }
        }catch(ServiceException $e){
            $this->session->set_flashdata('error', $e->getMessage());
        }
        return redirect('/admin/products/','refresh');
    }
}