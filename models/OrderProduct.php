<?php

namespace models;


use models\entities\Entity;

/**
 * Class OrderProduct contain all ordered products, related to single Order.
 * Fields like: product_discount, company_discount and price are not in relation model, because of history or purchase.
 * For history reasons one product can change it's price.
 * @package models
 */
class OrderProduct extends Entity
{

    private $id;
    private $order_id;
    private $product_id;
    private $qty;
    private $product_discount;
    private $company_discount;
    private $currency_id;
    private $price;
    private $errors = [];

    private $entity_state;
    private $entity_table = 'orders_products';
    private $entity_class = 'OrderProduct';
    private $db_fields = ['id', 'order_id', 'product_id', 'qty', 'product_discount', 'company_discount', 'currency_id', 'price'];
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


    private function validateOrderId(){
        if(!helpers\Helper::isInt($this->order_id)){
            $this->errors['order_id'] = 'Order ID value must be int.';
        }
    }

    private function validateProductId(){
        if(!helpers\Helper::isInt($this->product_id)){
            $this->errors['product_id'] = 'Product ID value must be int.';
        }
    }

    private function validateQuantity(){
        if(!helpers\Helper::isInt($this->qty)){
            $this->errors['qty'] = 'Quantity value must be int.';
        }
    }

    private function validateProductDiscount(){
        if(!helpers\Helper::isInt($this->product_discount)){
            $this->errors['product_discount'] = 'Product discount amount value must be int.';
        }elseif(!helpers\Helper::validatePercentAmount($this->product_discount)){
            $this->errors['product_discount'] = 'Product discount amount value must be int between 0-100.';
        }
    }

    private function validateCompanyDiscount(){
        if(!helpers\Helper::isInt($this->company_discount)){
            $this->errors['company_discount'] = 'Product discount amount value must be int.';
        }elseif(!helpers\Helper::validatePercentAmount($this->company_discount)){
            $this->errors['company_discount'] = 'Product discount amount value must be int between 0-100.';
        }
    }


    private function validateCurrencyId(){
        if(!helpers\Helper::isInt($this->currency_id)){
            $this->errors['currency_id'] = 'Currency ID value must be int.';
        }
    }


    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateCompanyDiscount();
        $this->validateCurrencyId();
        $this->validateOrderId();
        $this->validateProductId();
        $this->validateQuantity();
        $this->validateProductDiscount();

        return count($this->errors) === 0;
    }

    /**
     * Dynamically calculate total price for every product purchase with discounts and cty
     * @return decimal
     */
    public function calculateTotalPrice(){
        $total_discount_percent = ($this->product_discount + $this->company_discount);
        $total_discount_amount = (($this->qty * $this->price) * $total_discount_percent) / 100;
        $total_price = ($this->qty * $this->price - $total_discount_amount);
        return $total_price;
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
     * @return OrderProduct
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     * @return OrderProduct
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
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
     * @return OrderProduct
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     * @return OrderProduct
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
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
     * @return OrderProduct
     */
    public function setProductDiscount($product_discount)
    {
        $this->product_discount = $product_discount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyDiscount()
    {
        return $this->company_discount;
    }

    /**
     * @param mixed $company_discount
     * @return OrderProduct
     */
    public function setCompanyDiscount($company_discount)
    {
        $this->company_discount = $company_discount;
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
     * @return OrderProduct
     */
    public function setCurrencyId($currency_id)
    {
        $this->currency_id = $currency_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return OrderProduct
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }


}