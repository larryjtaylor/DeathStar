<?php
    /**
    * @backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Department.php";
    require_once "src/Division.php";
    require_once "src/Employee.php";

    $server = 'mysql:host=localhost:8889;dbname=death_star_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DivisionTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Department::deleteAll();
            Division::deleteAll();
            Employee::deleteAll();
        }

        function testGetDivName()
        {
            // Arrange
            $div_name = "High Command";
            $test_division = new Division($div_name);

            // Act
            $result = $test_division->getDivName();

            // Assert
            $this->assertEquals($div_name, $result);
        }

        function testSetDivName()
        {
            //Arrange
            $div_name = "Security";
            $test_division = new Division($div_name);
            $new_div_name = "Maintanence";

            //Act
            $test_division->setDivName($new_div_name);
            $result = $test_division->getDivName();

            //Assert
            $this->assertEquals($new_div_name, $result);
        }

        function testGetId()
        {
            //Arrange
            $div_name = "Pilots";
            $test_division = new Division($div_name);
            $test_division->save();
            // Act
            $result = $test_division->getId();

            // Assert
            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $div_name = "Pilots";
            $test_division = new Division($div_name);

            // Act
            $executed = $test_division->save();

            // Assert
            $this->assertTrue($executed, "Division not successfully saved to the database.");
        }

        function testGetAll()
        {
            //Arrange
            $div_name = "Literally";
            $test_division = new Division($div_name);
            $test_division->save();

            $div_name_2 = "Support";
            $test_division_2 = new Division($div_name_2);
            $test_division_2->save();

            // Act
            $result = Division::getAll();

            // Assert
            $this->assertEquals([$test_division, $test_division_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $div_name = "Commanders";
            $test_division = new Division($div_name);
            $test_division->save();

            $div_name_2 = "Storm Troopers";
            $test_division_2 = new Division($div_name_2);
            $test_division_2->save();

            // Act
            Division::deleteAll();
            $result = Division::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $div_name = "IT";
            $test_division = new Division($div_name);
            $test_division->save();

            $div_name_2 = "Storm Troopers";
            $test_division_2 = new Division($div_name_2);
            $test_division_2->save();

            // Act
            $result = Division::find($test_division_2->getId());

            // Assert
            $this->assertEquals($test_division_2, $result);
        }

        function testGetDepartments()
        {
            //Arrange
            $div_name = "Work stuff";
            $test_division = new Division($div_name);
            $test_division->save();

            $test_division_id = $test_division->getId();

            $dept_name = "Email client";
            $test_department = new Department($dept_name, $test_division_id);
            $test_department->save();

            $dept_name_2 = "Meet with boss";
            $test_department_2 = new Department($dept_name_2, $test_division_id);
            $test_department_2->save();

            //Act
            $result = $test_division->getDepartments();

            //Assert
            $this->assertEquals([$test_department, $test_department_2], $result);
        }
    }
?>
