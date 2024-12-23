<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//main home card route

//authenctication/logout routes

$routes->get('/login', 'UserController::getloginform');
$routes->post('/postlogin', 'UserController::postloginform');
$routes->get('/register', 'UserController::getregisterform');
$routes->post('/postregister', 'UserController::postregisterform');
$routes->get('/logout', "UserController::logout");
$routes->get('/unauthorized', 'Home::unauthorized');
$routes->get('/getpdf/(:any)', "Home::downloadpdf/$1", ['filter' => 'rolecheck:user,admin']);

//common routes

$routes->get('/', 'Home::getMovie', ['filter' => 'rolecheck:user,admin']);
$routes->get('pictures/(:any)', 'Home::viewImage/$1', ['filter' => 'rolecheck:user,admin']);
$routes->get('/movie-details/(:segment)', 'Home::getMovieDetails/$1', ['filter' => 'rolecheck:user,admin']);
$routes->get('/ticket/(:any)', 'Home::getTicket/$1', ['filter' => 'rolecheck:user,admin']);
$routes->post('/postsearch', "Home::postsearch", ['filter' => 'rolecheck:user,admin']);

//user specific routes

$routes->get('/booking/(:any)', 'Home::booking/$1', ['filter' => 'rolecheck:user']);
$routes->get('/postbooking', "Home::postBooking", ['filter' => 'rolecheck:user']);
$routes->get('/showmytickets/(:any)', "Home::getmytickets/$1", ['filter' => 'rolecheck:user']);
$routes->get('/cancel-ticket/(:any)', "Home::cancelTicket/$1", ['filter' => 'rolecheck:user']);
$routes->get('/userspecificseats/(:any)', "Home::userspecificseats/$1", ['filter' => 'rolecheck:user']);

//admin specific routes

$routes->get('upload-form', 'Home::uploadMovieForm', ['filter' => 'rolecheck:admin']);
$routes->post('upload-movie', "Home::uploadData", ['filter' => 'rolecheck:admin']);
$routes->get('/updateMovieDetails/(:segment)', 'Home::updateMovieDetails/$1', ['filter' => 'rolecheck:admin']);
$routes->post('/postupdate/(:segment)', 'Home::postUpdate/$1', ['filter' => 'rolecheck:admin']);
$routes->get('/deletemovie/(:segment)', "Home::deleteMovie/$1", ['filter' => 'rolecheck:admin']);
$routes->get('/alltickets', 'Home::alltickets', ['filter' => 'rolecheck:admin']);
$routes->get('/logs', "LogsController::viewlogs", ['filter' => 'rolecheck:admin']);
$routes->get('/specificlog/(:any)', "LogsController::specificlog/$1", ['filter' => 'rolecheck:admin']);
$routes->get('/forcelogout/(:any)', "LogsController::forcelogout/$1", ['filter' => 'rolecheck:admin']);

//logroutes

// $routes->get('/addlog', "LogsController::postlog", ['filter' => 'rolecheck:user,admin']);

