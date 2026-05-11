<?php

require_once __DIR__ .
'/../models/BorrowRecord.php';

require_once __DIR__ .
'/../models/Fine.php';


// =========================
// GENERATE FINES
// =========================

function generate_fines()
{
    $borrowModel =
        new BorrowRecord();

    $fineModel =
        new Fine();


    // GET OVERDUE ACTIVE BORROWS

    $records =
        $borrowModel->getOverdueBorrows();


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