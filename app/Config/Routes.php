<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Requests::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->get('logout', 'Auth::logout');

$routes->get('requests', 'Requests::index');
$routes->get('requests/new', 'Requests::new');
$routes->post('requests/create', 'Requests::create');
$routes->post('requests/(:num)/approve', 'Requests::approve/$1');

$routes->get('admin/employees', 'Admin::employees');
$routes->post('admin/employees/create', 'Admin::createEmployee');

$routes->get('catalogs/areas', 'Catalogs::areas');
$routes->post('catalogs/areas/create', 'Catalogs::createArea');
$routes->get('catalogs/expense-types', 'Catalogs::expenseTypes');
$routes->post('catalogs/expense-types/create', 'Catalogs::createExpenseType');

return $routes;
