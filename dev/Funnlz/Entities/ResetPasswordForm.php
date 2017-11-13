<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 03/11/17
 * Time: 11:01
 */

namespace Funnlz\Entities;


class ResetPasswordForm extends BaseEntity{
    public $userId;
    public $forgotPasswordCode;

    public $newPassword;

    public function validate(){
        $requiredFields = ['userId','forgotPasswordCode', 'newPassword'];
        $this->requiredNotEmpty($requiredFields);

        return !$this->has_error();
    }
}