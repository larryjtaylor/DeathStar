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

        function testGetId()
        {
            //Arrange
            $div_name = "Pilots";
            $test_div_name = new Division($div_name);
            $test_div_name->save();
            // Act
            $result = $test_div_name->getId();

            // Assert
            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $div_name = "Pilots";
            $test_div_name = new Division($div_name);

            // Act
            $executed = $test_div_name->save();

            // Assert
            $this->assertTrue($executed, "Division not successfully saved to the database.");
        }
    }
?>
