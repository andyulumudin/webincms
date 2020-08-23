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
$routes->add(ADMINURL.'/assets/(:any)/(:any)', 'Asset::static/$1/$2', ['namespace' => 'App\Controllers\\'.BACKEND]); // Asset Static file
$routes->group(ADMINURL, ['filter' => 'login-auth'], function ($routes) {
	$routes->setDefaultNamespace('App\Controllers\\'.BACKEND);
	$routes->add('login', 'Login::index');
	$routes->add('auth', 'Login::auth');
});
// Admin Page
$routes->group(ADMINURL, ['filter' => 'admin-auth'], function ($routes) {
	$routes->setDefaultNamespace('App\Controllers\\'.BACKEND);
	$routes->add('', 'Dashboard::index');							// Done
	// -------- Post --------
	$routes->add('post', 'Post::index');							// --
	$routes->add('post/add', 'Post::add');							// --
	$routes->add('post/edit/(:num)', 'Post::edit/$1');				// --
	$routes->add('post/delete/(:num)', 'Post::delete/$1');			// --
	// -------- Page --------
	$routes->add('page', 'Page::index');							// --
	$routes->add('page/add', 'Page::add');							// --
	$routes->add('page/edit/(:num)', 'Page::edit/$1');				// --
	$routes->add('page/delete/(:num)', 'Page::delete/$1');			// --
	// -------- Media --------
	$routes->add('media', 'Media::index');							// --
	$routes->add('media/add', 'Media::add');						// --
	$routes->add('media/edit/(:num)', 'Media::edit/$1');			// --
	$routes->add('media/delete/(:num)', 'Media::delete/$1');		// --
	// -------- Files --------
	$routes->add('files', 'Files::index');							// --
	$routes->add('files/add', 'Files::add');						// --
	$routes->add('files/edit/(:num)', 'Files::edit/$1');			// --
	$routes->add('files/delete/(:num)', 'Files::delete/$1');		// --
	// -------- Menu --------
	$routes->add('menu', 'Menu::index');							// --
	$routes->add('menu/add', 'Menu::add');							// --
	$routes->add('menu/edit/(:num)', 'Menu::edit/$1');				// --
	$routes->add('menu/delete/(:num)', 'Menu::delete/$1');			// --
	// -------- Widget --------
	$routes->add('widget', 'Widget::index');						// --
	$routes->add('widget/add', 'Widget::add');						// --
	$routes->add('widget/edit/(:num)', 'Widget::edit/$1');				// --
	$routes->add('widget/delete/(:num)', 'Widget::delete/$1');			// --
	// -------- Setting --------
	$routes->add('setting', 'Setting::index');						// --
	$routes->add('setting/contact', 'Setting::contact');			// --
	// -------- User --------
	$routes->add('users', 'Users::index'); 							// Done
	$routes->add('user/add', 'Users::add'); 						// Done
	$routes->add('user/edit/(:num)', 'Users::edit/$1'); 			// Done
	$routes->add('user/delete/(:alphanum)', 'Users::delete/$1'); 	// Done
	$routes->add('profile', 'Users::profile'); 						// Done
	$routes->add('logout', 'Logout::index'); 						// Done
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
$routes->group('', function($routes) {
	$routes->setDefaultNamespace('App\Controllers\\'.FRONTEND);
	$routes->add('frontend', 'Page::error');
	$routes->add('backend', 'Page::error');
	$routes->add('', 'Home::index'); // Homepage
	$routes->add('asset/(:any)/(:any)', 'Asset::static/$1/$2'); // Asset Static file
	$routes->add('(:any)', 'Page::view/$1'); // Dynamic Pages
});

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
