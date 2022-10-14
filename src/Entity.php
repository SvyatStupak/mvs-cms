<?php

namespace src;

abstract class Entity
{
    protected $dbc;

    protected $tableName;
    protected $fields;
    protected $primeryKeys = ['id'];

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
                $this->setValue( $objectData, $object);
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
            $this->setValue($result[0]);
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

    public function save()
    {

        $fieldBindings = [];
        $keysBinding = [];
        $preparedFields = [];

        foreach ($this->fields as $fieldName) {
            $fieldBindings[$fieldName] = $fieldName . '= :' . $fieldName;
            $preparedFields[$fieldName] = $this->$fieldName;
        }
        
        
        foreach ($this->primeryKeys as $keyName) {
            $keysBinding[$keyName] = $keyName . '= :' . $keyName;
            $preparedFields[$keyName] = $this->$keyName;
        }
        
        $fieldBindingsString = join(',', $fieldBindings);
        $keysBindingString = join(',', $keysBinding);


        $sql = "UPDATE $this->tableName SET $fieldBindingsString WHERE $keysBindingString";

        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields);
    }


    public function setValue($values, $object=null)
    {
        if ($object === null) 
        {
            $object = $this;
        }
        foreach ($object->fields as $fieldName) 
        {
            if (isset($values[$fieldName])) 
            {
                $object->$fieldName = $values[$fieldName];
            }
        }

        foreach ($object->primeryKeys as $keyName) 
        {
            if (isset($values[$keyName])) 
            {
                $object->$keyName = $values[$keyName];
            }
        }

        return $object;
    }
}
