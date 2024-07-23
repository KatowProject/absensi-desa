<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('admin', 'Admin::index');
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::index');

    $routes->group('users', function ($routes) {
        $routes->get('/', 'Admin::user');
        $routes->post('/', 'Admin::create_user');
        $routes->get('(:any)', 'Admin::user_detail/$1');
        $routes->put('(:any)', 'Admin::update_user/$1');
        $routes->delete('(:any)', 'Admin::delete_user/$1');
    });

    $routes->group('jabatan', function ($routes) {
        $routes->get('/', 'Admin::jabatan');
        $routes->post('/', 'Admin::create_jabatan');
        $routes->get('(:any)', 'Admin::jabatan_detail/$1');
        $routes->put('(:any)', 'Admin::update_jabatan/$1');
        $routes->delete('(:any)', 'Admin::delete_jabatan/$1');
    });

    $routes->group('roles', function ($routes) {
        $routes->get('/', 'Admin::role');
        $routes->get('(:any)', 'Admin::role_detail/$1');
        $routes->put('(:any)', 'Admin::update_role/$1');
    });
});
