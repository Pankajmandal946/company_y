<?php

namespace Config;
// ...

use App\Controllers\News; // Add this line
use App\Controllers\Pages;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('h', 'Home::home');
#...
$routes->get('o', [Home::class, 'home']);
$routes->get('home', [AdminController::class, 'home']);
$routes->get('', [Dashboard::class, 'index']);
$routes->get('dashboard', 'Dashboard:: index');
$routes->get('login', [Dashboard::class, 'login']);
$routes->get('table', [Table::class, 'table']);
$routes->get('table/new', [Table::class, 'table/new']);
$routes->get('table/new/0', [Table::class, 'table/new']);
$routes->get('table/edit/(:segment)', [Table::class, 'table/edit/$1']);
$routes->get('table/delete/(:segment)', [Table::class, 'table/delete/$1']);
$routes->get('logout',  [Dashboard::class, 'logout']);

$routes->get('news', 'News::index');           // Add this line
$routes->get('news/(:segment)', [News::class, 'show']); // Add this line

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
