<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


/**
 * --------------------------------------------------------------------
 * ADMIN ROUTE
 * --------------------------------------------------------------------
 * 
 * you can setup admin route on this below
 */

//Login
$routes->add(ADMINURL.'/assets/(:any)/(:any)', BACKEND.'\Asset::static/$1/$2'); // Asset Static file
$routes->group(ADMINURL, ['filter' => 'login-auth'], function ($routes) {
	$routes->add('login', BACKEND.'\Login::index');
	$routes->add('auth', BACKEND.'\Login::auth');
});
// Admin Page
$routes->group(ADMINURL, ['filter' => 'web-auth'], function ($routes) {
	$routes->add('dashboard', BACKEND.'\Dashboard::index');
	$routes->add('logout', BACKEND.'\Logout::index');
});

/**
 * --------------------------------------------------------------------
 * CONTROLLER DIRECTORI ROUTE PREVENT ACCESS
 * --------------------------------------------------------------------
 * 
 * you can setup public route on this below
 */

/**
 * --------------------------------------------------------------------
 * PUBLIC ROUTE
 * --------------------------------------------------------------------
 * 
 * you can setup public route on this below
 */

$routes->add('/frontend', FRONTEND.'\Page::error');
$routes->add('/backend', FRONTEND.'\Page::error');
$routes->add('/', FRONTEND.'\Home::index'); // Homepage
$routes->add('/asset/(:any)/(:any)', FRONTEND.'\Asset::static/$1/$2'); // Asset Static file
$routes->add('/(:any)', FRONTEND.'\Page::view/$1'); // Dynamic Pages

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
