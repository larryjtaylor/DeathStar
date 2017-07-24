<?php

    class Division
    {
        private $div_name;
        private $id;

        function __construct($div_name, $id= null)
        {
            $this->div_name = $div_name;
            $this->id = $id;
        }

        function getDivName()
        {
            return $this->div_name;
        }

        function setDivName($new_div_name)
        {
            $this->div_name = (string) $new_div_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO  divisions (div_name) VALUES ('{$this->getDivName()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_divisions = $GLOBALS['DB']->query("SELECT * FROM divisions;");
            $divisions = array();
            foreach($returned_divisions as $division) {
                $div_name = $division['div_name'];
                $id = $division['id'];
                $new_division = new Division($div_name, $id);
                array_push($divisions, $new_division);
            }
            return $divisions;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM divisions;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        static function find($search_id)
        {
            $returned_divisions = $GLOBALS['DB']->prepare("SELECT * FROM divisions WHERE id = :id");
            $returned_divisions->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_divisions->execute();
            foreach ($returned_divisions as $division) {
                $div_name = $division['div_name'];
                $id = $division['id'];
                if ($id == $search_id) {
                    $returned_division = new Division($div_name, $id);
                }
            }
            return $returned_division;
        }

        function getDepartments()
        {
            $departments = Array();
            $returned_departments = $GLOBALS['DB']->query("SELECT * FROM departments WHERE division_id = {$this->getId()};");
            foreach($returned_departments as $department) {
                $dept_name = $department['dept_name'];
                $id = $department['id'];
                $division_id = $department['division_id'];
                $new_department = new Department($dept_name, $division_id, $id);
                array_push($departments, $new_department);
            }
            return $departments;
        }
    }

 ?>
