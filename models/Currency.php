<?php
/**
 * Created by PhpStorm.
 * User: krasimir
 * Date: 15-8-29
 * Time: 23:52
 */

namespace models;


use models\entities\Entity;

class Currency extends Entity
{
    private $id;
    private $name = '';
    private $entity_state;

    private $entity_table = 'currencies';
    private $entity_class = 'Currency';
    private $db_fields = ['id', 'name'];
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

    private function validateName(){
        if (helpers\Helper::isEmpty($this->name)){
            $this->errors['name'] = 'Currency name can not be empty.';
        }elseif(!helpers\Helper::isString($this->name)){
            $this->errors['name'] = 'Currency must be a string value.';
        }
    }

    /**
     * Override parent is_valid method and check validation for current instance
     * @return bool
     */
    public function is_valid()
    {
        $this->validateName();
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
     * @return Currency
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Currency
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}