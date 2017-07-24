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
            var_dump($returned_divisions);
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
    }

 ?>
