<?php
/**
 * Created by PhpStorm.
 * User: krasimir
 * Date: 15-8-29
 * Time: 23:53
 */

namespace models;


use models\entities\Entity;

class Product extends Entity
{
    private $id;
    private $product_name;
    private $product_discount;
    private $product_description;
    private $currency_id;
    private $product_price;
    private $entity_state;
    private $errors = [];

    private $entity_table = 'products';
    private $entity_class = 'Product';
    private $db_fields = ['id', 'product_name', 'product_discount', 'product_description', 'currency_id', 'product_price'];
    private $primary_keys = ['id'];

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }


    private function validateProductName(){
        if(helpers\Helper::isEmpty($this->product_name)){
            $this->errors['product_name'] = 'Product name can not be empty.';
        }elseif(!helpers\Helper::isString($this->product_name)){
            $this->errors['product_name'] = 'Product must be a string value.';
        }
    }

    private function validateProductDecription(){
        if(helpers\Helper::isEmpty($this->product_description)){
            $this->errors['product_description'] = 'Decription name can not be empty.';
        }elseif(!helpers\Helper::isString($this->product_description)){
            $this->errors['product_description'] = 'Decription must be a string value.';
        }
    }

    private function validateProductDiscount(){
        if(!helpers\Helper::isInt($this->product_discount)){
            $this->errors['product_discount'] = 'Product discount amount value must be int.';
        }elseif(!helpers\Helper::validatePercentAmount($this->product_discount)){
            $this->errors['product_discount'] = 'Product discount amount value must be int between 0-100.';
        }
    }

    private function validateCurrencyId(){
        if(!helpers\Helper::isInt($this->currency_id)){
            $this->errors['currency_id'] = 'Currency ID value must be int.';
        }
    }

    private function validatePrice(){
        if(!helpers\Helper::isValidFloat($this->product_price)){
            $this->errors['product_price'] = 'Product price must me float.';
        }
    }


    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateProductDiscount();
        $this->validateCurrencyId();
        $this->validateProductDecription();
        $this->validateProductName();
        $this->validatePrice();

        return count($this->errors) === 0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param mixed $product_name
     * @return Product
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductDiscount()
    {
        return $this->product_discount;
    }

    /**
     * @param mixed $product_discount
     * @return Product
     */
    public function setProductDiscount($product_discount)
    {
        $this->product_discount = $product_discount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->product_description;
    }

    /**
     * @param mixed $product_description
     * @return Product
     */
    public function setProductDescription($product_description)
    {
        $this->product_description = $product_description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * @param mixed $currency_id
     * @return Product
     */
    public function setCurrencyId($currency_id)
    {
        $this->currency_id = $currency_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    /**
     * @param mixed $product_price
     * @return Product
     */
    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
        return $this;
    }

}