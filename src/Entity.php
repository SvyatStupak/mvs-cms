<?php

abstract class Entity
{
    protected $dbc;

    protected $tableName;
    protected $fields;

    abstract protected function initFields();

    protected function __construct($dbc, $tableName)
    {   
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }

    public function findBy($fieldName, $fieldValue)
    {
        $sql = "SELECT * FROM $this->tableName WHERE $fieldName=:value";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(['value' => $fieldValue]); 
        $databaseData = $stmt->fetch();

        $this->setValue($databaseData);
    }

    public function setValue($values)
    {
        foreach ($this->fields as $fieldName) {
           $this->$fieldName = $values[$fieldName];
        }
    }
}
