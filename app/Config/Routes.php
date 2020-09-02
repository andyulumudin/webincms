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
	$routes->add('', 'Dashboard::index');									// Done
	// -------- Post --------
	$routes->add('post', 'Post::index');									// Done
	$routes->add('post/add', 'Post::add');									// Done
	$routes->add('post/edit/(:num)', 'Post::edit/$1');						// Done
	$routes->add('post/delete/(:num)', 'Post::delete/$1');					// Done
	$routes->add('post/section', 'Post::section');							// Done
	$routes->add('post/addsection', 'Post::addsection');					// Done
	$routes->add('post/updatesection', 'Post::updatesection');				// Done
	$routes->add('post/deletesection/(:num)', 'Post::deletesection/$1');	// Done
	// -------- Page --------
	$routes->add('page', 'Page::index');									// Done
	$routes->add('page/add', 'Page::add');									// Done
	$routes->add('page/edit/(:num)', 'Page::edit/$1');						// Done
	$routes->add('page/delete/(:num)', 'Page::delete/$1');					// Done
	// -------- Media --------
	$routes->add('media', 'Media::index');									// Done
	$routes->add('media/add', 'Media::add');								// Done
	$routes->add('media/edit/(:num)', 'Media::edit/$1');					// Done
	$routes->add('media/delete/(:num)', 'Media::delete/$1');				// Done
	// -------- Files --------
	$routes->add('files', 'Files::index');									// Done
	$routes->add('files/upload', 'Files::upload');							// Done
	$routes->add('files/edit/(:num)', 'Files::edit/$1');					// Done
	$routes->add('files/delete/(:num)', 'Files::delete/$1');				// Done
	$routes->add('files/modal', 'Files::modal');							// ----
	// -------- Template --------
	$routes->add('template', 'Template::index');							// Done
	$routes->add('template/update', 'Template::update');					// Done
	$routes->add('template/default', 'Template::default');					// ----
	$routes->add('template/(:any)', 'Template::index/$1');					// Done
	// -------- Menu --------
	$routes->add('menu', 'Menu::index');									// Done
	$routes->add('menu/add', 'Menu::add');									// Done
	$routes->add('menu/default/(:num)', 'Menu::default/$1');				// Done
	$routes->add('menu/update', 'Menu::update');							// Done
	$routes->add('menu/delete/(:num)', 'Menu::delete/$1');					// Done
	$routes->add('menu/additem', 'Menu::additem');							// Done
	$routes->add('menu/updateitem', 'Menu::updateitem');					// Done
	$routes->add('menu/detailitem/(:num)', 'Menu::detailitem/$1');			// Done
	$routes->add('menu/deleteitem/(:num)', 'Menu::deleteitem/$1');			// Done
	// -------- Widget --------
	$routes->add('widget', 'Widget::index');								// Done
	$routes->add('widget/default/(:alphanum)', 'Widget::default/$1');		// Done
	$routes->add('widget/add', 'Widget::add');								// Done
	$routes->add('widget/setorder', 'Widget::setorder');					// Done
	$routes->add('widget/edit', 'Widget::edit');							// Done
	$routes->add('widget/delete/(:num)', 'Widget::delete/$1');				// Done
	// -------- Setting --------
	$routes->add('setting', 'Setting::index');								// Done
	$routes->add('setting/save', 'Setting::save');							// Done
	$routes->add('setting/contact', 'Setting::contact');					// Done
	// -------- User --------
	$routes->add('users', 'Users::index'); 									// Done
	$routes->add('user/add', 'Users::add'); 								// Done
	$routes->add('user/edit/(:num)', 'Users::edit/$1'); 					// Done
	$routes->add('user/delete/(:alphanum)', 'Users::delete/$1'); 			// Done
	$routes->add('profile', 'Users::profile'); 								// Done
	$routes->add('logout', 'Logout::index'); 								// Done
});

/**
 * --------------------------------------------------------------------
 * PUBLIC ROUTE
 * --------------------------------------------------------------------
 * 
 * you can setup public route on this below
 */
$routes->group('', function($routes) {
	$routes->setDefaultNamespace('App\Controllers\\'.FRONTEND);
	// Prevent URL ---------------------------
	$routes->add('frontend', 'Page::error');
	$routes->add('backend', 'Page::error');
	// Public URL ----------------------------
	$routes->add('', 'Home::index'); // Homepage
	$routes->add('asset/(:any)/preview.png', 'Asset::preview/$1'); // Preview image template
	$routes->add('asset/(:any)/(:any)', 'Asset::static/$1/$2'); // Asset Static files
	$routes->add('(:segment)', 'Page::view/$1'); // Dynamic Pages
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
