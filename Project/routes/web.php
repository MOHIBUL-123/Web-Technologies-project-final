<?php
$router->get('/dashboard/member', 'DashboardController@member');

$router->get('/dashboard/librarian', 'DashboardController@librarian');

$router->get('/dashboard/admin', 'DashboardController@admin');
$router->get('/', 'BookController@index');

$router->get('/login', 'AuthController@login');

$router->post('/login', 'AuthController@login');

$router->get('/register', 'AuthController@register');

$router->post('/register', 'AuthController@register');

$router->get('/logout', 'AuthController@logout');
$router->get(
    '/profile',
    'ProfileController@profile'
);

$router->post(
    '/profile',
    'ProfileController@profile'
);
// =========================
// GENRE ROUTES
// =========================

$router->get(
    '/genres',
    'GenreController@index'
);

$router->get(
    '/genres/create',
    'GenreController@create'
);

$router->post(
    '/genres/create',
    'GenreController@create'
);
// =========================
// DASHBOARD ROUTES
// =========================

$router->get(
    '/member',
    'DashboardController@member'
);

$router->get(
    '/librarian',
    'DashboardController@librarian'
);

$router->get(
    '/admin',
    'DashboardController@admin'
);
$router->get(
    '/genres/edit',
    'GenreController@edit'
);

$router->post(
    '/genres/edit',
    'GenreController@edit'
);
$router->post(
    '/genres/delete',
    'GenreController@delete'
);
// =========================
// BOOK ROUTES
// =========================

$router->get(
    '/books',
    'BookController@index'
);

$router->get(
    '/books/create',
    'BookController@create'
);

$router->post(
    '/books/create',
    'BookController@create'
);
$router->get(
    '/books/edit',
    'BookController@edit'
);

$router->post(
    '/books/edit',
    'BookController@edit'
);
$router->post(
    '/books/delete',
    'BookController@delete'
);
// =========================
// BORROW ROUTES
// =========================

$router->post(
    '/borrow',
    'BorrowController@borrow'
);
// =========================
// MEMBER BORROW ROUTES
// =========================

$router->get(
    '/my-books',
    'BorrowController@myBooks'
);
$router->post(
    '/return-book',
    'BorrowController@returnBook'
);
// =========================
// LIBRARIAN BORROW DASHBOARD
// =========================

$router->get(
    '/borrow-requests',
    'BorrowController@pendingRequests'
);
// =========================
// APPROVE / REJECT AJAX
// =========================

$router->post(
    '/approve-request',
    'BorrowController@approveRequest'
);

$router->post(
    '/reject-request',
    'BorrowController@rejectRequest'
);
// =========================
// ACTIVE LOANS
// =========================

$router->get(
    '/active-loans',
    'BorrowController@activeLoans'
);
$router->get(
    '/books/details',
    'BookController@details'
);
$router->get(
    '/api/books/availability',
    'BookController@availability'
);
$router->get(
    '/api/books/search',
    'BookController@searchApi'
);
$router->get(
    '/my-fines',
    'FineController@myFines'
);
$router->get(
    '/fine-dashboard',
    'FineController@dashboard'
);
$router->post(
    '/api/fines/pay',
    'FineController@payFine'
);
require_once __DIR__ .
'/../controllers/ReportController.php';
$router->get(
    '/reports',

    'ReportController@index'
);
require_once __DIR__ .
'/../controllers/UserManagementController.php';
$router->get(
    '/users',

    'UserManagementController@index'
);
$router->get(
    '/users/create',

    'UserManagementController@create'
);


$router->post(
    '/users/store',

    'UserManagementController@store'
);
$router->get(
    '/users/edit',

    'UserManagementController@edit'
);


$router->post(
    '/users/update',

    'UserManagementController@update'
);


$router->post(
    '/users/delete',

    'UserManagementController@delete'
);
$router->get(
    '/api/active-loans-search',

    'BorrowController@activeLoanSearch'
);