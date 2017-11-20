<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 06/11/17
 * Time: 7:51
 */


defined('BASEPATH') OR exit('No direct script access allowed');

use Funnlz\Entities\User as UserEntity;
use Funnlz\Services\ServiceException;

class Dashboard extends RegisteredUserController{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $svc = $this->container['productService'];
        $this->data['jsfiles'] = ['dashboard.js'];

        $this->data['recent_products'] = $svc->getRecentProducts($this->get_user_id());
        $this->data['v'] = 'dashboard/index';
        $this->data['meta_title'] = 'Dashboard';
        $this->data['meta_desc'] = 'Dashboard';
        $this->data['slug'] = 'dashboard';
        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Dashboard');

        $this->load->view('template_registered', $this->data);
    }

    public function profile(){
        if($this->isPost()){
            $form = new UserEntity();
            $form->bind($_POST);
            if($form->validate()) {
                $svc = $this->container['userService'];
                try{
                    $ret = $svc->updateUser($form);
                    if($ret){
                        $this->session->set_flashdata('success','You have successfully updated your profile');
                        return redirect('/dashboard/profile','refresh');
                    }else{
                        $this->session->set_flashdata('error', 'Failed to update profile');
                    }
                }catch(ServiceException $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
            }else{
                $this->session->set_flashdata('error', $form->error_messages());
            }
            $this->data['user'] = $form;
        }else{
            $svc = $this->container['userService'];
            $user = $svc->findById($this->get_user_id());

            if($user==NULL){
                $this->session->set_flashdata('error','User not found');
                return redirect('/user/logout','refresh');
            }
            $this->data['user'] = $user;
        }
        if($this->check_role('SOCIAL_USER')){
            $this->data['v'] = 'dashboard/social-profile';
        }else{
            $this->data['v'] = 'dashboard/profile';
        }

        $this->data['meta_title'] = 'Profile';
        $this->data['meta_desc'] = 'Profile';
        $this->data['slug'] = 'profile';
        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Profile');

        $this->load->view('template_registered', $this->data);
    }
}