<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 24/11/17
 * Time: 5:19
 */

namespace Funnlz\Entities;


class UpdatePasswordForm extends BaseEntity
{
    public $userId;
    public $password;
    public $newPassword;
    public $newPassword2;

    public function validate(){
        $requiredFields = ['userId','password','newPassword', 'newPassword2'];
        $this->requiredNotEmpty($requiredFields);
        if(isset($this->newPassword) && isset($this->newPassword2)
            && !empty($this->newPassword) && !empty($this->newPassword2)){
            if($this->newPassword!=$this->newPassword2){
                $this->add_error('newPassword2','Password missmatch');
            }
        }
        return !$this->has_error();
    }
}