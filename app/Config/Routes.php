<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/kontak', 'Home::kontak');
$routes->get('/pneumonia', 'Home::pneumonia');
$routes->get('/dbd', 'Home::dbd');
$routes->get('/tbc', 'Home::tbc');
$routes->get('/diare', 'Home::diare');
$routes->get('/login', 'Home::login');

