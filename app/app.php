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

    $app->get('/battle_station', function() use ($app) {
        return $app['twig']->render('battle_station.html.twig');
    });

    $app->get('/vader', function() use ($app) {
        return $app['twig']->render('vader.html.twig');
    });

    $app->get('/army_officers', function() use ($app) {
        return $app['twig']->render('army_officers.html.twig');
    });

    $app->get('/army_troopers', function() use ($app) {
        return $app['twig']->render('army_troopers.html.twig');
    });

    $app->get('/navy_officers', function() use ($app) {
        return $app['twig']->render('navy_officers.html.twig');
    });

    $app->get('/navy_pilots', function() use ($app) {
        return $app['twig']->render('navy_pilots.html.twig');
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
