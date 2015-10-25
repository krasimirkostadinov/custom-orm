<?php
/**
 * Created by PhpStorm.
 * User: krasimir
 * Date: 15-8-29
 * Time: 21:03
 */

namespace models;


use models\entities\Entity;

class Employer extends Entity
{
    private $id;
    private $employee_name = '';
    private $employee_email = '';
    private $country_id = '';
    private $city_id = '';
    private $employee_address = '';
    private $employee_phone = '';
    private $company_id = '';
    private $entity_state;
    private $errors = [];


    private $entity_table = 'employers';
    private $entity_class = 'Employer';
    private $db_fields = ['id', 'employee_name', 'employee_email', 'country_id', 'city_id', 'employee_address', 'employee_phone', 'company_id'];
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

    private function validateCountryId(){
        if(!helpers\Helper::isInt($this->country_id)){
            $this->errors['country_id'] = 'Country id value must be int.';
        }
    }

    private function validateCityId(){
        if(!helpers\Helper::isInt($this->city_id)){
            $this->errors['city_id'] = 'City value must be int.';
        }
    }


    private function validateEmployerName(){
        if(helpers\Helper::isEmpty($this->employee_name)){
            $this->errors['employee_name'] = 'Employer name can not be empty.';
        }elseif(!helpers\Helper::isString($this->employee_name)){
            $this->errors['employee_name'] = 'Employer name must be a string value.';
        }
    }

    private function validateEmployerEmail(){
        if(!helpers\Helper::isValidEmail($this->employee_email)){
            $this->errors['employee_email'] = 'Employer email is not valid email address.';
        }
    }

    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateCompanyId();
        $this->validateCountryId();
        $this->validateCityId();
        $this->validateEmployerName();
        $this->validateEmployerEmail();
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
     * @return Employer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeName()
    {
        return $this->employee_name;
    }

    /**
     * @param string $employee_name
     * @return Employer
     */
    public function setEmployeeName($employee_name)
    {
        $this->employee_name = $employee_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeEmail()
    {
        return $this->employee_email;
    }

    /**
     * @param string $employee_email
     * @return Employer
     */
    public function setEmployeeEmail($employee_email)
    {
        $this->employee_email = $employee_email;
        return $this;
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
     * @return Employer
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;
        return $this;
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
     * @return Employer
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeAddress()
    {
        return $this->employee_address;
    }

    /**
     * @param string $employee_address
     * @return Employer
     */
    public function setEmployeeAddress($employee_address)
    {
        $this->employee_address = $employee_address;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeePhone()
    {
        return $this->employee_phone;
    }

    /**
     * @param string $employee_phone
     * @return Employer
     */
    public function setEmployeePhone($employee_phone)
    {
        $this->employee_phone = $employee_phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @param string $company_id
     * @return Employer
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
        return $this;
    }


}