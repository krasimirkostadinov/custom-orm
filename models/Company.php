<?php
/**
 * Created by PhpStorm.
 * User: krasimir
 * Date: 15-8-29
 * Time: 21:03
 */

namespace models;

use models\entities\Entity;

class Company extends Entity
{
    private $id;
    private $company_name = '';
    private $email = '';
    private $country_id = '';
    private $city_id = '';
    private $address = '';
    private $phone = '';
    private $entity_state;
    private $errors = [];

    private $entity_table = 'companies';
    private $entity_class = 'Company';
    private $db_fields = ['id', 'company_name', 'email', 'country', 'city', 'address', 'phone'];
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



    private function validateCompanyName(){
        if(helpers\Helper::isEmpty($this->company_name)){
            $this->errors['company_name'] = 'Company name can not be empty.';
        }elseif(!helpers\Helper::isString($this->company_name)){
            $this->errors['company_name'] = 'Company name must be a string value.';
        }
    }

    private function validateAddress(){
        if(helpers\Helper::isEmpty($this->address)){
            $this->errors['address'] = 'Address can not be empty.';
        }elseif(!helpers\Helper::isString($this->address)){
            $this->errors['address'] = 'Address must be a string value.';
        }
    }

    private function validateCountry(){
        if(!helpers\Helper::isInt($this->country_id)){
            $this->errors['country_id'] = 'Country ID value must be int.';
        }
    }

    private function validateCity(){
        if(!helpers\Helper::isInt($this->city_id)){
            $this->errors['city_id'] = 'City value must be int.';
        }
    }

    private function validateEmail(){
        if(!helpers\Helper::isValidEmail($this->email)){
            $this->errors['email'] = 'Enter valid email address.';
        }
    }

    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateCompanyName();
        $this->validateAddress();
        $this->validateCity();
        $this->validateCountry();
        $this->validateEmail();
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
     * @return string
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * @param string $company_name
     */
    public function setCompanyName($company_name)
    {
        $this->company_name = $company_name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param string $country_id
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;
    }

    /**
     * @return string
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * @param string $city_id
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


}