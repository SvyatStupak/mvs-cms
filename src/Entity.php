<?php

class Entity
{
    protected $dbc;

    protected $tableName;
    protected $fields;

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
