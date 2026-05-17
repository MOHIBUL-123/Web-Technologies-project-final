<?php

require_once __DIR__ .
'/../helpers/auth_helper.php';

class DashboardController
{

public function member()
{
    auth_check('member');


    require_once __DIR__ .
    '/../models/BorrowRecord.php';

    require_once __DIR__ .
    '/../models/Fine.php';


    $borrowModel =
        new BorrowRecord();

    $fineModel =
        new Fine();


    $memberId =
        $_SESSION['member_id'];


    $activeLoans =
        $borrowModel->getActiveLoanCount(
            $memberId
        );


    $upcomingDue =
        $borrowModel->getUpcomingDueCount(
            $memberId
        );


    $outstandingFines =
        $fineModel->getOutstandingFineTotal(
            $memberId
        );


    require_once __DIR__ .
    '/../views/dashboard/member.php';
}


    public function librarian()
    {
        auth_check('librarian');

        require_once __DIR__ .
        '/../views/dashboard/librarian.php';
    }


    public function admin()
    {
        auth_check('admin');

        require_once __DIR__ .
        '/../views/dashboard/admin.php';
    }
}