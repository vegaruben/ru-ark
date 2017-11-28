<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
	
	protected $data = array();
	protected $container = NULL;
	
    function __construct()
    {
		parent::__construct();
		        
		$this->container = $this->config->item('ioc');
    }
    public function isPost(){
        return (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST');
    }
    /*user management*/
    public function get_user_id(){
        return $this->session->userdata('userid');
    }
    public function set_user($user){
        $this->session->set_userdata('userid',$user->id);
        $this->session->set_userdata('username',$user->username);
        $this->session->set_userdata('usertype',$user->roles);
        $this->session->set_userdata('displayName',$user->displayName);
        //$this->session->set_userdata('params',$user->parameters);
        if(!empty($user->parameters)){
            $kv = json_decode($user->parameters,TRUE);
            $this->add_param('user',$kv);
        }
    }
    public function unset_user(){
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('usertype');
        $this->session->unset_userdata('params');
        $this->session->sess_destroy();
    }
    function check_role($required_role){
        if ($this->session->userdata('userid')==FALSE ||
            $this->session->userdata('usertype')==FALSE){
            return FALSE;
        }
        $roles = $this->session->userdata('usertype');
        $ret = TRUE;
        if(strpos($roles, $required_role)===FALSE){
            $ret = FALSE;
        }
        //$process = new GssRoleCheckProcess($this->Gateway);
        //$ret = $process->check($required_role,$roles);
        return $ret;
    }
    function required_role($role){
        if(!$this->check_role($role)){
            $this->session->set_flashdata('error','you dont have access');
            $this->unset_user();
            redirect('login','refresh');
            return FALSE;
        }

        return TRUE;
    }
    public function convert_sessions_to_params(){
        if($this->session->userdata('params'))
            $this->data['params'] = json_decode($this->session->userdata('params'),TRUE);
    }
    public function add_param($key,$param){
        $params = array();
        if($this->session->userdata('params')){
            $params = json_decode($this->session->userdata('params'),TRUE);
        }
        if($params == NULL){
            $params = array();
        }
        if(array_key_exists($key,$params)){
            $params[$key] = array_merge($params[$key],$param);
        }else{
            $params[$key] = $param;
        }
        $this->session->set_userdata('params',json_encode($params));
    }
    
}
//register other controllers
require_once dirname(__FILE__).'/RegisteredUserController.php';
require_once dirname(__FILE__).'/AdminUserController.php';