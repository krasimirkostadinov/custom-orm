<?php

namespace models;

use models\entities\Entity;

class CompanyDiscount extends Entity
{
    private $id;
    private $company_id;
    private $product_id;
    private $discount_amount;
    private $entity_state;
    private $errors = [];


    private $entity_table = 'company_products_discount';
    private $entity_class = 'CompanyDiscount';
    private $db_fields = ['id', 'company_id', 'product_id', 'discount_amount'];
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

    private function validateCompanyId(){
        if(!helpers\Helper::isInt($this->company_id)){
            $this->errors['company_id'] = 'Company id value must be int.';
        }
    }

    private function validateProductId(){
        if(!helpers\Helper::isInt($this->product_id)){
            $this->errors['product_id'] = 'Product id value must be int.';
        }
    }

    private function validateDiscountAmount(){
        if(!helpers\Helper::isInt($this->discount_amount)){
            $this->errors['discount_amount'] = 'Discount amount value must be int.';
        }elseif(!helpers\Helper::validatePercentAmount($this->discount_amount)){
            $this->errors['discount_amount'] = 'Discount amount value must be int between 1-100.';
        }
    }


    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateCompanyId();
        $this->validateProductId();
        $this->validateDiscountAmount();
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @param mixed $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getDiscountAmount()
    {
        return $this->discount_amount;
    }

    /**
     * @param mixed $discount_amount
     */
    public function setDiscountAmount($discount_amount)
    {
        $this->discount_amount = $discount_amount;
    }


}