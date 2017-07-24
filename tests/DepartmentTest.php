<?php
    /**
    * @backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Department.php";

    $server = 'mysql:host=localhost:8889;dbname=death_star';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DepartmentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Department::deleteAll();
        }

        function testGetDeptName()
        {
            // Arrange
            $dept_name = "High Command";
            $test_department = new Department($dept_name);

            // Act
            $result = $test_department->getDeptName();

            // Assert
            $this->assertEquals($dept_name, $result);
        }

        function testSetDeptName()
        {
            //Arrange
            $dept_name = "Security";
            $test_department = new Department($dept_name);
            $new_dept_name = "Maintanence";

            //Act
            $test_department->setDeptName($new_dept_name);
            $result = $test_department->getDeptName();

            //Assert
            $this->assertEquals($new_dept_name, $result);
        }

        function testGetId()
        {
            //Arrange
            $dept_name = "Pilots";
            $test_department = new Department($dept_name);
            $test_department->save();
            // Act
            $result = $test_department->getId();

            // Assert
            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $dept_name = "Pilots";
            $test_department = new Department($dept_name);

            // Act
            $executed = $test_department->save();

            // Assert
            $this->assertTrue($executed, "Department not successfully saved to the database.");
        }

        function testGetAll()
        {
            //Arrange
            $dept_name = "Literally";
            $test_department = new Department($dept_name);
            $test_department->save();

            $dept_name_2 = "Support";
            $test_department_2 = new Department($dept_name_2);
            $test_department_2->save();

            // Act
            $result = Department::getAll();

            // Assert
            $this->assertEquals([$test_department, $test_department_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $dept_name = "Commanders";
            $test_department = new Department($dept_name);
            $test_department->save();

            $dept_name_2 = "Storm Troopers";
            $test_department_2 = new Department($dept_name_2);
            $test_department_2->save();

            // Act
            Department::deleteAll();
            $result = Department::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $dept_name = "IT";
            $test_department = new Department($dept_name);
            $test_department->save();

            $dept_name_2 = "Storm Troopers";
            $test_department_2 = new Department($dept_name_2);
            $test_department_2->save();

            // Act
            $result = Department::find($test_department_2->getId());

            // Assert
            $this->assertEquals($test_department_2, $result);
        }

        function testUpdate()
        {
            // Arrange
            $dept_name = "Shooeos";
            $test_dept = new Department($dept_name);
            $test_dept->save();

            $new_dept_name = "Shoes";

            // Act
            $test_dept->update($new_dept_name);

            // Assert
            $this->assertEquals("Shoes", $test_dept->getDeptName());
        }

        function testDelete()
        {
            // Arrange
            $dept_name_1 = "Walking Department";
            $test_dept_1 = new Department($dept_name_1);
            $test_dept_1->save();

            $dept_name_2 = "Running Shoes";
            $test_dept_2 = new Department($dept_name_2);
            $test_dept_2->save();

            // Act
            $test_dept_1->delete();

            // Assert
            $this->assertEquals([$test_dept_2], Department::getAll());
        }
    }
?>
