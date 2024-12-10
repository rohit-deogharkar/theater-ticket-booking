<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//main home card route

$routes->get('/login', 'UserController::getloginform');
$routes->post('/postlogin', 'UserController::postloginform');

$routes->get('/', 'Home::getMovie');
$routes->get('pictures/(:any)', 'Home::viewImage/$1');
$routes->get('/logout', "UserController::logout");
$routes->get('/register', 'UserController::getregisterform');
$routes->post('/postregister', 'UserController::postregisterform');
$routes->get('/movie-details/(:segment)', 'Home::getMovieDetails/$1');


$routes->get('/unauthrorized', 'Home::unauthorized');
$routes->get('/booking/(:any)', 'Home::booking/$1');
$routes->get('/postbooking/(:any)/(:any)/(:any)', "Home::postBooking/$1/$2/$3");

$routes->get('/ticket/(:any)', 'Home::getTicket/$1');
$routes->get('/showmytickets/(:any)', "Home::getmytickets/$1");

$routes->get('/cancel-ticket/(:any)', "Home::cancelTicket/$1");
$routes->get('upload-form', 'Home::uploadMovieForm', ['filter' => 'checkrole:admin']);          // Add this line.
$routes->post('upload-movie', 'Home::uploadData', ['filter' => 'checkrole:admin']);            // Add this line

$routes->get('/updateMovieDetails/(:segment)', 'Home::updateMovieDetails/$1');
$routes->post('/postupdate/(:segment)', 'Home::postUpdate/$1');

$routes->get('/deletemovie/(:segment)', "Home::deleteMovie/$1");



// $routes->group(
//     'admin',
//     ['filter' => 'rolecheck:admin'],
//     function ($routes) {


//         //user routes

//     }
// );

// $routes->group(
//     'user',
//     ['filter' => 'rolecheck:admin,user'],
//     function ($routes) {



//         //user routes

//     }
// );

