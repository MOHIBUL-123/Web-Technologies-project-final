<?php
// =========================
// TASK 1: AUTH & PROFILE
// =========================

$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

$router->get('/profile', 'ProfileController@profile');
$router->post('/profile', 'ProfileController@profile');

$router->get('/dashboard/member', 'DashboardController@member');
$router->get('/dashboard/librarian', 'DashboardController@librarian');
$router->get('/dashboard/admin', 'DashboardController@admin');
$router->get('/member', 'DashboardController@member');
$router->get('/librarian', 'DashboardController@librarian');
$router->get('/admin', 'DashboardController@admin');

$router->get('/users', 'UserManagementController@index');
$router->get('/users/create', 'UserManagementController@create');
$router->post('/users/store', 'UserManagementController@store');
$router->get('/users/edit', 'UserManagementController@edit');
$router->post('/users/update', 'UserManagementController@update');
$router->post('/users/delete', 'UserManagementController@delete');
