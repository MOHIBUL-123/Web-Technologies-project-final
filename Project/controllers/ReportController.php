<?php

require_once __DIR__ .
'/../helpers/auth_helper.php';

require_once __DIR__ .
'/../models/BorrowRecord.php';


class ReportController
{
    public function index()
    {
        auth_check('admin');


        $borrowModel =
            new BorrowRecord();


        $topBooks =
            $borrowModel->getTopBorrowedBooks();


        $topMembers =
            $borrowModel->getTopMembers();


        $monthlyBorrows =
            $borrowModel->getMonthlyBorrows();


        require_once __DIR__ .
        '/../views/reports/index.php';
    }
}