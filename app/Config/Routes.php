<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('TaskController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);


$routes->get('/', 'TaskController::index');
$routes->group('',['filter' => 'login'], function ($routes) {
    // Il faut encore développer
    $routes->get('/taches','TaskController::indexAdmin',['filter' => 'role:admin']);
    $routes->get('/taches/(:num)','TaskController::tasksUser/$1');
    $routes->get('/creer', 'TaskController::create');
    $routes->get('/supprimer/(:num)','TaskController::delete/$1');
    $routes->post('/sauvegarder', 'TaskController::save');
    $routes->get('/modifier/(:num)','TaskController::editTask/$1');
    $routes->post('/sauvegarder/(:num)','TaskController::save/$1');
    $routes->get('/done/(:num)','TaskController::done/$1');
    $routes->get('/reorder/(:num)','TaskController::indexReorder/$1');
    $routes->post('/reorder/save','TaskController::saveReorder');
    $routes->get('/account','TaskController::editAccount');
    $routes->post('/confirmationMail','AccountController::modificationMail');
    $routes->post('/confirmationUsername','AccountController::modificationUsername');
    $routes->post('/confirmationPassword','AccountController::modificationPassword');
});



/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
