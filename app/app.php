<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/contact.php";

    session_start();

    if (empty($_SESSION['contact_array'])) {
        $_SESSION['contact_array'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig', array('contacts' => Contact::getAll()));
    });

    $app->post('/create', function() use ($app) {
        $new_contact = new Contact($_POST['name'], $_POST['number'], $_POST['address']);
        $new_contact->save();
        return $app['twig']->render('create.html.twig', array('new_contact' => $new_contact));
    });

    $app->post('/home', function() use ($app) {
        return $app['twig']->render('index.html.twig', array('contacts' => Contact::getAll()));
    });

    $app->post('/fresh', function() use ($app) {
        Contact::delete();
        return $app['twig']->render('index.html.twig', array('contacts' => Contact::getAll()));
    });

    return $app;
?>
