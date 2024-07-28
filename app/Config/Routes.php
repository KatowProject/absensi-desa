<?php

use CodeIgniter\Router\RouteCollection;

setlocale(LC_TIME, 'id_ID.utf8');

/**
 * @var RouteCollection $routes
 */

$routes->get('logout', 'Auth::logout');
/**
 * @param RouteCollection $routes
 */
$routes->group('', ['filter' => 'auth'],  function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login_process');
    
    $routes->get('/', 'Main::index');
    $routes->get('absensi', 'Main::absensi');
    $routes->get('attendance', 'Main::attedance');
    $routes->post('attendance', 'Main::submit_attedance');
});

/**
 * @param RouteCollection $routes
 */
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin::index');

    /**
     * @param RouteCollection $routes
     */
    $routes->group('reports', function ($routes) {
        $routes->get('/', 'Admin::reports');
        $routes->get('export', 'Admin::export_reports');
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
