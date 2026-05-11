<?php

require_once __DIR__ .
'/../models/Fine.php';

require_once __DIR__ .
'/../helpers/auth_helper.php';

class FineController
{
    // =========================
    // MEMBER FINES PAGE
    // =========================

    public function myFines()
    {
        auth_check('member');

        $fineModel =
            new Fine();

        $memberId =
            $_SESSION['member_id'];


        // GET FINES

        $fines =
            $fineModel->getMemberFines(
                $memberId
            );


        // TOTAL BALANCE

        $total =
            $fineModel->getTotalUnpaid(
                $memberId
            );


        require_once __DIR__ .
        '/../views/fine/my_fines.php';
    }
    // =========================
// LIBRARIAN FINE DASHBOARD
// =========================

public function dashboard()
{
    auth_check(['admin', 'librarian']);

    $fineModel =
        new Fine();


    // SEARCH

    $search =
        trim($_GET['search'] ?? '');


    // GET FINES

    $fines =
        $fineModel->getAllUnpaidFines(
            $search
        );


    require_once __DIR__ .
    '/../views/fine/dashboard.php';
}
// =========================
// PAY FINE API
// =========================

public function payFine()
{
    auth_check(['admin', 'librarian']);

    $fineModel =
        new Fine();

    $fineId =
        $_POST['fine_id'] ?? null;


    // UPDATE

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