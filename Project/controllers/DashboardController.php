<?php

require_once __DIR__ .
'/../helpers/auth_helper.php';

class DashboardController
{
    // MEMBER
public function member()
{
    auth_check('member');


    // LOAD MODELS

    require_once __DIR__ .
    '/../models/BorrowRecord.php';

    require_once __DIR__ .
    '/../models/Fine.php';


    // CREATE MODEL OBJECTS

    $borrowModel =
        new BorrowRecord();

    $fineModel =
        new Fine();


    // MEMBER ID

    $memberId =
        $_SESSION['member_id'];


    // ACTIVE LOANS

    $activeLoans =
        $borrowModel->getActiveLoanCount(
            $memberId
        );


    // UPCOMING DUE

    $upcomingDue =
        $borrowModel->getUpcomingDueCount(
            $memberId
        );


    // OUTSTANDING FINES

    $outstandingFines =
        $fineModel->getOutstandingFineTotal(
            $memberId
        );


    // LOAD VIEW

    require_once __DIR__ .
    '/../views/dashboard/member.php';
}

    // LIBRARIAN

    public function librarian()
    {
        auth_check('librarian');

        require_once __DIR__ .
        '/../views/dashboard/librarian.php';
    }


    // ADMIN

    public function admin()
    {
        auth_check('admin');

        require_once __DIR__ .
        '/../views/dashboard/admin.php';
    }
}