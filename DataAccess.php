<?php
/**
 *
 * Copie conforme du DataAccess PROJECT BOGOVILLE,
 * Fait par la meilleur gang de PROG EVER
 *
 */


namespace model;

class DataAccess implements RequestInterface
{

    /**
     * @var \PDO
     */
    protected $_pdo;
    protected $_tableName;
    protected $_idColumnName;
    protected $_nameColumnName;
    protected $_columns;

    /**
     * Region constructor.
     */
    public function __construct($pdo)
    {
        $this->_pdo = $pdo;
        $tmp_array = explode("\\", get_class($this));
        $this->_tableName = lcfirst(end($tmp_array));
    }

    /**
     * Retourne un object sous forme de tableau
     *
     * @param $id ID de l'objet dans sa table SQL
     * @return mixed L'objet
     */
    public function getOneById($id)
    {
        $statement = $this->_pdo->prepare("SELECT * FROM {$this->_tableName} WHERE {$this->_idColumnName} =?");
        $statement->execute([$id]);
        return $statement->fetchObject();
    }

    /**
     * Retourne toutes les données d'une table
     */
    public function getAll()
    {
        $statement = $this->_pdo->prepare("SELECT * FROM {$this->_tableName}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Delete the row associated to an ID
     *
     * @param $id The corresponding ID to delete
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function deleteWithId($id)
    {
        $statement = $this->_pdo->prepare("DELETE FROM {$this->_tableName} WHERE {$this->_idColumnName}=?");
        return $statement->execute([$id]);
    }

    /**
     * Sexy insert
     *
     * @param array $datas Associative array with column=>data
     * @return boolean True on success
     */
    public function insert(array $datas)
    {
        unset($datas['path']);
        $sql = "INSERT INTO {$this->_tableName}("
            . implode(",", array_keys($datas))
            . ") VALUES (:"
            . implode(",:", array_keys($datas))
            . ");";
        $statement = $this->_pdo->prepare($sql);

        $response = $statement->execute($datas);

        if ($response){
            return $this->_pdo->lastInsertId();
        }else{
            return false;
        }
    }

    /**
     * Update an object with a corresponding ID
     *
     * @param $id The ID
     * @param array $data An associative array of the datas to update. The keys need to
     *        have the same name as the column names
     */
    public function updateWithId($id, array $data)
    {
        unset($data['path']);
        $copy_data = $data;
        foreach ($data as $key => &$value) {
            $value = $key . " = :" . $key;
        }
        $sql = "UPDATE {$this->_tableName} SET "
            . implode(", ", $data)
            . " WHERE {$this->_idColumnName}=:id";
        $statement = $this->_pdo->prepare($sql);
        $statement->execute(array_merge(["id" => $id], $copy_data));
    }

    public function getAllWithEqualCondition($fieldName, $fieldValue)
    {
        //TODO passer en référence pour éciter l'injection
        $statement = $this->_pdo->prepare("SELECT * FROM {$this->_tableName} WHERE {$this->_tableName}." . $fieldName . " = " . $fieldValue);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getOneWithEqualCondition($fieldName, $fieldValue, $columnName){
        $statement = $this->_pdo->prepare("SELECT {$columnName} FROM {$this->_tableName} WHERE {$fieldName} = {$fieldValue}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getCount()
    {

    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * @return mixed
     */
    public function getIdColumnName()
    {
        return $this->_idColumnName;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->_columns;
    }

    public function getColumnsType(){
        $statement = $this->_pdo->prepare("SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $this->_tableName . "'");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getForeignKeyColumns(){
        $statement = $this->_pdo->prepare(
            "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME LIKE ('" . $this->_tableName . "') AND CONSTRAINT_NAME LIKE ('fk%')"
        );
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }


}