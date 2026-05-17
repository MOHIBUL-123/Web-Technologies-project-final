<?php

require_once __DIR__ .
'/../config/database.php';

require_once __DIR__ .
'/../models/Fine.php';


// =========================
// GENERATE FINES
// =========================

function generate_fines()
{
    $database = new Database();
    $conn = $database->connect();

    $fineModel = new Fine();


    // GET OVERDUE ACTIVE BORROWS

    $sql = "
        SELECT *
        FROM borrow_records
        WHERE status = 'Active'
        AND due_date < NOW()
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach($records as $record)
    {
        // DAYS OVERDUE

        $today =
            new DateTime();

        $dueDate =
            new DateTime(
                $record['due_date']
            );

        $days =
            $today->diff($dueDate)->days;


        // FINE = DAYS × 5

        $amount =
            $days * 5;


        // UPSERT FINE

        $fineModel->upsertFine(

            $record['id'],

            $record['member_id'],

            $amount,

            $days
        );
    }
}