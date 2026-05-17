<?php

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ .
'/../models/Fine.php';

class FineController
{
    // =========================
    // MEMBER FINES PAGE
    // =========================

    public function myFines()
    {
        if (!isset($_SESSION['member_id']) || $_SESSION['role'] !== 'member') { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

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
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['admin', 'librarian'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

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
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['admin', 'librarian'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

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