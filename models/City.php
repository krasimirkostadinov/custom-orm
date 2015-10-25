<?php
/**
 * Created by PhpStorm.
 * User: krasimir
 * Date: 15-8-29
 * Time: 13:53
 */

namespace models;


use models\entities\Entity;

class City extends Entity
{
    private $id;
    private $country_id;
    private $city;
    private $zip;
    private $entity_state;
    private $errors = [];

    private $entity_table = 'cities';
    private $entity_class = 'City';
    private $db_fields = ['id', 'country_id', 'city', 'zip'];
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

    private function validateCountry(){
        if(!helpers\Helper::isInt($this->country_id)){
            $this->errors['country_id'] = 'Country id value must be int.';
        }
    }

    private function validateCity(){
        if(helpers\Helper::isEmpty($this->city)){
            $this->errors['city'] = 'City name can not be empty.';
        }elseif(!helpers\Helper::isString($this->city)){
            $this->errors['city'] = 'City must be a string value.';
        }
    }

    private function validateZip(){
        if(helpers\Helper::isEmpty($this->zip)){
            $this->errors['zip'] = 'Zip code can not be empty.';
        }elseif(!helpers\Helper::isString($this->zip)){
            $this->errors['zip'] = 'Zip code must be a string value.';
        }
    }

    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateCountry();
        $this->validateCity();
        $this->validateZip();
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
     * @return City
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param mixed $country_id
     * @return City
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return City
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     * @return City
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * Get entity class
     * @return string
     */
    public function getEntityClass(){
        return $this->entity_class;
    }

}