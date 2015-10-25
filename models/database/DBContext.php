<?php

namespace models\database;

use models\entities\Entity;
use models\entities\EntityState;

class DBContext
{

    private $db;
    private $entities = [];

    public function __construct(){
        $this->db = new Database();
    }

    /**
     * Find single object by given entity
     * @param $entity
     * @param array $conditions
     * @param string $fields
     * @param string $order
     * @param null $limit
     * @param string $offset
     * @return mixed
     */
    public function find(Entity $entity, $conditions = [], $fields='*', $order = '', $limit = null, $offset = ''){
        $where = '';
        foreach ($conditions as $key => $value) {
            if(is_string($value)){
                $where .= ' '.$key.' = "'.$value.'"'." &&";
            }else{
                $where .= ' '.$key.' = '.$value. " &&";
            }
        }
        $where = rtrim($where, '&');

        try{
            $this->db->select($entity->entity_table, $where, $fields, $order, $limit, $offset);
            return $this->db->singleObject($entity->entity_class);
        }catch (\Exception $e){
            error_log('Error during query. Message: '.$e->getMessage());
            die($e->getMessage());
        }
    }

    /**
     * Find all objects from given entity type
     * @param $entity
     * @param array $conditions
     * @param string $fields
     * @param string $order
     * @param null $limit
     * @param string $offset
     * @return mixed
     */
    public function findAll(Entity $entity, $conditions = [], $fields = '*', $order = '', $limit = null, $offset = ''){
        $where = '';
        foreach ($conditions as $key => $value) {
            if(is_string($value)){
                $where .= ' '.$key.' = "'.$value.'"'." &&";
            }else{
                $where .= ' '.$key.' = '.$value. " &&";
            }
        }

        $where = rtrim($where, '&');
        try{
            $this->db->select($entity->entity_table, $where, $fields, $order, $limit, $offset);
            return $this->db->objectSet($entity->entity_class);
        }catch (\Exception $e){
            error_log('Error during query. Message: '.$e->getMessage());
            die($e->getMessage());
        }
    }

    /**
     * Save entity changes to database depends on mode
     */
    public function saveChanges(){
        $data = [];
        foreach ($this->entities as $entity) {
            switch($entity->entity_state){
                // INSERT MODE
                case EntityState::ENTITY_CREATED:
                    foreach ($entity->db_fields as $key) {
                        $data[$key] = $entity->$key;
                    }

                    $this->db->insert($entity->entity_table, $data);
                    break;
                // EDIT MODE
                case EntityState::ENTITY_MODIFIED:
                    foreach ($entity->db_fields as $key) {
                        if (!is_null($entity->$key)){
                            $data[$key] = $entity->$key;
                        }
                    }
                    $where = ' ';
                    foreach ($entity->primary_keys as $p_k) {
                        $where .= ' '.$p_k. " = ".$entity->$p_k. " &&";
                    }
                    $where = rtrim($where, '&');

                    $this->db->update($entity->entity_table, $data, $where);
                    break;
                // DELETE MODE
                case EntityState::ENTITY_DELETED:
                    $where = ' ';
                    foreach ($entity->primary_keys as $keys) {
                        $where .= ' '.$keys. " = ".$entity->$keys. " &&";
                    }
                    $where = rtrim($where, '&');

                    $this->db->delete($entity->entity_table, $where);
                    break;
                default:
                    break;
            }
        }

    }

    /**
     * Update or save entity
     * @param $entity
     */
    public function save($entity){
        if($entity->id > 0){
            //update state
            $entity->entity_state = EntityState::ENTITY_MODIFIED;
        }else{
            //insert new state
            $entity->entity_state = EntityState::ENTITY_CREATED;
        }
        array_push($this->entities, $entity);
    }

    /**
     * Delete entity
     * @param $entity
     */
    public function delete($entity){
        $entity->entity_state = EntityState::ENTITY_DELETED;
        array_push($this->entities, $entity);
    }
}