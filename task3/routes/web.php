<?php




$router->post('/borrow', 'BorrowController@borrow');
$router->get('/my-books', 'BorrowController@myBooks');
$router->get('/borrow-requests', 'BorrowController@pendingRequests');
$router->post('/approve-request', 'BorrowController@approveRequest');
$router->post('/reject-request', 'BorrowController@rejectRequest');
$router->get('/active-loans', 'BorrowController@activeLoans');
$router->get('/api/active-loans-search', 'BorrowController@activeLoanSearch');
$router->post('/return-book', 'BorrowController@returnBook');
