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

    $app-get('army', function() use ($app) {
        return $app['twig']->render('army.html.twig');
    });

    $app-get('navy', function() use ($app) {
        return $app['twig']->render('navy.html.twig');
    });

    $app-get('battle_station', function() use ($app) {
        return $app['twig']->render('battle_station.html.twig');
    });

    $app-get('vader', function() use ($app) {
        return $app['twig']->render('vader.html.twig');
    });

    return $app;
?>
