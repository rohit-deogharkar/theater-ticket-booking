<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//main home card route

$routes->get('/', 'Home::getMovie');

//upload movie form route

$routes->get('upload-form', 'Home::uploadMovieForm');          // Add this line.
$routes->post('upload-movie', 'Home::uploadData');            // Add this line

$routes->get('pictures/(:any)', 'Home::viewImage/$1');

$routes->get('/movie-details/(:segment)', 'Home::getMovieDetails/$1');

$routes->get('/updateMovieDetails/(:segment)', 'Home::updateMovieDetails/$1');
$routes->post('/postupdate/(:segment)', 'Home::postUpdate/$1');

$routes->get('/deletemovie/(:segment)', "Home::deleteMovie/$1");

$routes->get('/booking/(:any)', 'Home::booking/$1');
$routes->get('/postbooking/(:any)/(:any)/(:any)', "Home::postBooking/$1/$2/$3");

$routes->get('/ticket/(:any)', 'Home::getTicket/$1');

//user routes

$routes->get('/register', 'UserController::getregisterform');
$routes->post('/postregister', 'UserController::postregisterform');

$routes->get('/login', 'UserController::getloginform');
$routes->post('/postlogin', 'UserController::postloginform');

$routes->get('/showmytickets/(:any)', "Home::getmytickets/$1");

