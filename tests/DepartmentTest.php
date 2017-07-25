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

    class DepartmentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Department::deleteAll();
            Division::deleteAll();
            Employee::deleteAll();
        }

        function testGetDeptName()
        {
            // Arrange
            $div_name = "Army";
            $test_division = new Division($div_name);
            $test_division->save();

            $dept_name = "High Command";
            $division_id = $test_division->getId();
            $test_department = new Department($dept_name, $division_id);

            // Act
            $result = $test_department->getDeptName();

            // Assert
            $this->assertEquals($dept_name, $result);
        }

        function testSetDeptName()
        {
            //Arrange
            $div_name = "Navy";
            $test_division = new Division($div_name);
            $test_division->save();

            $dept_name = "Security";
            $division_id = $test_division->getId();
            $test_department = new Department($dept_name, $division_id);

            $new_dept_name = "Maintenance";

            //Act
            $test_department->setDeptName($new_dept_name);
            $result = $test_department->getDeptName();

            //Assert
            $this->assertEquals($new_dept_name, $result);
        }

        function testGetId()
        {
            //Arrange
            $div_name = "Maintenance";
            $test_division = new Division($div_name);
            $test_division->save();

            $dept_name = "Engineering";
            $division_id = $test_division->getId();
            $test_department = new Department($dept_name, $division_id);
            $test_department->save();
            // Act
            $result = $test_department->getId();

            // Assert
            $this->assertTrue(is_numeric($result));
        }

        function testGetDivisionId()
      {
          //Arrange
          $div_name = "Troops";
          $test_division = new Division($div_name);
          $test_division->save();

          $division_id = $test_division->getId();
          $dept_name = "Death Star Troopers";
          $test_task = new Department($dept_name, $division_id);
          $test_task->save();

          //Act
          $result = $test_task->getDivisionId();

          //Assert
          $this->assertEquals($division_id, $result);;
      }

        function testSave()
        {
            //Arrange
            $div_name = "Support Crew";
            $test_division = new Division($div_name);
            $test_division->save();

            $dept_name = "Technician";
            $division_id = $test_division->getId();
            $test_department = new Department($dept_name, $division_id);

            // Act
            $executed = $test_department->save();

            // Assert
            $this->assertTrue($executed, "Department not successfully saved to the database.");
        }

        function testGetAll()
        {
            //Arrange
            $div_name = "Officers";
            $test_division = new Division($div_name);
            $test_division->save();
            $division_id = $test_division->getId();

            $dept_name = "Lieutenant";
            $test_department = new Department($dept_name, $division_id);
            $test_department->save();

            $dept_name_2 = "Colonel";
            $test_department_2 = new Department($dept_name_2, $division_id);
            $test_department_2->save();

            // Act
            $result = Department::getAll();

            // Assert
            $this->assertEquals([$test_department, $test_department_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $div_name = "Officers";
            $test_division = new Division($div_name);
            $test_division->save();
            $division_id = $test_division->getId();

            $dept_name = "Commanders";
            $test_department = new Department($dept_name, $division_id);
            $test_department->save();

            $dept_name_2 = "Storm Troopers";
            $test_department_2 = new Department($dept_name_2, $division_id);
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
            $div_name = "Parks and Rec";
            $test_division = new Division($div_name);
            $test_division->save();
            $division_id = $test_division->getId();

            $dept_name = "Litter Control";
            $test_department = new Department($dept_name, $division_id);
            $test_department->save();

            $dept_name_2 = "Landscaping";
            $test_department_2 = new Department($dept_name_2, $division_id);
            $test_department_2->save();

            // Act
            $result = Department::find($test_department_2->getId());

            // Assert
            $this->assertEquals($test_department_2, $result);
        }

        function testUpdate()
        {
            // Arrange

            $dept_name = 'Becky';
            $test_division = new Division($dept_name);
            $test_division->save();
            $division_id = $test_division->getId();

            $dept_name = "Waste Management";
            $test_dept = new Department($dept_name, $division_id);
            $test_dept->save();

            $new_dept_name = "Waste Management";

            // Act
            $test_dept->update($new_dept_name);

            // Assert
            $this->assertEquals("Waste Management", $test_dept->getDeptName());
        }

        function testDelete()
        {
            // Arrange
            $dept_name = 'Becky';
            $test_division = new Division($dept_name);
            $test_division->save();
            $division_id = $test_division->getId();

            $dept_name_1 = "Walking Department";
            $test_dept_1 = new Department($dept_name_1, $division_id);
            $test_dept_1->save();

            $dept_name_2 = "Training";
            $test_dept_2 = new Department($dept_name_2, $division_id);
            $test_dept_2->save();

            // Act
            $test_dept_1->delete();

            // Assert
            $this->assertEquals([$test_dept_2], Department::getAll());
        }

        function testAddEmployee()
        {
            //Arrange
            $name = "Chewy";
            $rank = "Major";
            $species = "Wookie";
            $pay = 50;
            $record = "Major failure";
            $test_employee = new Employee($name, $rank, $species, $pay, $record);
            $test_employee->save();

            $dept_name = 'Becky';
            $test_division = new Division($dept_name);
            $test_division->save();
            $division_id = $test_division->getId();

            $dept_name = "Pilots";
            $test_department = new Department($dept_name, $division_id);
            $test_department->save();

            $dept_name2 = "Pilots";
            $test_department2 = new Department($dept_name2, $division_id);
            $test_department2->save();

            //Act
            $test_department->addEmployee($test_employee);

            //Assert
            $this->assertEquals([$test_employee], $test_department->getEmployees());
        }

        function testGetEmployees()
        {
            $div_name = "Sample_testy";
            $new_divison = new Division($div_name);
            $new_divison->save();
            $div_id = $new_divison->getId();

            $dept_name = "Thingy";
            $new_department = new Department($dept_name, $div_id);
            $new_department->save();

            $name = "Jimmy Joo";
            $pay = 2000;
            $rank = "God";
            $record = "A bitch ass mufuckah";
            $species = "Gorilla";
            $new_employee = new Employee($name, $rank, $species, $pay, $record);
            $new_employee->save();

            $name1 = "Jimmy Jah";
            $pay1 = 4000;
            $rank1 = "Man";
            $record1 = "A dope ass mufuckah";
            $species1 = "Swangy";
            $new_employee1 = new Employee($name1, $rank1, $species1, $pay1, $record1);
            $new_employee1->save();

            $new_department->addEmployee($new_employee);
            $new_department->addEmployee($new_employee1);

            $result = $new_department->getEmployees();

            $this->assertEquals([$new_employee, $new_employee1], $result);



        }
    }
?>
