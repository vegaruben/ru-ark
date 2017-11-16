<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 03/11/17
 * Time: 13:13
 */

namespace Funnlz\Entities;

//NOT USED
class SocialUser extends User
{
    public $socialId;
    public $firstName;
    public $lastName;
    public $email;
    public $profileURL;
    public $roles = '{SOCIAL_USER}';
    public $modifiedDate;
    public $createdDate;
    public $provider;//gmail, twitter. facebook

    public $username;
    public $displayName;
}