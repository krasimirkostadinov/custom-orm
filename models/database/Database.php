<?php
namespace models\database;

/**
 * Database use \PDO driver and contain all necessary methods and functions
 * for DB manipulations. Created methods dealing with _stmt for easier
 * data manipulation.
 *
 * @author Krasimir Kostadinov
 */
class Database{
    private $host = 'localhost',
        $user = 'root',
        $pass = 'krassis',
        $dbname = 'chaos_group',
        $dbtype = 'mysql';

    private $db_handler,
        $error,
        $statement;


    public function __construct(){
        $dsn = $this->dbtype.':host='.$this->host.';dbname='.$this->dbname;
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            \PDO::ATTR_PERSISTENT => true
        ];

        try{
            $this->db_handler = new \PDO($dsn, $this->user, $this->pass, $options);
        }catch (\PDOException $e){
            $this->error = $e->getMessage();
            error_log('Error during PDO init. Message: '.$e->getMessage());
            die('<p class="general-error">'.$this->error.'</p>');
        }
    }

    public function prepare($query){
        $this->statement = $this->db_handler->prepare($query);
    }

    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
    }

    public function execute(){
        $this->statement->execute();
    }

    /**
     * Perform a SELECT statement
     * @param $table
     * @param string $where
     * @param string $fields
     * @param string $order
     * @param null $limit
     * @param null $offset
     * @return int
     */
    public function select($table, $where = '', $fields = '*', $order = '', $limit = null, $offset = null)
    {
        $query = 'SELECT ' . $fields . ' FROM ' . $table
               . (($where) ? ' WHERE ' . $where : '')
               . (($limit) ? ' LIMIT ' . $limit : '')
               . (($offset && $limit) ? ' OFFSET ' . $offset : '')
               . (($order) ? ' ORDER BY ' . $order : '');
        $this->prepare($query);
    }

    /**
     * Perform an INSERT statement
     */
    public function insert($table, $data)
    {

        ksort($data);
        $fieldNames = implode(',', array_keys($data));
        $fieldValues = ':'.implode(', :', array_keys($data));

        $qry = "INSERT INTO $table ($fieldNames) VALUES ($fieldValues)";
        $this->prepare($qry);

        foreach ($data as $k => $v) {
            $this->bind(":$k", $v);
        }
        $this->execute();

    }
    
    /**
     * Perform an UPDATE statement
     */
    public function update($table, array $data, $where = '')
    {
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = :$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $qry = "UPDATE $table SET $fieldDetails " . ($where ? 'WHERE '.$where : '');
        $this->prepare($qry);
        foreach ($data as $k => $v) {
            $this->bind(":$k", $v);
        }
        $this->execute();
    }
    
    /**
     * Perform a DELETE statement
     */
    public function delete($table, $where = '', $limit=1)
    {
        $this->prepare("DELETE FROM $table WHERE $where LIMIT $limit");
        $this->execute();
    }

    public function resultset(){
        $this->execute();
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function objectSet($entityClass){
        $this->execute();
        $this->statement->setFetchMode(\PDO::FETCH_CLASS, $entityClass);
        return $this->statement->fetchAll();
    }

    public function singleObject($entityClass){
        $this->execute();
        $this->statement->setFetchMode(\PDO::FETCH_CLASS, $entityClass);
        return $this->statement->fetch();
    }

    public function rowCount(){
        return $this->statement->rowCount();
    }

    public function lastInsertedId(){
        return $this->db_handler->lastInsertId();
    }

    public function beginTransaction(){
        return $this->db_handler->beginTransaction();
    }

    public function endTransaction(){
        return $this->db_handler->commit();
    }

    public function cancellTransaction(){
        return $this->db_handler->rollBack();
    }

    public function debugDumpParams(){
        return $this->statement->debugDumpParams();
    }

}