<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 02/11/17
 * Time: 8:59
 */
namespace Funnlz\Entities;

class User extends BaseEntity{
    public $id = NULL;
    public $firstName;//
    public $lastName;//
    public $email;
    public $password;
    public $roles = '{USER}';
    public $createdDate;
    public $lastAccess;

    public $activationCode;
    public $forgottenPasswordCode;
    public $forgottenPasswordTime;
    public $rememberCode;
    public $isActive;

    public $displayName;

    //internal
    public $username;

    public function validate(){
        $requiredFields = ['firstName', 'lastName', 'email'];
        $this->requiredNotEmpty($requiredFields);
        $this->required(['password']);

        if(isset($this->email)){
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                // invalid emailaddress
                $this->add_error('email', 'Invalid Email');
            }
        }
        return !$this->has_error();
    }
}
