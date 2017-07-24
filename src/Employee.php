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
}



?>
