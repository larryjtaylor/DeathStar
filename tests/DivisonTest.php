<?php
    /**
    * @backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Division.php";

    $server = 'mysql:host=localhost:8889;dbname=death_star';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DivisionTest extends PHPUnit_Framework_TestCase
    {
        function testGetDivName()
        {
            // Arrange
            $div_name = "High Command";
            $test_div_name = new Division($div_name);

            // Act
            $result = $test_div_name->getDivName();

            // Assert
            $this->assertEquals($div_name, $result);
        }

        function testSetDivName()
        {
            //Arrange
            $div_name = "Security";
            $test_div_name = new Division($div_name);
            $new_div_name = "Maintanence";

            //Act
            $test_div_name->setDivName($new_div_name);
            $result = $test_div_name->getDivName();

            //Assert
            $this->assertEquals($new_div_name, $result);
        }
    }
?>
