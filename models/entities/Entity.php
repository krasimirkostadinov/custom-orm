<?php
namespace models\entities;

use models\database\Database;
use models\database\DBContext;

class Entity
{
    private $db;
    private $db_context;

    public function __construct(){
        $this->db = new Database();
        $this->db_context = new DBContext();
    }

    private function _add(){
        foreach ($this->db_fields as $key) {
            $data[$key] = $this->$key;
        }
        $this->db->insert($this->entity_table, $data);
    }

    private function _update(){
        foreach ($this->db_fields as $key) {
            if(!is_null($this->$key)){
                $data[$key] = $this->$key;
            }
        }
        $where = ' ';
        foreach ($this->primary_keys as $key) {
            $where .= ' '.$key."=".$this->$key. " &&";
        }
        $where = rtrim($where, "&");

        $this->db->update($this->entity_table, $data, $where);
    }

    /**
     * Save or update existing entity row in Database
     */
    public function save(){
        //validate model for valid properties (as requirements)
        if($this->is_valid()){
            if($this->id > 0){
                $this->_update();
            }else{
                $this->_add();
            }
        }else{
            $output_html = '<h3>Errors for class <strong>'.$this->entity_class.'</strong></h3>';
            $output_html .= '<ul>';
                foreach ($this->errors as $single_error) {
                    $output_html .= '<li class="class-error">'.$single_error.'</li>';
                }
            $output_html .= '</ul>';
            echo $output_html;
        }
    }

    /**
     * Validation logic is implemented in child class
     */
    public function is_valid()
    {

    }

    /**
     * Delete entity row in database
     */
    public function delete(){
        $where = ' ';
        foreach ($this->primary_keys as $key) {
            $where .= ' '.$key."=".$this->$key. " &&";
        }
        $where = rtrim($where, "&");
        $this->db->delete($this->entity_table, $where);
    }

    /**
     * Method search for dynamic methods by entity instance
     * example: $company->findByNameAndActive('Blizzard', 1)
     * @param $function
     * @param $args
     * @return mixed
     */
    public function __call($function, $args) {
        //remove findBy keyword and explode searched fields
        $fields_str = str_replace('findBy', '', $function);
        $fields = explode('And', $fields_str);
        $prepared_fields = [];
        $counter = 0;

        foreach ($fields as $field) {
            $field = strtolower($field);
            //check if passed parameter to field name
            if(isset($args[$counter])){
                $prepared_fields[$field] = $args[$counter];
                $counter++;
            }
        }
        return $this->db_context->findAll($this, $prepared_fields);
    }

    /**
     * @param array $conditions
     * @param string $fields
     * @param string $order
     * @param null $limit
     * @param string $offset
     * @return mixed
     */
    public function find($conditions = [], $fields='*', $order = '', $limit = null, $offset = '')
    {
        try{
            $result = $this->db_context->find($this, $conditions, $fields, $order, $limit, $offset);
            return $result;
        }catch (\Exception $e){
            error_log('Error during query. Message: '.$e->getMessage());
            die($e->getMessage());
        }
    }

    /**
     * @param array $conditions
     * @param string $fields
     * @param string $order
     * @param null $limit
     * @param string $offset
     * @return mixed
     */
    public function findAll($conditions = [], $fields='*', $order = '', $limit = null, $offset = ''){
        try{
            $result = $this->db_context->findAll($this, $conditions, $fields, $order, $limit, $offset);
            return $result;
        }catch (\Exception $e){
            error_log('Error during query. Message: '.$e->getMessage());
            die($e->getMessage());
        }
    }
}