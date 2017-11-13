<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 03/11/17
 * Time: 9:15
 */

namespace Funnlz\Entities;

class ForgotForm extends BaseEntity{
    public $username;

    public function validate(){
        $requiredFields = ['username'];
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