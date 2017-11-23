<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 06/11/17
 * Time: 15:28
 */

namespace Funnlz\Entities;
use Money\Money;

class Product extends BaseEntity
{
    public $id = NULL;
    public $SKU;
    public $name;
    public $picture = '';
    public $description;
    public $urlToBuy;
    public $ownerId;

    public $productType;
    public $vendor;

    public $salePrice;
    public $salePriceCurrency;

    public $regularPrice;
    public $regularPriceCurrency;

    public $requiresShipping;
    public $weightLbs;
    public $HSTariffCode;
    public $YouTubeLink;

    public $modifiedDate;
    public $createdDate;



    public function validate(){
        $required = ['SKU', 'name', 'description', 'urlToBuy', 'ownerId', 'salePrice', 'salePriceCurrency',
            'regularPrice', 'regularPriceCurrency'];

        $this->requiredNotEmpty($required);
        if(isset($this->urlToBuy)){
            if (filter_var($this->urlToBuy, FILTER_VALIDATE_URL) !== false){

            }else{
                $this->add_error('urlToBuy', 'Invalid URL');
            }
        }

        return !$this->has_error();
    }
    public function getSalePrice(){
        return new Money($this->salePrice, new Currency($this->salePriceCurrency));
    }
    public function getregularPrice(){
        return new Money($this->regularPrice, new Currency($this->regularPriceCurrency));
    }
}