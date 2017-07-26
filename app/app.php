<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Employee.php';
    require_once __DIR__.'/../src/Division.php';
    require_once __DIR__.'/../src/Department.php';

    $server = 'mysql:host=localhost:8889;dbname=death_star';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
       return $app['twig']->render('index.html.twig');
    });

    $app->get('/army', function() use ($app) {
        return $app['twig']->render('army.html.twig');
    });

    $app->get('/navy', function() use ($app) {
        return $app['twig']->render('navy.html.twig');
    });

    $app->post('/navy_officers', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(3);
        $department->addEmployee($employee);

        return $app['twig']->render('navy_officers.html.twig', array('navy_officers' => $department->getEmployees()));
    });

    $app->get('/navy_officers', function() use ($app) {
        $department = Department::find(3);
        return $app['twig']->render('navy_officers.html.twig', array('navy_officers' => $department->getEmployees()));
    });

    $app->get('/navy_officer/{id}', function($id) use ($app) {
        $officer = Employee::find($id);
        return $app['twig']->render('navy_officer.html.twig', array('navy_officer' => $officer));
    });

    $app->patch('/navy_officer/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = Employee::find($id);
        $employee->updateName($name);
        $employee->updateRank($rank);
        $employee->updateSpecies($species);
        $employee->updatePay($pay);
        $employee->updateRecord($record);
        return $app['twig']->render('navy_officer.html.twig', array('navy_officer' => $employee));
    });

    $app->delete('/delete_navy_officer/{id}', function($id) use ($app) {
        $officer = Employee::find($id);
        $officer->delete();
        $department = Department::find(3);
        return $app['twig']->render('navy.html.twig', array("navy_officers" => $department->getEmployees()));
    });

    $app->post('/navy_pilots', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(10);
        $department->addEmployee($employee);

        return $app['twig']->render('navy_pilots.html.twig', array('navy_pilots' => $department->getEmployees()));
    });

    $app->get('/navy_pilots', function() use ($app) {
        $department = Department::find(10);
        return $app['twig']->render('navy_pilots.html.twig', array('navy_pilots' => $department->getEmployees()));
    });

    $app->get('/navy_pilot/{id}', function($id) use ($app) {
        $pilot = Employee::find($id);
        return $app['twig']->render('navy_pilot.html.twig', array('navy_pilot' => $pilot));
    });

    $app->patch('/navy_pilot/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = Employee::find($id);
        $employee->updateName($name);
        $employee->updateRank($rank);
        $employee->updateSpecies($species);
        $employee->updatePay($pay);
        $employee->updateRecord($record);
        return $app['twig']->render('navy_pilot.html.twig', array('navy_pilot' => $employee));
    });

    $app->delete('/delete_navy_pilot/{id}', function($id) use ($app) {
        $pilot = Employee::find($id);
        $pilot->delete();
        $department = Department::find(10);
        return $app['twig']->render('navy.html.twig', array("navy_pilots" => $department->getEmployees()));
    });

    $app->get('/battle_station', function() use ($app) {
        return $app['twig']->render('battle_station.html.twig');
    });

    $app->post('/stormtroopers', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(9);
        $department->addEmployee($employee);
        return $app['twig']->render('stormtroopers.html.twig', array('stormTroopers' => $department->getEmployees()));
    });

    $app->get('/stormtroopers', function() use ($app) {
        $department = Department::find(9);
        return $app['twig']->render('stormtroopers.html.twig', array('stormTroopers' => $department->getEmployees()));
    });

    $app->get('/stormtrooper/{id}', function($id) use ($app) {
        $trooper = Employee::find($id);
        return $app['twig']->render('stormtrooper.html.twig', array('stormtrooper' => $trooper));
    });

    $app->patch('/stormtrooper/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $trooper = Employee::find($id);
        $trooper->updateName($name);
        $trooper->updateRank($rank);
        $trooper->updateSpecies($species);
        $trooper->updatePay($pay);
        $trooper->updateRecord($record);
        return $app['twig']->render('stormtrooper.html.twig', array('stormtrooper' => $trooper));
    });

    $app->delete('/delete_stormtrooper/{id}', function($id) use ($app) {
        $trooper = Employee::find($id);
        $trooper->delete();
        $department = Department::find(9);
        return $app['twig']->render('imperial.html.twig', array("stormtrooper" => $department->getEmployees()));
    });

    $app->post('/army_officers', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(1);
        $department->addEmployee($employee);
        return $app['twig']->render('army_officers.html.twig', array('army_officers' => $department->getEmployees()));
    });

    $app->get('/army_officers', function() use ($app) {
        $department = Department::find(1);
        return $app['twig']->render('army_officers.html.twig', array("army_officers" => $department->getEmployees()));
    });

    $app->get('/army_officer/{id}', function($id) use ($app) {
        $officer = Employee::find($id);
        return $app['twig']->render('army_officer.html.twig', array('army_officer' => $officer, 'all_departments' => Department::getAll()));
    });

    $app->post("/add_depts", function() use ($app) {
        $department = Department::find($_POST['dept_id']);
        $employee = Employee::find($_POST['army_officer_id']);
        $employee->addDepartment($department);
        return $app['twig']->render('index.html.twig');
    });

    $app->patch('/army_officer/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = Employee::find($id);
        $employee->updateName($name);
        $employee->updateRank($rank);
        $employee->updateSpecies($species);
        $employee->updatePay($pay);
        $employee->updateRecord($record);
        return $app['twig']->render('army_officer.html.twig', array('army_officer' => $employee));
    });

    $app->delete('/delete_army_officer/{id}', function($id) use ($app) {
        $officer = Employee::find($id);
        $officer->delete();
        $department = Department::find(1);
        return $app['twig']->render('army.html.twig', array("army_officers" => $department->getEmployees()));
    });

    $app->post('/army_troopers', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(2);
        $department->addEmployee($employee);

        return $app['twig']->render('army_troopers.html.twig', array('army_troopers' => $department->getEmployees()));
    });

    $app->get('/army_troopers', function() use ($app) {
        $department = Department::find(2);
        return $app['twig']->render('army_troopers.html.twig', array('army_troopers' => $department->getEmployees()));
    });

    $app->get('/army_trooper/{id}', function($id) use ($app) {
        $trooper = Employee::find($id);
        return $app['twig']->render('army_trooper.html.twig', array('army_trooper' => $trooper));
    });

    $app->patch('/army_trooper/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $trooper = Employee::find($id);
        $trooper->updateName($name);
        $trooper->updateRank($rank);
        $trooper->updateSpecies($species);
        $trooper->updatePay($pay);
        $trooper->updateRecord($record);
        return $app['twig']->render('army_trooper.html.twig', array('army_trooper' => $trooper));
    });

    $app->delete('/delete_army_trooper/{id}', function($id) use ($app) {
        $officer = Employee::find($id);
        $officer->delete();
        $department = Department::find(2);
        return $app['twig']->render('army.html.twig', array("army_officers" => $department->getEmployees()));
    });

    $app->post('/gunners', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(5);
        $department->addEmployee($employee);

        return $app['twig']->render('battle_station_gunners.html.twig', array('gunners' => $department->getEmployees()));
    });

    $app->get('/gunners', function() use ($app) {
        $department = Department::find(5);
        return $app['twig']->render('battle_station_gunners.html.twig', array('gunners' => $department->getEmployees()));
    });

    $app->get('/gunners/{id}', function($id) use ($app) {
        $gunner = Employee::find($id);
        return $app['twig']->render('battle_station_gunner.html.twig', array('gunners' => $gunner));
    });

    $app->patch('/gunners/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = Employee::find($id);
        $employee->updateName($name);
        $employee->updateRank($rank);
        $employee->updateSpecies($species);
        $employee->updatePay($pay);
        $employee->updateRecord($record);
        return $app['twig']->render('battle_station_gunner.html.twig', array('gunners' => $employee));
    });

    $app->delete('/delete_battle_station_gunner/{id}', function($id) use ($app) {
        $gunner = Employee::find($id);
        $gunner->delete();
        $department = Department::find(5);
        return $app['twig']->render('battle_station.html.twig');
    });

    $app->post('/battle_station_troopers', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(6);
        $department->addEmployee($employee);

        return $app['twig']->render('battle_station_troopers.html.twig', array('troopers' => $department->getEmployees()));
    });

    $app->get('/battle_station_troopers', function() use ($app) {
        $department = Department::find(6);
        return $app['twig']->render('battle_station_troopers.html.twig', array('troopers' => $department->getEmployees()));
    });

    $app->get('/battle_station_troopers/{id}', function($id) use ($app) {
        $trooper = Employee::find($id);
        return $app['twig']->render('battle_station_trooper.html.twig', array('troopers' => $trooper));
    });

    $app->patch('/battle_station_troopers/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = Employee::find($id);
        $employee->updateName($name);
        $employee->updateRank($rank);
        $employee->updateSpecies($species);
        $employee->updatePay($pay);
        $employee->updateRecord($record);
        return $app['twig']->render('battle_station_trooper.html.twig', array('troopers' => $employee));
    });

    $app->delete('/delete_battle_station_trooper/{id}', function($id) use ($app) {
        $trooper = Employee::find($id);
        $trooper->delete();
        $department = Department::find(6);
        return $app['twig']->render('battle_station.html.twig');
    });

    $app->post('/battle_station_support', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(7);
        $department->addEmployee($employee);

        return $app['twig']->render('battle_station_support.html.twig', array('supports' => $department->getEmployees()));
    });

    $app->get('/battle_station_support', function() use ($app) {
        $department = Department::find(7);
        return $app['twig']->render('battle_station_support.html.twig', array('supports' => $department->getEmployees()));
    });

    $app->get('/battle_station_support/{id}', function($id) use ($app) {
        $support = Employee::find($id);
        return $app['twig']->render('battle_station_support_individual.html.twig', array('support' => $support));
    });

    $app->patch('/battle_station_support/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = Employee::find($id);
        $employee->updateName($name);
        $employee->updateRank($rank);
        $employee->updateSpecies($species);
        $employee->updatePay($pay);
        $employee->updateRecord($record);
        return $app['twig']->render('battle_station_support_individual.html.twig', array('support' => $employee));
    });

    $app->delete('/delete_battle_station_support/{id}', function($id) use ($app) {
        $support = Employee::find($id);
        $support->delete();
        $department = Department::find(7);
        return $app['twig']->render('battle_station.html.twig', array("battle_station_support" => $department->getEmployees()));
    });

    $app->post('/battle_station_security', function() use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = new Employee($name, $rank, $species, $pay, $record);
        $employee->save();
        $department = Department::find(8);
        $department->addEmployee($employee);

        return $app['twig']->render('battle_station_security.html.twig', array('battle_station_securities' => $department->getEmployees()));
    });

    $app->get('/battle_station_security', function() use ($app) {
        $department = Department::find(8);
        return $app['twig']->render('battle_station_security.html.twig', array('battle_station_securities' => $department->getEmployees()));
    });

    $app->get('/battle_station_security/{id}', function($id) use ($app) {
        $security = Employee::find($id);
        return $app['twig']->render('battle_station_security_individual.html.twig', array('battle_station_security' => $security));
    });

    $app->patch('/battle_station_security/{id}', function($id) use ($app) {
        $name = $_POST['name'];
        $rank = $_POST['rank'];
        $species = $_POST['species'];
        $pay = $_POST['pay'];
        $record = $_POST['record'];
        $employee = Employee::find($id);
        $employee->updateName($name);
        $employee->updateRank($rank);
        $employee->updateSpecies($species);
        $employee->updatePay($pay);
        $employee->updateRecord($record);
        return $app['twig']->render('battle_station_security_individual.html.twig', array('battle_station_security' => $employee));
    });

    $app->delete('/delete_battle_station_security/{id}', function($id) use ($app) {
        $security = Employee::find($id);
        $security->delete();
        $department = Department::find(8);
        return $app['twig']->render('battle_station.html.twig');
    });

    $app->get('/imperial', function() use ($app) {
        return $app['twig']->render('imperial.html.twig');
    });
    $app->get('/jobs', function() use ($app) {
        return $app['twig']->render('jobs.html.twig');
    });

    $app->get('/employees', function() use ($app) {
        return $app['twig']->render('employees.html.twig', array('employees' => Employee::getAll(), 'departments' => Department::getAll()));

    });

    return $app;
?>
