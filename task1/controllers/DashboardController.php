<?php

require_once __DIR__ .
'/../helpers/auth_helper.php';

class DashboardController
{

public function member()
{
    auth_check('member');


    $memberId =
        $_SESSION['member_id'];



    $activeLoans = 0;
    $upcomingDue = 0;
    $outstandingFines = 0;


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