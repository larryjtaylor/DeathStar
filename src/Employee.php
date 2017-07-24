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

    function updateRank($new_rank)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE employees SET rank = '{$new_rank}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setRank($new_rank);
            return true;
        } else {
            return false;
        }
    }

    function updateSpecies($new_species)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE employees SET species = '{$new_species}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setSpecies($new_species);
            return true;
        } else {
            return false;
        }
    }

    function updatePay($new_pay)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE employees SET pay = {$new_pay} WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setPay($new_pay);
            return true;
        } else {
            return false;
        }
    }

    function updateRecord($new_record)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE employees SET record = '{$new_record}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setRecord($new_record);
            return true;
        } else {
            return false;
        }
    }

    function delete()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM employees WHERE id = {$this->getId()};");
        if ($executed) {
            ("DELETE FROM departments_employees WHERE id = {$this->getId()};");
        } else {
            return false;
        }
    }

    function addDepartment($department)
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO departments_employees (department_id, employee_id) VALUES ({$department->getId()}, {$this->getId()});");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    function getDepartments()
    {
        $returned_departments = $GLOBALS['DB']->query("SELECT departments.* FROM employees
            JOIN departments_employees ON (departments_employees.employee_id = employees.id)
            JOIN departments ON (departments.id = departments_employees.department_id)
            WHERE employees.id = {$this->getId()};");
        $departments = array();
        foreach ($returned_departments as $department) {
            $dept_name = $department['dept_name'];
            $division_id = $department['division_id'];
            $id = $department['id'];
            $new_department = new Department($dept_name, $division_id, $id);
            array_push($departments, $new_department);
        }
        return $departments;
    }
}



?>
