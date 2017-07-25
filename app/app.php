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
        return $app['twig']->render('army_officer.html.twig', array('army_officer' => $officer));
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

    $app->get('/imperial', function() use ($app) {
        return $app['twig']->render('imperial.html.twig');
    });

    return $app;
?>
