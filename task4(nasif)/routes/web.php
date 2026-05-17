<?php
// =========================
// TASK 4: FINES & REPORTS
// =========================

$router->get('/my-fines', 'FineController@myFines');
$router->get('/fine-dashboard', 'FineController@dashboard');
$router->post('/api/fines/pay', 'FineController@payFine');

$router->get('/reports', 'ReportController@index');
