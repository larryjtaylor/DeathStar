<?php
class Employee
{
    private $name;
    private $rank;
    private $species;
    private $pay;
    private $record;
    private $id;

    function __construct($name, $rank, $species, $pay, $record, $id = null)
    {
        $this->name = $name;
        $this->rank = $rank;
        $this->species = $species;
        $this->pay = $pay;
        $this->record = $record;
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getRank()
    {
        return $this->rank;
    }

    function setRank($new_rank)
    {
        $this->rank = (string) $new_rank;
    }

    function getSpecies()
    {
        return $this->species;
    }

    function setSpecies($new_species)
    {
        $this->species = (string) $new_species;
    }

    function getPay()
    {
        return $this->pay;
    }

    function setPay($new_pay)
    {
        $this->pay = intval($new_pay);
    }

    function getRecord()
    {
        return $this->record;
    }

    function setRecord($new_record)
    {
        $this->record = (string) $new_record;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO employees (name, rank, species, pay, record) VALUES ('{$this->getName()}', '{$this->getRank()}', '{$this->getSpecies()}', {$this->getPay()}, '{$this->getRecord()}');");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_employees = $GLOBALS['DB']->query("SELECT * FROM employees;");
        $employees = array();
        foreach($returned_employees as $employee) {
            $name = $employee['name'];
            $rank = $employee['rank'];
            $species = $employee['species'];
            $pay = $employee['pay'];
            $record = $employee['record'];
            $id = $employee['id'];
            $new_employee = new Employee($name, $rank, $species, $pay, $record, $id);
            array_push($employees, $new_employee);
        }
        return $employees;
    }

    static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM employees;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    static function find($search_id)
    {
        $found_employee = null;
        $returned_employees = $GLOBALS['DB']->prepare("SELECT * FROM employees WHERE id = :id");
        $returned_employees->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_employees->execute();
        foreach($returned_employees as $employee) {
            $name = $employee['name'];
            $rank = $employee['rank'];
            $species = $employee['species'];
            $pay = $employee['pay'];
            $record = $employee['record'];
            $id = $employee['id'];
            if ($id == $search_id) {
                $found_employee = new Employee($name, $rank, $species, $pay, $record, $id);
            }
        }
        return $found_employee;
    }

    function updateName($new_name)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE employees SET name = '{$new_name}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setName($new_name);
            return true;
        } else {
            return false;
        }
    }
}



?>
