<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 06/11/17
 * Time: 15:28
 */

namespace Funnlz\Entities;


class Product extends BaseEntity
{
    public $id = NULL;
    public $SKU;
    public $name;
    public $picture = '';
    public $description;
    public $urlToBuy;
    public $ownerId;

    public $modifiedDate;
    public $createdDate;



    public function validate(){
        $required = ['SKU', 'name', 'description', 'urlToBuy', 'ownerId'];
        $this->requiredNotEmpty($required);
        if(isset($this->urlToBuy)){
            if (filter_var($this->urlToBuy, FILTER_VALIDATE_URL) !== false){

            }else{
                $this->add_error('urlToBuy', 'Invalid URL');
            }
        }

        return !$this->has_error();
    }
}