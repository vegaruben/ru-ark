<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 03/11/17
 * Time: 10:13
 */

namespace Funnlz\Entities;


class Email
{
    public $fromName;
    public $fromEmail;
    public $toEmail;
    public $toName;
    public $subject;
    public $htmlMessage;
    public $plainTextMessage;
    public $headers;

    public $cc = []; //format array: [{'email':'saa@aa.com', 'name':'saa'}]
    public $bcc = []; //format array: [{'email':'saa@aa.com', 'name':'saa'}]

}