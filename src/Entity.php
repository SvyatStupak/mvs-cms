<?php

namespace src;

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

    public function findAll()
    {
        $results = [];
        $databaseData = $this->find();

        if ($databaseData) {
            $className = static::class;
            foreach ($databaseData as $objectData) 
            {
                $object = new $className($this->dbc);
                $this->setValue($object, $objectData);
                $results[] = $object;
            }
        }
        return $results;

        
    }

    public function findBy($fieldName, $fieldValue)
    {
        $result = $this->find($fieldName, $fieldValue);
        if ($result && $result[0]) 
        {
            $this->setValue($this, $result[0]);
        }
    }
    
    public function find($fieldName = '', $fieldValue = '')
    {
        $preparedFields = [];
        $sql = "SELECT * FROM $this->tableName";
        if ($fieldName) {
            $sql .= " WHERE $fieldName=:value";
            $preparedFields = ['value' => $fieldValue];
        }
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields); 
        $databaseData = $stmt->fetchAll();
        
        return $databaseData;

        
    }

    public function setValue($object, $values)
    {
        foreach ($object->fields as $fieldName) {
            $object->$fieldName = $values[$fieldName];
        }

        return $object;
    }
}
