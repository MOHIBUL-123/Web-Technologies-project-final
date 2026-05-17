<?php

require_once __DIR__ .
'/../models/Fine.php';

require_once __DIR__ .
'/../helpers/auth_helper.php';

class FineController
{




    public function myFines()
    {
        auth_check('member');

        $fineModel =
            new Fine();

        $memberId =
            $_SESSION['member_id'];


        $fines =
            $fineModel->getMemberFines(
                $memberId
            );


        $total =
            $fineModel->getTotalUnpaid(
                $memberId
            );


        require_once __DIR__ .
        '/../views/fine/my_fines.php';
    }




public function dashboard()
{
    auth_check(['admin', 'librarian']);

    $fineModel =
        new Fine();


    $search =
        trim($_GET['search'] ?? '');


    $fines =
        $fineModel->getAllUnpaidFines(
            $search
        );


    require_once __DIR__ .
    '/../views/fine/dashboard.php';
}




public function payFine()
{
    auth_check(['admin', 'librarian']);

    $fineModel =
        new Fine();

    $fineId =
        $_POST['fine_id'] ?? null;


    $success =
        $fineModel->markAsPaid(
            $fineId
        );


    header(
        'Content-Type: application/json'
    );

    echo json_encode([

        'success' => $success
    ]);

    exit;
}
}