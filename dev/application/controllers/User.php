<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Funnlz\Entities\User as UserEntity;
use Funnlz\Entities\LoginForm;
use Funnlz\Entities\ForgotForm;
use Funnlz\Entities\ResetPasswordForm;
use Funnlz\Entities\UserActivationForm;
//use Hybrid_Endpoint;
use Funnlz\Services\ServiceException;

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	private function redirectIfLoggedIn(){
        if($this->check_role('USER')){
            $this->session->set_flashdata('success','Welcome');
            redirect('/dashboard/','refresh');
            exit(0);
        }
    }
    //signin
	public function index(){
        $form = new LoginForm();
        if($this->isPost()){
            $form->bind($_POST);
            if($form->validate()) {
                $svc = $this->container['userService'];
                try{
                    $user = $svc->login($form->username, $form->password);
                    if($user){
                        $this->set_user($user);

                        $this->session->set_flashdata('success','You have successfully signed in');
                        return redirect('/dashboard','refresh');
                    }else{
                        $this->session->set_flashdata('error', 'Failed to login');
                    }
                }catch(ServiceException $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
            }else{
                $this->session->set_flashdata('error', $form->error_messages());
            }
            $this->data['user'] = $form;
        }else{
            $this->redirectIfLoggedIn();
            $this->data['user'] = $form;
        }

        $this->data['v'] = 'user/signin';
        $this->data['meta_title'] = 'Signin';
        $this->data['meta_desc'] = 'Signin';
        $this->data['slug'] = 'signin';

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Signin');
        $this->load->view('template_guest',  $this->data);
	}

	public function signup(){
        $form = new UserEntity();
        if($this->isPost()){
            $form->bind($_POST);
            if($form->validate()) {
                $svc = $this->container['userService'];
                try{
                    $ret = $svc->registerUser($form);
                    if($ret){
                        $this->session->set_flashdata('success','You have successfully registered');
                        return redirect('/user','refresh');
                    }else{
                        $this->session->set_flashdata('error', 'Failed to save user');
                    }
                }catch(ServiceException $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
            }else{
                $this->session->set_flashdata('error', $form->error_messages());
            }
            $this->data['user'] = $form;
        }else{
            $this->redirectIfLoggedIn();
            $this->data['user'] = $form;
        }

        $this->data['v'] = 'user/signup';
        $this->data['meta_title'] = 'Signup';
        $this->data['meta_desc'] = 'Signup';
        $this->data['slug'] = 'signup';

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Signup');
        $this->load->view('template_guest',  $this->data);
	}

    public function logout(){
        $this->unset_user();
        $this->session->set_flashdata('success',"You've been logged out!");
        redirect('/user/','refresh');
    }

    public function forgot(){
        $form = new ForgotForm();
        if($this->isPost()){
            $form->bind($_POST);
            if($form->validate()) {
                $svc = $this->container['userService'];
                try{
                    $ret = $svc->tryToResetPassword($form->username);
                    if($ret){
                        $this->session->set_flashdata('success','Please check your email to reset the password');
                        return redirect('/user/forgot','refresh');
                    }else{
                        $this->session->set_flashdata('error', 'Failed to reset password');
                    }
                }catch(ServiceException $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
            }else{
                $this->session->set_flashdata('error', $form->error_messages());
            }
            $this->data['user'] = $form;
        }else{
            $this->redirectIfLoggedIn();
            $this->data['user'] = $form;
        }

        $this->data['v'] = 'user/forgot';
        $this->data['meta_title'] = 'Forgot Password';
        $this->data['meta_desc'] = 'Forgot Password';
        $this->data['slug'] = 'forgot-password';

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Forgot Password');
        $this->load->view('template_guest',  $this->data);
    }

    public function reset($userId, $forgotCode){
        $form = new ResetPasswordForm();

        if($this->isPost()){
            $form->bind($_POST);
            if($form->validate()) {
                $svc = $this->container['userService'];
                try{
                    $ret = $svc->resetPassword($form);
                    if($ret){
                        $this->session->set_flashdata('success','Password updated. Please login');
                        return redirect('/user','refresh');
                    }else{
                        $this->session->set_flashdata('error', 'Failed to update the passsword');
                    }
                }catch(ServiceException $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
            }else{
                $this->session->set_flashdata('error', $form->error_messages());
            }
            $this->data['user'] = $form;
        }else{
            $this->redirectIfLoggedIn();

            if(empty($userId) || empty($forgotCode)){
                $this->session->set_flashdata('error','Invalid user id / forgot password code');
                return redirect('/user/forgot','refresh');
            }

            $form->userId = $userId;
            $form->forgotPasswordCode = $forgotCode;

            $svc = $this->container['userService'];

            $user = $svc->findByIdAndForgotPasswordCode($form->userId, $form->forgotPasswordCode);

            if($user==NULL){
                $this->session->set_flashdata('error','Invalid user id / forgot password code');
                return redirect('/user/forgot','refresh');
            }

            $this->data['user'] = $form;
        }

        $this->data['v'] = 'user/reset';
        $this->data['meta_title'] = 'Reset Password';
        $this->data['meta_desc'] = 'Reset Password';
        $this->data['slug'] = 'reset-password';

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Reset Password');
        $this->load->view('template_guest',  $this->data);
    }
    public function activate($userId, $activationCode){
        $form = new UserActivationForm();

        $msg = '';
        $success = FALSE;
        if(empty($userId) || empty($activationCode)){
            $msg = 'Invalid user id / user activation code';
        }else{
            $form->userId = $userId;
            $form->activationCode = $activationCode;

            $svc = $this->container['userService'];

            $user = $svc->findByIdAndActivationCode($form->userId, $form->activationCode);

            if($user==NULL){
                $msg = 'Invalid user id / activation code';
            }else{
                //activate
                if(!$svc->activateUser($user)){
                    $msg =  'Failed to activate user';
                }else{
                    $msg = 'User activated. Please login';
                    $success = TRUE;
                }
            }

        }

        $this->session->set_flashdata($success ? 'success':'error', $msg);
        return redirect('/','refresh');
    }

    /*social logins*/
    public function social_signup_callback(){
        if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done']))
        {
            Hybrid_Endpoint::process();
        }
    }
    private function hybridauth_login($provider){
        try{
            // create an instance for Hybridauth with the configuration file path as parameter
            $hybridauth = $this->container['hybridAuth'];

            // try to authenticate the user with twitter,
            // user will be redirected to Twitter for authentication,
            // if he already did, then Hybridauth will ignore this step and return an instance of the adapter
            $user = $hybridauth->authenticate( $provider );

            // get the user profile
            $user_profile = $user->getUserProfile();
            $svc = $this->container['userService'];
            //https://hybridauth.github.io/hybridauth/userguide/Profile_Data_User_Profile.html
            $userx = $svc->socialLogin($provider, $user_profile);
            if($userx!=NULL){
                $this->set_user($userx);

                $this->session->set_flashdata('success','You have successfully signed in');
                return redirect('/dashboard/profile','refresh');
            }
            /*

            echo "Ohai there! U are connected with: <b>{$user->id}</b><br />";
            echo "As: <b>{$user_profile->displayName}</b><br />";
            echo "And your provider user identifier is: <b>{$user_profile->identifier}</b><br />";

            // debug the user profile
            print_r( $user_profile );

            echo "Logging out..";
            $user->logout();*/
        }
        catch( Exception $e ){
            // Display the recived error,
            // to know more please refer to Exceptions handling section on the userguide
            switch( $e->getCode() ){
                case 0 : echo "Unspecified error."; break;
                case 1 : echo "Hybriauth configuration error."; break;
                case 2 : echo "Provider not properly configured."; break;
                case 3 : echo "Unknown or disabled provider."; break;
                case 4 : echo "Missing provider application credentials."; break;
                case 5 : echo "Authentification failed. "
                    . "The user has canceled the authentication or the provider refused the connection.";
                    break;
                case 6 : echo "User profile request failed. Most likely the user is not connected "
                    . "to the provider and he should authenticate again.";
                    $user->logout();
                    break;
                case 7 : echo "User not connected to the provider.";
                    $user->logout();
                    break;
                case 8 : echo "Provider does not support this feature."; break;
            }

            // well, basically your should not display this to the end user, just give him a hint and move on..
            echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();
        }
    }
    public function gmail_login(){
        $this->hybridauth_login('Google');
    }
    public function twitter_login(){
        $this->hybridauth_login('Twitter');
    }
    public function facebook_login(){
        $this->hybridauth_login('Facebook');
    }
    //ajax--------------
	public function ajax_login(){
		$form = new LoginForm();
        if($this->isPost()){
            $form->bind($_POST);
            if($form->validate()) {
                $svc = $this->container['userService'];
                try{
                    $user = $svc->login($form->username, $form->password);
                    if($user){
                        $this->set_user($user);

                        $ret = array('success'=>1,'message'=>'You have successfully signed in');
                        
                    }else{
                        $ret = array('success'=>0,'message'=>'Failed to login');
                    }
                }catch(ServiceException $e){
                    $ret = array('success'=>0,'message'=> $e->getMessage());
                }
            }else{
                $ret = array('success'=>0,'message'=> $form->error_messages());
            }            
        }else{
			$ret = array('success'=>0,'message'=> 'POST only');
		}
        echo json_encode($ret);
	}
	
	public function ajax_signup(){
		$form = new UserEntity();
        if($this->isPost()){
            $form->bind($_POST);
            if($form->validate()) {
                $svc = $this->container['userService'];
                try{
                    $ret = $svc->registerUser($form);
                    if($ret){
                        $ret = array('success'=>1,'message'=>'You have successfully registered. Please check your email to activate your account');
                    }else{
                        $ret = array('success'=>0,'message'=>'Failed to save user');
                    }
                }catch(ServiceException $e){
                    $ret = array('success'=>0,'message'=>$e->getMessage());
                }
            }else{
                $ret = array('success'=>0,'message'=> $form->error_messages());
            }            
        }else{
			$ret = array('success'=>0,'message'=> 'POST only');
		}
        echo json_encode($ret);
	}
}
