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
    }
?>
