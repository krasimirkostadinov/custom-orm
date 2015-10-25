<?php
/**
 * Created by PhpStorm.
 * User: krasimir
 * Date: 15-8-30
 * Time: 0:01
 */

namespace models;


use models\entities\Entity;

class Order extends Entity
{
    private $id;
    private $company_id;
    private $shipping_address;
    private $shipping_country_id;
    private $shipping_city_id;
    private $note;
    private $ip;
    private $created_at;
    private $entity_state;
    private $errors = [];

    private $entity_table = 'orders';
    private $entity_class = 'Order';
    private $db_fields = ['id', 'company_id', 'shipping_address', 'shipping_country_id', 'shipping_city_id', 'note', 'ip', 'created_at'];
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



    private function validateShippingCountry(){
        if(!helpers\Helper::isInt($this->shipping_country_id)){
            $this->errors['shipping_country_id'] = 'Country ID value must be int.';
        }
    }

    private function validateShippingCity(){
        if(!helpers\Helper::isInt($this->shipping_city_id)){
            $this->errors['shipping_city_id'] = 'Shipping city ID value must be int.';
        }
    }

    private function validateCompanyId(){
        if(!helpers\Helper::isInt($this->company_id)){
            $this->errors['company_id'] = 'Company id value must be int.';
        }
    }

    private function validateShippingAddress(){
        if(helpers\Helper::isEmpty($this->shipping_address)){
            $this->errors['shipping_address'] = 'Shipping address can not be empty.';
        }elseif(!helpers\Helper::isString($this->shipping_address)){
            $this->errors['shipping_address'] = 'Shipping address must be a string value.';
        }
    }

    private function validateShippingNote(){
        if(helpers\Helper::isEmpty($this->note)){
            $this->errors['note'] = 'Shipping note address can not be empty.';
        }elseif(!helpers\Helper::isString($this->note)){
            $this->errors['note'] = 'Shipping note must be a string value.';
        }
    }

    private function validateOrderIp(){
        if(helpers\Helper::isEmpty($this->ip)){
            $this->errors['ip'] = 'IP address can not be empty';
        }
        if(!helpers\Helper::isValidIpAddress(long2ip($this->ip))){
            $this->errors['ip'] = 'IP address is not valid';
        }
    }

    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateCompanyId();
        $this->validateShippingCity();
        $this->validateShippingCountry();
        $this->validateShippingAddress();
        $this->validateShippingNote();
        $this->validateOrderIp();

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
     * @return Order
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Order
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    /**
     * @param mixed $shipping_address
     * @return Order
     */
    public function setShippingAddress($shipping_address)
    {
        $this->shipping_address = $shipping_address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingCountryId()
    {
        return $this->shipping_country_id;
    }

    /**
     * @param mixed $shipping_country_id
     * @return Order
     */
    public function setShippingCountryId($shipping_country_id)
    {
        $this->shipping_country_id = $shipping_country_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingCityId()
    {
        return $this->shipping_city_id;
    }

    /**
     * @param mixed $shipping_city_id
     * @return Order
     */
    public function setShippingCityId($shipping_city_id)
    {
        $this->shipping_city_id = $shipping_city_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     * @return Order
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return long2ip($this->ip);
    }

    /**
     * @param mixed $ip
     * @return Order
     */
    public function setIp($ip)
    {
        if(helpers\Helper::isValidIpAddress($ip)){
            $this->ip = ip2long($ip);
        }else{
            $this->ip = false;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return Order
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }




}