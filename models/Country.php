<?php
/**
 * Created by PhpStorm.
 * User: krasimir
 * Date: 15-8-29
 * Time: 23:50
 */

namespace models;


use models\entities\Entity;

class Country extends Entity
{

    private $id;
    private $country = '';
    private $state = '';
    private $entity_state;

    private $entity_table = 'countries';
    private $entity_class = 'Country';
    private $db_fields = ['id', 'country', 'state'];
    private $primary_keys = ['id'];
    private $errors = [];

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

    private function validateCountry(){
        if (helpers\Helper::isEmpty($this->country)){
            $this->errors['country'] = 'Country name can not be empty.';
        }elseif(!helpers\Helper::isString($this->country)){
            $this->errors['country'] = 'Country must be a string value.';
        }
    }

    private function validateState(){
        if(helpers\Helper::isEmpty($this->state)){
            $this->errors['state'] = 'State name can not be empty.';
        }elseif(!helpers\Helper::isString($this->state)){
            $this->errors['state'] = 'State must be a string value.';
        }
    }

    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateCountry();
        $this->validateState();
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
     * @return Country
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Country
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Country
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

}