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
        return $app['twig']->render('navy_officers.html.twig');
    });

    $app->get('/navy_pilots', function() use ($app) {
        return $app['twig']->render('navy_pilots.html.twig');
    });

    $app->get('/battle_station', function() use ($app) {
        return $app['twig']->render('battle_station.html.twig');
    });

    $app->get('/imperial', function() use ($app) {
        return $app['twig']->render('imperial.html.twig');
    });

    $app->get('/army_officers', function() use ($app) {
        return $app['twig']->render('army_officers.html.twig');
    });

    $app->get('/army_troopers', function() use ($app) {
        return $app['twig']->render('army_troopers.html.twig');
    });

    $app->get('/battle_station_gunners', function() use ($app) {
        return $app['twig']->render('battle_station_gunners.html.twig');
    });

    $app->get('/battle_station_troopers', function() use ($app) {
        return $app['twig']->render('battle_station_troopers.html.twig');
    });

    $app->get('/battle_station_support', function() use ($app) {
        return $app['twig']->render('battle_station_support.html.twig');
    });

    $app->get('/battle_station_security', function() use ($app) {
        return $app['twig']->render('battle_station_security.html.twig');
    });

    $app->get('/stormtroopers', function() use ($app) {
        return $app['twig']->render('stormtroopers.html.twig');
    });

    return $app;
?>
