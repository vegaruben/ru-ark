<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 02/11/17
 * Time: 19:01
 */

namespace Funnlz\Entities;

class LoginForm extends BaseEntity{
    public $username;
    public $password;

    public function validate(){
        $requiredFields = ['username', 'password'];
        $this->required($requiredFields);
        if(isset($this->username)){
            if (!filter_var($this->username, FILTER_VALIDATE_EMAIL)) {
                // invalid emailaddress
                $this->add_error('username', 'Invalid Email');
            }
        }
        return !$this->has_error();
    }
}