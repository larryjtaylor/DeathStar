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
            $executed = $GLOBALS['DB']->query("SELECT * FROM divisions");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }
    }

 ?>
