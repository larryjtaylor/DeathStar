<?php

    class Department
    {
        private $dept_name;
        private $division_id;
        private $id;

        function __construct($dept_name, $division_id, $id= null)
        {
            $this->dept_name = $dept_name;
            $this->division_id = $division_id;
            $this->id = $id;
        }

        function getDeptName()
        {
            return $this->dept_name;
        }

        function setDeptName($new_dept_name)
        {
            $this->dept_name = (string) $new_dept_name;
        }

        function getId()
        {
            return $this->id;
        }

        function getDivisionId()
        {
            return $this->division_id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO  departments (dept_name, division_id) VALUES ('{$this->getDeptName()}', {$this->getDivisionId()});");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_departments = $GLOBALS['DB']->query("SELECT * FROM departments;");
            $departments = array();
            foreach($returned_departments as $department) {
                $dept_name = $department['dept_name'];
                $division_id = $department['division_id'];
                $id = $department['id'];
                $new_department = new Department($dept_name, $division_id, $id);
                array_push($departments, $new_department);
            }
            return $departments;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM departments;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function addEmployee($employee)
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO departments_employees (employee_id, department_id) VALUES ({$employee->getId()}, {$this->getId()});");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function getEmployees()
        {
            $returned_employees = $GLOBALS['DB']->query("SELECT employees.* FROM departments
                JOIN departments_employees ON (departments_employees.department_id = departments.id)
                JOIN employees ON (employees.id = departments_employees.employee_id)
                WHERE departments.id = {$this->getId()};");
            $employees = array();
            foreach ($returned_employees as $employee) {
                $employee_name = $employee['name'];
                $employee_id = $employee['id'];
                $rank = $employee['rank'];
                $species = $employee['species'];
                $pay = $employee['pay'];
                $record = $employee['record'];
                $new_employee = new Employee($employee_name, $rank, $species, $pay, $record, $employee_id);
                array_push($employees, $new_employee);
            }
            return $employees;
        }

        static function find($search_id)
        {
            $returned_departments = $GLOBALS['DB']->prepare("SELECT * FROM departments WHERE id = :id");
            $returned_departments->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_departments->execute();
            foreach ($returned_departments as $department) {
                $dept_name = $department['dept_name'];
                $division_id = $department['division_id'];
                $id = $department['id'];
                if ($id == $search_id) {
                    $returned_department = new Department($dept_name, $division_id, $id);
                }
            }
            return $returned_department;
        }

        function update($new_dept_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE departments SET dept_name = '{$new_dept_name}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setDeptName($new_dept_name);
                return true;
            } else {
                return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM departments WHERE id = {$this->getId()};");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function addEmployee($employee)
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO departments_employees (employee_id, department_id) VALUES ({$employee->getId()}, {$this->getId()});");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function getEmployees()
        {
            $returned_employees = $GLOBALS['DB']->query("SELECT employees.* FROM departments
                JOIN departments_employees ON (departments_employees.department_id = departments.id)
                JOIN employees ON (employees.id = departments_employees.employee_id)
                WHERE departments.id = {$this->getId()};");
            $employees = array();
            foreach ($returned_employees as $employee) {
                $employee_name = $employee['name'];
                $employee_id = $employee['id'];
                $rank = $employee['rank'];
                $species = $employee['species'];
                $pay = $employee['pay'];
                $record = $employee['record'];
                $new_employee = new Employee($employee_name, $rank, $species, $pay, $record, $employee_id);
                array_push($employees, $new_employee);
            }
            return $employees;
        }
    }

 ?>
