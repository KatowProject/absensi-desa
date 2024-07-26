<?php

use CodeIgniter\Router\RouteCollection;

setlocale(LC_TIME, 'id_ID.utf8');

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('admin', 'Admin::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login_process');

/**
 * @param RouteCollection $routes
 */
$routes->group('', function ($routes) {
    $routes->get('/', 'Main::index');
    $routes->get('absensi', 'Main::absensi');
    $routes->get('attendance', 'Main::attedance');
});

/**
 * @param RouteCollection $routes
 */
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::index');

    /**
     * @param RouteCollection $routes
     */
    $routes->group('reports', function ($routes) {
        $routes->get('/', 'Admin::reports');
    });

    /**
     * @param RouteCollection $routes
     */
    $routes->group('users', function ($routes) {
        $routes->get('/', 'Admin::user');
        $routes->post('/', 'Admin::create_user');
        $routes->get('(:any)', 'Admin::user_detail/$1');
        $routes->put('(:any)', 'Admin::update_user/$1');
        $routes->delete('(:any)', 'Admin::delete_user/$1');
    });

    /**
     * @param RouteCollection $routes
     */
    $routes->group('jabatan', function ($routes) {
        $routes->get('/', 'Admin::jabatan');
        $routes->post('/', 'Admin::create_jabatan');
        $routes->get('(:any)', 'Admin::jabatan_detail/$1');
        $routes->put('(:any)', 'Admin::update_jabatan/$1');
        $routes->delete('(:any)', 'Admin::delete_jabatan/$1');
    });

    /**
     * @param RouteCollection $routes
     */
    $routes->group('roles', function ($routes) {
        $routes->get('/', 'Admin::role');
        $routes->get('(:any)', 'Admin::role_detail/$1');
        $routes->put('(:any)', 'Admin::update_role/$1');
    });
});
