<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Employee.php";

    $server = 'mysql:host=localhost:8889;dbname=death_star_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class EmployeeTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
            //Arrange
            $name = "Chewy";
            $rank = "Major";
            $species = "Wookie";
            $pay = 50;
            $record = "Major failure";
            $test_employee = new Employee($name, $rank, $species, $pay, $record);

            //Act
            $result = $test_employee->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Chewy";
            $rank = "Major";
            $species = "Wookie";
            $pay = 50;
            $record = "Major failure";
            $test_employee = new Employee($name, $rank, $species, $pay, $record);
            $new_name = "R2D2";

            //Act
            $test_employee->setName($new_name);
            $result = $test_employee->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetRank()
        {
            //Arrange
            $name = "Chewy";
            $rank = "Major";
            $species = "Wookie";
            $pay = 50;
            $record = "Major failure";
            $test_employee = new Employee($name, $rank, $species, $pay, $record);

            //Act
            $result = $test_employee->getRank();

            //Assert
            $this->assertEquals($rank, $result);
        }

        function testSetRank()
        {
            //Arrange
            $name = "Chewy";
            $rank = "Major";
            $species = "Wookie";
            $pay = 50;
            $record = "Major failure";
            $test_employee = new Employee($name, $rank, $species, $pay, $record);
            $new_rank = "Captain";

            //Act
            $test_employee->setRank($new_rank);
            $result = $test_employee->getRank();

            //Assert
            $this->assertEquals($new_rank, $result);
        }

        function testGetSpecies()
        {
            //Arrange
            $name = "Chewy";
            $rank = "Major";
            $species = "Wookie";
            $pay = 50;
            $record = "Major failure";
            $test_employee = new Employee($name, $rank, $species, $pay, $record);

            //Act
            $result = $test_employee->getSpecies();

            //Assert
            $this->assertEquals($species, $result);
        }

        function testSetSpecies()
        {
            //Arrange
            $name = "Chewy";
            $rank = "Major";
            $species = "Wookie";
            $pay = 50;
            $record = "Major failure";
            $test_employee = new Employee($name, $rank, $species, $pay, $record);
            $new_species = "Bothan";

            //Act
            $test_employee->setSpecies($new_species);
            $result = $test_employee->getSpecies();

            //Assert
            $this->assertEquals($new_species, $result);
        }
    }
?>
