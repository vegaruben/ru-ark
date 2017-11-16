<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 16/11/17
 * Time: 15:12
 */

namespace Funnlz\Entities;


class UserActivationForm  extends BaseEntity{
    public $userId;
    public $activationCode;

    public function validate(){
        $requiredFields = ['userId','activationCode'];
        $this->requiredNotEmpty($requiredFields);

        return !$this->has_error();
    }
}