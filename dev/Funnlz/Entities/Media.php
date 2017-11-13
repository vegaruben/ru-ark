<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 08/11/17
 * Time: 14:01
 */

namespace Funnlz\Entities;


class Media extends BaseEntity{
    public $URI;
    public $mediaID;
    public $name;
    public $localfile;
    public $ownerURI;
    public $owner;
    public $ownerID;
    public $type;
    //internal
    public $buffer;


    public function validate(){
        $this->required(['name', 'type']);

        return !$this->has_error();
    }
}
